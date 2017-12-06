<?php

namespace App\Domains\Protocolo\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoRepository;
use App\Domains\Protocolo\Services\TramitacaoService;
use Illuminate\Http\Request;

class ProcessoController extends Controller
{

    /**
     * @var TramitacaoService
     */
    public $tramitacaoService;

    /**
     * ProcessoController constructor.
     * @param TramitacaoService $tramitacaoService
     */
    public function __construct(
        TramitacaoService $tramitacaoService,
        DocumentoRepository $documentoRepository
    )
    {
        $this->tramitacaoService = $tramitacaoService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        if ($documento = $this->tramitacaoService->getDocProcesso($request)) {

            $arrAtributes = [];

            foreach ($documento as $doc){
                $arrAtributes[] = [
                    'id' => $doc->id,
                    'numero' => $doc->numero,
                    'ano' => $doc->ano,
                    'data_doc' => $doc->data_doc,
                    'assunto' => $doc->assunto,
                    'tipo_doc' => $doc->tipo_documento->descricao
                ];
            }

            return response()->json(['data' => $arrAtributes]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('processo.index')
            ->with('dados',$this->tramitacaoService->getDataCreate());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if($documento = $this->tramitacaoService->getCreateProcesso($id)){
            return view('processo.edit')
                ->with('documento',$documento);
        }else{
            return redirect()->route('admin.tramitacao')->with('error','Nenhum registro localizado');
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        if($this->tramitacaoService->postCreateProcesso($id, $request)){
            return redirect()->route('admin.tramitacao')->with('success', 'Documento cadastrado com sucesso!');
        }else{
            return redirect()->route('admin.tramitacao')->with('error','Erro ao realizar operação');
        }
    }

}
