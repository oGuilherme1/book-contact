<?php

namespace Src\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Users\Application\UseCases\User\CreateUserUseCase;
use Src\Users\Domain\UserGateway;
use Src\Users\Infra\Repositories\UserRepository;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateUserUseCase::class, function ($app) {
            return CreateUserUseCase::create($app->make(UserGateway::class));
        });

        $this->app->singleton(CreateUserUseCase::class, function ($app) {
            return CreateUserUseCase::create($app->make(UserGateway::class));
        });

        $this->app->singleton(UserGateway::class, function () {
            return new UserRepository();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
