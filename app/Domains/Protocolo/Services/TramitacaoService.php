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
        $docsSetor = $this->documentoRepository->query()
            ->departamento()
            ->where('arquivado', false)
            ->where('status', '=', 'R')
            ->where('ano','=',date('Y'))
            ->get()
            ->count();


        $pendentes = $this->documentoRepository->query()
            ->departamento()
            ->where('arquivado', false)
            ->where('status', 'P')
            ->where('ano','=',date('Y'))
            ->get()
            ->count();

        $arquivado = $this->documentoRepository->query()
            ->departamento()
            ->where('arquivado', true)
            ->where('ano','=',date('Y'))
            ->get()
            ->count();

        $enviados = $this->documentoRepository->query()
            ->departamento()
            ->where('status', 'S')
            ->where('ano','=',date('Y'))
            ->get()
            ->count();

        $arrDados = [
            'noSetor' => $docsSetor,
            'pendentes' => $pendentes,
            'arquivado' => $arquivado,
            'enviados' => $enviados
        ];

        return $arrDados;
    }

    public function builder()
    {
        return $this->documentoRepository
            ->with(['tipo_documento', 'departamento_origem', 'secretaria_origem'])
            ->query()
            ->departamento()
            ->where('status', 'R')
            ->where('arquivado', false);
    }

    public function builderPendents()
    {
        return $this->documentoRepository
            ->with(['tipo_documento', 'departamento_origem', 'secretaria_origem'])
            ->query()
            ->departamento()
            ->where('status', 'P')
            ->where('arquivado', false)
            ->orderBy('prioridade','desc');
    }

    public function builderArquivados()
    {
        return $this->documentoRepository
            ->with(['tipo_documento', 'departamento_origem', 'secretaria_origem'])
            ->query()
            ->departamento()
            ->where('arquivado', true);
    }

    public function builderEnviados()
    {
        return $this->documentoRepository
            ->with(['tipo_documento', 'departamento_origem', 'secretaria_origem'])
            ->query()
            ->departamento()
            ->where('status','S');
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
                $documento->status = $attributes->tipo_tram == 'O' ? 'S' : 'P';
                if ($documento->save()) {
                    if($documento->id_tipo_doc == 11 || $documento->id_tipo_doc == 13){
                        $documento->secretarias()->sync($attributes->secretarias);
                    }
                    $tram = $this->tramitacaoRepository->create([
                        'data_tram' => date('d/m/Y'),
                        'id_documento' => $documento->id,
                        'id_usuario' => auth()->user()->id,
                        'tipo_tram' => isset($attributes->tipo_tram) ? $attributes->tipo_tram : 'S',
                        'despacho' => $attributes->despacho,
                        'status' => $attributes->tipo_tram == 'O' ? 'S' : 'P'
                    ]);
                    if ($attributes->int_ext == 'I') {
                        $tram->id_departamento_origem = auth()->user()->id_departamento;
                        $tram->id_departamento_destino = $attributes->id_departamento;
                    } else if ($attributes->int_ext == 'E') {
                        if ($attributes->tipo_tram == 'C') {
                            $tram->id_secretaria_origem = $attributes->id_secretaria;
                            $tram->id_departamento_destino = $attributes->id_departamento;
                        } else if ($attributes->tipo_tram == 'O') {
                            $tram->id_departamento_origem = $attributes->id_departamento;
                            $tram->id_secretaria_destino = $attributes->id_secretaria;
                        }
                    }
                    $tram->save();
                }
            }
            return $documento;
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
                    $documento->int_ext == 'I' ? 'id_departamento_origem' : 'id_secretaria_origem' => $documento->int_ext == 'I' ? $documento->tramitacoes->first()->id_departamento_origem : $documento->tramitacoes->first()->id_secretaria_origem,
                    'id_departamento_destino' => $documento->tramitacoes->first()->id_departamento_destino,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'R',
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
            $documento->id_departamento = $documento->int_ext == 'I' ? $documento->tramitacoes->first()->id_departamento_origem : user_dpt($documento->tramitacoes->first()->id_usuario);
            if ($documento->save()) {
                $model = $this->tramitacaoRepository->create([
                    'data_tram' => date('d/m/Y'),
                    'id_documento' => $attributes->id,
                    $documento->int_ext == 'I' ? 'id_departamento_origem' : 'id_secretaria_origem' => $documento->int_ext == 'I' ? $dptOrigem : $documento->tramitacoes->first()->id_secretaria_origem,
                    'id_departamento_destino' => $documento->int_ext == 'I' ? $documento->tramitacoes->first()->id_departamento_origem : user_dpt($documento->tramitacoes->first()->id_usuario),
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
        $result = $this->documentoRepository->with('tramitacoes')
            ->query()
            ->departamento()
            ->find($id);

        if (empty($result)) {
            throw new GeneralException("Nenhum registro localizado no banco de dados ou Usuário sem permissão");
        } else {
            return $result;
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
                    $documento->int_ext == 'I' ? 'id_departamento_origem' : 'id_secretaria_origem' => $documento->int_ext == 'I' ? $documento->tramitacoes->first()->id_departamento_destino : $documento->tramitacoes->first()->id_secretaria_origem,
                    'id_departamento_destino' => $attributes->id_destino,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'P',
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

    public function arquivaDoc($id, $attributes)
    {
        try {
            $documento = $this->documentoRepository->with('tramitacoes')->find($id);
            $documento->arquivado = true;
            $documento->local_arquiv = $attributes->local_arquiv;
            if ($documento->save()) {
                $model = $this->tramitacaoRepository->create([
                    'data_tram' => date('d/m/Y'),
                    'id_documento' => $documento->id,
                    $documento->int_ext == 'I' ? 'id_departamento_origem' : 'id_secretaria_origem' => $documento->int_ext == 'I' ? $documento->tramitacoes->first()->id_departamento_origem : $documento->tramitacoes->first()->id_secretaria_origem,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'A',
                    'despacho' => $attributes->despacho,
                    'status' => 'A'
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

    public function getConsultaPublica($attributes)
    {
        try {
            $tramitacao = $this->documentoRepository
                ->with(['tipo_documento', 'tramitacoes'])
                ->query()
                ->where('numero', $attributes->numero)
                ->where('ano', $attributes->ano)
                ->orWhere(function ($query) use ($attributes){
                    if($attributes->has('int_ext')){
                        $query->where('int_ext', $attributes->int_ext);
                    }elseif ($attributes->has('assunto')){
                        $query->where('assunto','like', '%'.$attributes->assunto.'%');
                    }
                })
                ->get();


            if (empty($tramitacao)) {
                return false;
            } else {
                return $tramitacao;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function getDocProcesso($attributes)
    {
        try {
            $tramitacao = $this->documentoRepository
                ->with(['tipo_documento', 'tramitacoes'])
                ->query()
                ->departamento()
                ->where('numero', $attributes->numero)
                ->where('ano', $attributes->ano)
                ->orWhere(function ($query) use ($attributes){
                    if($attributes->has('int_ext')){
                        $query->where('int_ext', $attributes->int_ext);
                    }
                })
                ->get();


            if (count($tramitacao) < 1) {
                return false;
            } else {
                return $tramitacao;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function getCreateProcesso($id)
    {
        try {
            $documento = $this->documentoRepository
                ->query()
                ->departamento()
                ->find($id);

            if (empty($documento)) {
                return false;
            } else {
                return $documento;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    public function postCreateProcesso($id, $attributes)
    {
        try {
            $documento = $this->documentoRepository->with('tramitacoes')->find($id);
            $documento->processo = true;
            $documento->num_processo = $attributes->num_processo;
            if ($documento->save()) {
                $model = $this->tramitacaoRepository->create([
                    'data_tram' => date('d/m/Y'),
                    'id_documento' => $documento->id,
                    $documento->int_ext == 'I' ? 'id_departamento_origem' : 'id_secretaria_origem' => $documento->int_ext == 'I' ? $documento->tramitacoes->first()->id_departamento_origem : $documento->tramitacoes->first()->id_secretaria_origem,
                    'id_usuario' => auth()->user()->id,
                    'tipo_tram' => 'U',
                    'despacho' => $attributes->despacho,
                    'status' => 'A'
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

    public function getDespacho($attributes)
    {
        try {
            $tramitacao = $this->tramitacaoRepository->query()->find($attributes->id);

            if (empty($tramitacao)) {
                return false;
            } else {
                return $tramitacao;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function getDocumento($id)
    {
        $result = $this->documentoRepository->with('tramitacoes')
            ->query()
            ->find($id);

        if (empty($result)) {
            throw new GeneralException("Nenhum registro localizado no banco de dados ou Usuário sem permissão");
        } else {
            return $result;
        }
    }
}