<?php
/**
 * Created by PhpStorm.
 * User: 00545841240
 * Date: 30/10/2017
 * Time: 10:32
 */

namespace App\Domains\Protocolo\Services;

use App\Domains\Protocolo\Repositories\Contracts\DocumentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\TipoDocumentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\SecretariasRepository;
use App\Domains\Protocolo\Repositories\Contracts\DepartamentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoAnexoRepository;
use App\Domains\Protocolo\Repositories\Contracts\TramitacaoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class TramitacaoService
{

    /** @var  DocumentoRepository */
    private $documentoRepository;

    /** @var  TipoDocumentoRepository */
    private $tipoDocumentoRepository;

    /** @var  SecretariasRepository */
    private $secretariaRepository;

    /** @var  DepartamentoRepository */
    private $departamentoRepository;

    /** @var  DepartamentoRepository */
    private $documentoAnexoRepository;

    /**
     * @var TramitacaoRepository
     */
    private $tramitacaoRepository;

    public function __construct(
        DocumentoRepository $documentoRepository,
        TipoDocumentoRepository $tipoDocumentoRepository,
        SecretariasRepository $secretariaRepository,
        DepartamentoRepository $departamentoRepository,
        DocumentoAnexoRepository $documentoAnexoRepository,
        TramitacaoRepository $tramitacaoRepository
    )
    {
        $this->documentoRepository = $documentoRepository;
        $this->tipoDocumentoRepository = $tipoDocumentoRepository;
        $this->secretariaRepository = $secretariaRepository;
        $this->departamentoRepository = $departamentoRepository;
        $this->documentoAnexoRepository = $documentoAnexoRepository;
        $this->tramitacaoRepository = $tramitacaoRepository;
    }

    public function getAllDocumentsType()
    {
        return $this->tipoDocumentoRepository->all();
    }

    public function getDocumentsCounter()
    {
        $docsSetor = $this->tramitacaoRepository->query()
            ->join('documentos','documentos.id','=','tramitacaos.id_documento')
            ->where('documentos.arquivado',false)
            ->where('documentos.id_departamento', auth()->user()->id_departamento)
            ->where('tramitacaos.status','<>','P')
            ->get()
            ->count();

        $pendentes = $this->tramitacaoRepository->query()
            ->join('documentos','documentos.id','=','tramitacaos.id_documento')
            ->where('documentos.arquivado',false)
            ->where('documentos.id_departamento', auth()->user()->id_departamento)
            ->where('tramitacaos.status','P')
            ->get()
            ->count();

        $arquivado = $this->documentoRepository->findWhere([
            'arquivado' => true
        ])->count();

        $arrDados = [
            'noSetor' => $docsSetor,
            'pendentes' => $pendentes,
            'arquivado' => $arquivado
        ];

        return $arrDados;
    }

    public function builder()
    {
        return $this->documentoRepository
            ->with('tipo_documento')
            ->query()
            ->join('tramitacaos','tramitacaos.id_documento','=','documentos.id')
            ->where('documentos.id_departamento',auth()->user()->id_departamento)
            ->where('tramitacaos.status','R');
    }

    public function builderPendents()
    {
        return $this->documentoRepository
            ->with('tipo_documento')
            ->query()
            ->join('tramitacaos','tramitacaos.id_documento','=','documentos.id')
            ->where('documentos.id_departamento',auth()->user()->id_departamento)
            ->where('tramitacaos.status','P');
    }

    public function getDataCreate()
    {

        $years=[];
        for ($i=2014; $i<=2025 ; $i++) {
            $years[] = $i;
        }

        $arrayData = [
            'tipo_docs' => $this->tipoDocumentoRepository->all()->toArray(),
            'secretarias' => $this->secretariaRepository->all()->toArray(),
            'departamentos' => $this->departamentoRepository->all()->toArray(),
            'years' => $years
        ];

        return $arrayData;

    }

    public function createAndUpload(Request $attributes)
    {
        try{
            if($documento = $this->documentoRepository->create($attributes->all())){
                $filename = $attributes->documento->store('protocolo','public');
                $documento->path_doc = $filename;
                if ($documento->save()){
                    $this->tramitacaoRepository->create([
                        'data_tram' => date('d/m/Y'),
                        'id_documento' => $documento->id,
                        'id_origem' => $attributes->int_ext=='I'?auth()->user()->id_departamento:$attributes->id_secretaria,
                        'id_destino' => $attributes->id_departamento,
                        'id_usuario' => auth()->user()->id,
                        'tipo_tram' => 'R',
                        'despacho' => $attributes->despacho,
                        'status' => 'P'
                    ]);

                }
            }
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    public function findDocs($id)
    {
        try {

        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }
    
}