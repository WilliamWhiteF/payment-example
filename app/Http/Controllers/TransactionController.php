<?php

namespace App\Http\Controllers;

use App\Domains\Payment\Services\TransferMoneyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Money;

class TransactionController extends Controller
{
    public function __construct(
        private TransferMoneyService $transferMoney
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required|decimal:8,2',
            'from' => 'required|exists:\App\Domains\Payment\Models\User,id',
            'to' => 'required|exists:\App\Domains\Payment\Models\User,id'
        ]);

        try {
            $this->transferMoney->execute(
                $validated['from'],
                $validated['to'],
                Money::createFrom($validated['value'])
            );
        } catch (\Exception $e) {
            Log::error("[TRANSFER ERROR] {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}");
            // passar o tratamento do código para a exception
            return response('', 500);
        }

        return response('', 201);
    }
}
