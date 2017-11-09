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
use App\Exceptions\Access\GeneralException;
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
        if(in_admin_group()){
            $docsSetor = $this->documentoRepository->query()
                ->where('status', 'R')
                ->get()
                ->count();
        }else{
            $docsSetor = $this->documentoRepository->query()
                ->where('arquivado', false)
                ->where('id_departamento', auth()->user()->id_departamento)
                ->where('status', '<>', 'P')
                ->get()
                ->count();
        }


        if(in_admin_group()){
            $pendentes = $this->documentoRepository->query()
                ->where('arquivado', false)
                ->where('status', 'P')
                ->get()
                ->count();
        }else{
            $pendentes = $this->documentoRepository->query()
                ->where('arquivado', false)
                ->where('id_departamento', auth()->user()->id_departamento)
                ->where('status', 'P')
                ->get()
                ->count();
        }

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
        if(in_admin_group()){
            return $this->documentoRepository
                ->with(['tipo_documento','departamento_origem','secretaria_origem'])
                ->query()
                ->where('status', 'R');
        }else{
            return $this->documentoRepository
                ->with(['tipo_documento','departamento_origem','secretaria_origem'])
                ->query()
                ->where('id_departamento', auth()->user()->id_departamento)
                ->where('status', 'R');
        }
    }

    public function builderPendents()
    {
        if (in_admin_group()){
            return $this->documentoRepository
                ->with(['tipo_documento','departamento_origem','secretaria_origem'])
                ->query()
                ->where('status', 'P');
        }else{
            return $this->documentoRepository
                ->with(['tipo_documento','departamento_origem','secretaria_origem'])
                ->query()
                ->where('id_departamento', auth()->user()->id_departamento)
                ->where('status', 'P');
        }
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
                        'tipo_tram' => isset($attributes->tipo_tram)?$attributes->tipo_tram:'S',
                        'despacho' => $attributes->despacho,
                        'status' => 'P'
                    ]);
                    if ($attributes->int_ext == 'I'){
                        $tram->id_departamento_origem = auth()->user()->id_departamento;
                        $tram->id_departamento_destino = $attributes->id_departamento;
                    }else if($attributes->int_ext == 'E'){
                        if ($attributes->tipo_tram == 'C'){
                            $tram->id_secretaria_origem = $attributes->id_secretaria;
                            $tram->id_departamento_destino = $attributes->id_departamento;
                        }else if($attributes->tipo_tram == 'S'){
                            $tram->id_departamento_origem = $attributes->id_departamento;
                            $tram->id_secretaria_destino = $attributes->id_secretaria;
                        }
                    }
                    $tram->save();
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
                    $documento->int_ext=='I'?'id_departamento_origem':'id_secretaria_origem' => $documento->int_ext=='I'?$documento->tramitacoes->last()->id_departamento_origem:$documento->tramitacoes->last()->id_secretaria_origem,
                    'id_departamento_destino' => $documento->tramitacoes->last()->id_departamento_destino,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'R',
                    'despacho' => $documento->tramitacoes->last()->despacho,
                    'status' => 'R'
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

    public function devolveDoc($attributes)
    {
        try {
            $documento = $this->documentoRepository->with('tramitacoes')->find($attributes->id);
            $dptOrigem = $documento->id_departamento;
            $documento->status = 'P';
            $documento->id_departamento = $documento->int_ext=='I'?$documento->tramitacoes->last()->id_departamento_origem:user_dpt($documento->tramitacoes->last()->id_usuario);
            if ($documento->save()) {
                $model = $this->tramitacaoRepository->create([
                    'data_tram' => date('d/m/Y'),
                    'id_documento' => $attributes->id,
                    $documento->int_ext=='I'?'id_departamento_origem':'id_secretaria_origem' => $documento->int_ext=='I'?$dptOrigem:$documento->tramitacoes->last()->id_secretaria_origem,
                    'id_departamento_destino' => $documento->tramitacoes->last()->id_departamento_origem,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'D',
                    'despacho' => $attributes->despacho,
                    'status' => 'P'
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
        if (in_admin_group()){
            $result = $this->documentoRepository->with('tramitacoes')->find($id);
        }else{
            $result = $this->documentoRepository->with('tramitacoes')->scopeQuery(function ($query){
                return $query->where('id_departamento',auth()->user()->id_departamento);
            })->findWithoutFail($id);
        }

        if(empty($result)){
            throw new GeneralException("Nenhum registro localizado no banco de dados ou Usuário sem permissão");
        }else{
            return $result;
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

    public function createTramitacao($attributes)
    {
        try {
            $documento = $this->documentoRepository->with('tramitacoes')->find($attributes->id_documento);
            $documento->status = 'P';
            $documento->id_departamento = $attributes->id_destino;
            if ($documento->save()) {
                $model = $this->tramitacaoRepository->create([
                    'data_tram' => date('d/m/Y'),
                    'id_documento' => $attributes->id_documento,
                    $documento->int_ext=='I'?'id_departamento_origem':'id_secretaria_origem' => $documento->int_ext=='I'?$documento->tramitacoes->last()->id_departamento_origem:$documento->tramitacoes->last()->id_secretaria_origem,
                    'id_departamento_destino' => $attributes->id_destino,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'D',
                    'despacho' => $attributes->despacho,
                    'status' => 'P'
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

}