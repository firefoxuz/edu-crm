<?php

namespace Modules\User\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\User\Console\CreateAdminCommand;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Services\Login\LoginContract;
use Modules\User\Services\Login\LoginService;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(LoginContract::class, function ($app) {
            return new LoginService(
                $app->make(LoginRequest::class),
                $app->make(User::class)
            );
        });
        $this->commands([
            CreateAdminCommand::class
        ]);
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
