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
        $docsSetor = $this->documentoRepository->query()
            ->where('arquivado', false)
            ->where('id_departamento', auth()->user()->id_departamento)
            ->where('status', '<>', 'P')
            ->get()
            ->count();

        $pendentes = $this->documentoRepository->query()
            ->where('arquivado', false)
            ->where('id_departamento', auth()->user()->id_departamento)
            ->where('status', 'P')
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
            ->where('id_departamento', auth()->user()->id_departamento)
            ->where('status', 'R');
    }

    public function builderPendents()
    {
        return $this->documentoRepository
            ->with('tipo_documento')
            ->query()
            ->where('id_departamento', auth()->user()->id_departamento)
            ->where('status', 'P');
    }

    public function getDataCreate()
    {

        $years = [];
        for ($i = 2014; $i <= 2025; $i++) {
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
        try {
            if ($documento = $this->documentoRepository->create($attributes->all())) {
                $filename = $attributes->documento->store('protocolo', 'public');
                $documento->path_doc = $filename;
                if ($documento->save()) {
                    $tram = $this->tramitacaoRepository->create([
                        'data_tram' => date('d/m/Y'),
                        'id_documento' => $documento->id,
                        'id_usuario' => auth()->user()->id,
                        'tipo_tram' => 'N',
                        'despacho' => $attributes->despacho,
                        'status' => 'P'
                    ]);
                    if ($attributes->int_ext == 'I'){
                        $tram->id_departamento_origem = auth()->user()->id_departamento;
                        $tram->id_departamento_destino = $attributes->id_departamento;
                    }else{
                        $tram->id_secretaria_origem = auth()->user()->id_departamento;
                        $tram->id_departamento_destino = $attributes->id_departamento;
                    }

                }
            }
        } catch (ValidatorException $e) {
            return redirect()->back()->with('errors', $e->getMessageBag());
        }
    }

    public function recebeDoc($attributes)
    {
        try {
            $documento = $this->documentoRepository->with('tramitacoes')->find($attributes->id);
            $documento->status = 'R';
            if ($documento->save()) {
                $model = $this->tramitacaoRepository->create([
                    'data_tram' => date('d/m/Y'),
                    'id_documento' => $attributes->id,
                    'id_origem' => $documento->tramitacoes->last()->id_origem,
                    'id_destino' => $documento->tramitacoes->last()->id_destino,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'N',
                    'despacho' => $documento->tramitacoes->last()->despacho,
                    'status' => $attributes->value
                ]);
                if ($model) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (ValidatorException $e) {
            return redirect()->back()->with('errors', $e->getMessageBag());
        }
    }

    public function findDocs($id)
    {
        try {
            return $this->documentoRepository->find($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    public function findDocMovimentacao($id)
    {
        try {
            return $this->documentoRepository->with('tramitacoes')->find($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    public function defineStatus($attributes)
    {
        try {
            $tramitacao = $this->tramitacaoRepository->find($attributes->id);
            $tramitacao->fill(['status' => $attributes->value]);
            if ($tramitacao->save()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

}