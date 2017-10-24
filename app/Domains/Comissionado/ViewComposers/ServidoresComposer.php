<?php

namespace App\Domains\Comissionado\ViewComposers;

use Illuminate\View\View;
use App\Domains\Comissionado\Repositories\Contracts\CargoComissionadoRepository;
use App\Domains\Comissionado\Repositories\Contracts\GrauInstrucaoRepository;
use App\Domains\Comissionado\Repositories\Contracts\SecretariasRepository;
use App\Domains\Comissionado\Repositories\Contracts\NomenclaturaCargoRepository;
use App\Domains\Comissionado\Repositories\Contracts\TipoCargoRepository;

class ServidoresComposer
{
    /**
     * The user repository implementation.
     *
     * @var CargoComissionadoRepository
     */
    protected $cargoComissionado;

    /**
     * The user repository implementation.
     *
     * @var GrauInstrucaoRepository
     */
    protected $grausInstrucao;

    /**
     * The user repository implementation.
     *
     * @var SecretariasRepository
     */
    protected $secretarias;

    /**
     * The user repository implementation.
     *
     * @var NomenclaturaCargoRepository
     */
    protected $nomenclaturaCargo;

    /**
     * The user repository implementation.
     *
     * @var TipoCargoRepository
     */
    protected $tipoCargos;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
        CargoComissionadoRepository $cargoComissionado,
        GrauInstrucaoRepository $grausInstrucao,
        SecretariasRepository $secretarias,
        NomenclaturaCargoRepository $nomenclaturaCargo,
        TipoCargoRepository $tipoCargos
    )
    {
        // Dependencies automatically resolved by service container...
        $this->cargoComissionado = $cargoComissionado;
        $this->grausInstrucao = $grausInstrucao;
        $this->secretarias = $secretarias;
        $this->nomenclaturaCargo = $nomenclaturaCargo;
        $this->tipoCargos = $tipoCargos;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('cargosComissionado', $this->cargoComissionado->all());
        $view->with('grausInstrucao', $this->grausInstrucao->all());
        $view->with('secretarias', $this->secretarias->all());
        $view->with('nomenclaturaCargos', $this->nomenclaturaCargo->all());
        $view->with('tipoCargos', $this->tipoCargos->all());
    }
}