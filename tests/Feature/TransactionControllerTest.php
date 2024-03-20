<?php

namespace Tests\Feature;

use App\Domains\Payment\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $from;
    private User $receiver;
    private User $shopkeeper;

    public function setUp(): void
    {
        parent::setUp();

        $this->from = User::factory()->create([
            'balance' => 2000
        ]);

        $this->receiver = User::factory()->create();

        $this->shopkeeper = User::factory()
            ->shopkeeper()
            ->create();
    }

    public function test_can_transfer_money_from_one_another(): void
    {
        $response = $this->post('/api/transaction', [
            'value' => "10.50",
            'from' => $this->from->id,
            'receiver' => $this->receiver->id,
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(201);
    }

    public function test_shopkeeper_not_authorized_to_transfer_returns_unauthorized(): void
    {
        $response = $this->post('/api/transaction', [
            'value' => "10.50",
            'from' => $this->shopkeeper->id,
            'receiver' => $this->receiver->id,
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertForbidden();
    }

    public function test_not_enought_balance_returns_bad_request(): void
    {
        $response = $this->post('/api/transaction', [
            'value' => "1000.00",
            'from' => $this->from->id,
            'receiver' => $this->receiver->id,
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertBadRequest();
    }
}
