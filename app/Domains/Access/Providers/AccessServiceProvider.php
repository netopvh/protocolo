<?php
namespace App\Domains\Access\Providers;

use App\Domains\Access\Repositories\Contracts\PermissionGroupRepository;
use App\Domains\Access\Repositories\Contracts\PermissionRepository;
use App\Domains\Access\Repositories\Contracts\RoleRepository;
use App\Domains\Access\Repositories\Contracts\UserRepository;
use App\Domains\Access\Repositories\PermissionGroupRepositoryEloquent;
use App\Domains\Access\Repositories\PermissionRepositoryEloquent;
use App\Domains\Access\Repositories\RoleRepositoryEloquent;
use App\Domains\Access\Repositories\UserRepositoryEloquent;
use App\Domains\Access\Repositories\Contracts\AuditRepository;
use App\Domains\Access\Repositories\AuditRepositoryEloquent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Domains\Access\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Register all repositories for this module
     *
     */
    public function register()
    {
        $this->app->bind(UserRepository::class,UserRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->bind(PermissionRepository::class, PermissionRepositoryEloquent::class);
        $this->app->bind(PermissionGroupRepository::class, PermissionGroupRepositoryEloquent::class);
        $this->app->bind(AuditRepository::class, AuditRepositoryEloquent::class);
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
             ->group(app_path('Domains/Access/Routes/web.php'));
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
             ->group(app_path('Domains/Access/Routes/api.php'));
    }
}
