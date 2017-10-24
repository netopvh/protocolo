<?php

namespace App\Core\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Repositories\BaseRepositoryContract;
use App\Core\Repositories\BaseRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryContract::class,BaseRepository::class);
    }
}
