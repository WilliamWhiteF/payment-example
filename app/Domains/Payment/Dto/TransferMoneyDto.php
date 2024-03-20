<?php

namespace App\Domains\Payment\Dto;

use App\Domains\Payment\Models\User;
use App\Domains\Payment\ValueObject\Money;
use Illuminate\Http\Request;

class TransferMoneyDto
{
    public function __construct(
        public readonly User $from,
        public readonly User $receiver,
        public readonly Money $ammount,
    ) {}

    public function toArray()
    {
        return [
            'from' => $this->from,
            'receiver' => $this->receiver,
            'ammount' => $this->ammount,
        ];
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            User::findOrFail($request->from),
            User::findOrFail($request->receiver),
            Money::createFrom($request->value)
        );
    }
}
