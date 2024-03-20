<?php

namespace App\Shared\Jobs;

use App\Domains\Payment\Models\User;
use App\Shared\Interfaces\NotificationInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly User $receiver,
        private readonly string $message
    ) { }

    /**
     * Realiza a notificação configurada no DI do projeto
     *
     * @param User $receiver quem deve receber a notificação
     * @param string $message a mensagem a ser enviada
     */
    public function handle(NotificationInterface $notification): void
    {
        Log::info("[NOTIFICATION] {$this->receiver->cpf} - {$this->message}");
        $notification->notify($this->receiver, $this->message);
    }
}
