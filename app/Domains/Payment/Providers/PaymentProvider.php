<?php

namespace App\Domains\Payment\Providers;

use App\Domains\Payment\Authorizer\DefaultAuthorizer;
use App\Domains\Payment\Interfaces\PaymentAuthorizerInterface;
use Illuminate\Support\ServiceProvider;

class PaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentAuthorizerInterface::class, DefaultAuthorizer::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
