<?php
namespace App\Domains\Protocolo\Providers;

use App\Domains\Protocolo\Repositories\Contracts\TramitacaoRepository;
use App\Domains\Protocolo\Repositories\TramitacaoRepositoryEloquent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Domains\Protocolo\Repositories\Contracts\DepartamentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\TipoDocumentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\SecretariasRepository;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoAnexoRepository;
use App\Domains\Protocolo\Repositories\DepartamentoRepositoryEloquent;
use App\Domains\Protocolo\Repositories\TipoDocumentoRepositoryEloquent;
use App\Domains\Protocolo\Repositories\DocumentoRepositoryEloquent;
use App\Domains\Protocolo\Repositories\SecretariasRepositoryEloquent;
use App\Domains\Protocolo\Repositories\DocumentoAnexoRepositoryEloquent;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ProtocoloServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Domains\Protocolo\Controllers';

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
        $this->app->bind(DepartamentoRepository::class,DepartamentoRepositoryEloquent::class);
        $this->app->bind(TipoDocumentoRepository::class,TipoDocumentoRepositoryEloquent::class);
        $this->app->bind(DocumentoRepository::class,DocumentoRepositoryEloquent::class);
        $this->app->bind(SecretariasRepository::class,SecretariasRepositoryEloquent::class);
        $this->app->bind(DocumentoAnexoRepository::class,DocumentoAnexoRepositoryEloquent::class);
        $this->app->bind(TramitacaoRepository::class,TramitacaoRepositoryEloquent::class);
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
             ->group(app_path('Domains/Protocolo/Routes/web.php'));
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
             ->group(app_path('Domains/Protocolo/Routes/api.php'));
    }
}
