<?php

namespace Tests\Unit\Domains\Payment\Actions;

use Tests\TestCase;
use App\Domains\Payment\Actions\TransferMoney;

class TransferMoneyTest extends TestCase
{
    private TransferMoney $transferMoney;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Usuarios devem poder transferir para outros usuarios
     */
    public function test_user_to_user_successful(): void
    {
        $this->assertTrue(false);
    }

    /**
     * Usuarios devem poder transferir para lojistas
     */
    public function test_user_to_shopkeeper_successful(): void
    {
        $this->assertTrue(false);
    }

    /**
     * Usuarios devem possuir saldo antes de transferir
     */
    public function test_user_transfer_failed_not_enought_balance(): void
    {
        $this->assertTrue(false);
    }

    /**
     * Lojistas não devem poder transferir, apenas receber
     */
    public function test_shopkeeper_cannot_transfer(): void
    {
        $this->assertTrue(false);
    }
}
