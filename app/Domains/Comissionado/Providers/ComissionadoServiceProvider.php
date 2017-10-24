<?php
namespace App\Domains\Comissionado\Providers;

use App\Domains\Comissionado\Repositories\CargoComissionadoRepositoryEloquent;
use App\Domains\Comissionado\Repositories\Contracts\CargoComissionadoRepository;
use App\Domains\Comissionado\Repositories\Contracts\GrauInstrucaoRepository;
use App\Domains\Comissionado\Repositories\Contracts\LinhaOnibusRepository;
use App\Domains\Comissionado\Repositories\Contracts\NomenclaturaCargoRepository;
use App\Domains\Comissionado\Repositories\Contracts\RegimeTrabRepository;
use App\Domains\Comissionado\Repositories\Contracts\SecretariasRepository;
use App\Domains\Comissionado\Repositories\Contracts\ServidorRepository;
use App\Domains\Comissionado\Repositories\Contracts\TipoCargoRepository;
use App\Domains\Comissionado\Repositories\GrauInstrucaoRepositoryEloquent;
use App\Domains\Comissionado\Repositories\LinhaOnibusRepositoryEloquent;
use App\Domains\Comissionado\Repositories\NomenclaturaCargoRepositoryEloquent;
use App\Domains\Comissionado\Repositories\RegimeTrabRepositoryEloquent;
use App\Domains\Comissionado\Repositories\SecretariasRepositoryEloquent;
use App\Domains\Comissionado\Repositories\ServidorRepositoryEloquent;
use App\Domains\Comissionado\Repositories\TipoCargoRepositoryEloquent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Domains\Comissionado\ViewComposers\ServidoresComposer;

class ComissionadoServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Domains\Comissionado\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register all repositories for this module
     *
     */
    public function register()
    {
        $this->app->bind(CargoComissionadoRepository::class,CargoComissionadoRepositoryEloquent::class);
        $this->app->bind(GrauInstrucaoRepository::class,GrauInstrucaoRepositoryEloquent::class);
        $this->app->bind(NomenclaturaCargoRepository::class,NomenclaturaCargoRepositoryEloquent::class);
        $this->app->bind(RegimeTrabRepository::class,RegimeTrabRepositoryEloquent::class);
        $this->app->bind(SecretariasRepository::class,SecretariasRepositoryEloquent::class);
        $this->app->bind(TipoCargoRepository::class,TipoCargoRepositoryEloquent::class);
        $this->app->bind(LinhaOnibusRepository::class,LinhaOnibusRepositoryEloquent::class);
        $this->app->bind(ServidorRepository::class,ServidorRepositoryEloquent::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(app_path('Domains/Comissionado/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(app_path('Domains/Comissionado/Routes/api.php'));
    }
}
