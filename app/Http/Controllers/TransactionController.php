<?php

namespace App\Http\Controllers;

use App\Domains\Payment\Dto\TransferMoneyDto;
use App\Domains\Payment\Exceptions\NotAuthorizedException;
use App\Domains\Payment\Exceptions\TransferException;
use App\Domains\Payment\Services\TransferMoneyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'value' => 'required|decimal:2|min:0.1',
            'from' => 'required|exists:\App\Domains\Payment\Models\User,id',
            'receiver' => 'required|exists:\App\Domains\Payment\Models\User,id'
        ]);

        try {
            $dto = TransferMoneyDto::fromRequest($request);
            $this->transferMoney->execute($dto);
        } catch (NotAuthorizedException $e) {
            Log::error("[TRANSFER-ERROR] {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}");

            return response($e->getMessage(), 403);
        } catch (TransferException $e) {
            Log::error("[TRANSFER-ERROR] {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}");

            return response($e->getMessage(), 400);
        } catch (\Exception $e) {
            Log::error("[TRANSFER-UNKNOWN-ERROR] {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}");

            return response('Ocorreu um erro inesperado.', 500);
        }

        return response('', 201);
    }
}
