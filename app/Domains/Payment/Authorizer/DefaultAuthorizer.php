<?php

namespace App\Domains\Payment\Authorizer;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Domains\Payment\Interfaces\PaymentAuthorizerInterface;

class DefaultAuthorizer implements PaymentAuthorizerInterface
{
    private const OK = 'Autorizado';

    public function authorize(): bool
    {
        $authorizer = Http::get('https://run.mocky.io/v3/5794d450-d2e2-4412-8131-73d0293ac1cc');
        if ($authorizer->failed()) {
            throw new Exception('Failed to check permission.');
        }

        return ($authorizer['message'] === self::OK);
    }
}
