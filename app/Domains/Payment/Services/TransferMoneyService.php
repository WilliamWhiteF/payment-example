<?php

namespace App\Domains\Payment\Services;

use App\Domains\Payment\Exceptions\InvalidAmmountException;
use App\Domains\Payment\Exceptions\NotAuthorizedException;
use App\Domains\Payment\Exceptions\NotEnoughBalanceException;
use App\Domains\Payment\Interfaces\PaymentAuthorizerInterface;
use App\Domains\Payment\Models\User;
use App\Jobs\NotificationJob;
use App\Shared\Interfaces\ServicesInterface;
use Illuminate\Support\Facades\DB;
use Money;

class TransferMoneyService implements ServicesInterface
{
    public function __construct(
        private PaymentAuthorizerInterface $authorizer
    ) {}

    public function execute(User $from, User $receiver, Money $ammount): bool
    {
        if ($from->shopkeeper) {
            throw new NotAuthorizedException('Shopkeeper cant transfer');
        }

        if ($ammount->get() <= 0) {
            throw new InvalidAmmountException('Invalid Ammount');
        }

        if ($from->getBalance() < $ammount->get()) {
            throw new NotEnoughBalanceException('Not enought balance');
        }

        if (!$this->authorizer->authorize()) {
            throw new NotAuthorizedException('Not Authorized to perform this operation');
        }

        DB::transaction(function () use ($from, $receiver, $ammount) {
            $from->balance -= $ammount;
            $from->save();

            $receiver->balance += $ammount;
            $receiver->save();
        });

        NotificationJob::dispatch(
            $receiver,
            'Transferencia realizada no valor de ' . $ammount
        );

        return true;
    }
}
