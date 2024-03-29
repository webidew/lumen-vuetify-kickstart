<?php

namespace App\Providers;

use App\Models\Members\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

use Nomadnt\LumenPassport\Passport;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        // $this->app['auth']->viaRequest('api', function ($request) {
        //     if ($request->input('api_token')) {
        //         return User::where('api_token', $request->input('api_token'))->first();
        //     }
        // });

        // register passport routes
        Passport::routes(function($router) {
            $router->forAccessTokens();
        });

        
        // register passport routes
        // Passport::routes();

        // change the default token expiration
        Passport::tokensExpireIn(Carbon::now()->addDays(15));

        // change the default refresh token expiration
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
