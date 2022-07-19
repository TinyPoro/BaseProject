<?php

namespace App\Providers;

use App\Repositories\TestRepository;
use App\Repositories\TestRepositoryInterface;
use App\Services\TestService;
use App\Services\TestServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
        $this->app->bind(TestServiceInterface::class, TestService::class);
    }
}
