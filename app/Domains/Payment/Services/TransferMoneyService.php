<?php

namespace App\Domains\Payment\Services;

use App\Domains\Payment\Dto\TransferMoneyDto;
use App\Domains\Payment\Exceptions\NotAuthorizedException;
use App\Domains\Payment\Exceptions\TransferException;
use App\Domains\Payment\Interfaces\PaymentAuthorizerInterface;
use App\Shared\Interfaces\ServicesInterface;
use App\Shared\Jobs\NotificationJob;
use Illuminate\Support\Facades\DB;

class TransferMoneyService implements ServicesInterface
{
    public function __construct(
        private PaymentAuthorizerInterface $authorizer
    ) {}

    public function execute(TransferMoneyDto $dto): bool
    {
        if ($dto->from->shopkeeper) {
            throw new NotAuthorizedException('Shopkeeper cant transfer');
        }

        if ($dto->ammount->get() <= 0) {
            throw new TransferException('Invalid Ammount');
        }

        if ($dto->from->balance < $dto->ammount->get()) {
            throw new TransferException('Not enought balance');
        }

        if (!$this->authorizer->authorize()) {
            throw new NotAuthorizedException('Not Authorized to perform this operation');
        }

        DB::transaction(function () use ($dto) {
            $dto->from->balance -= $dto->ammount->get();
            $dto->from->save();

            $dto->receiver->balance += $dto->ammount->get();
            $dto->receiver->save();
        });

        NotificationJob::dispatch(
            $dto->receiver,
            'Transferencia realizada no valor de ' . $dto->ammount
        );

        return true;
    }
}
