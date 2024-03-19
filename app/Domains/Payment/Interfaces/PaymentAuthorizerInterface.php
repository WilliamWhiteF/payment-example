<?php

namespace App\Domains\Payment\Interfaces;

interface PaymentAuthorizerInterface
{
    public function authorize(): bool;
}
