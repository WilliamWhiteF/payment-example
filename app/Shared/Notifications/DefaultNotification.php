<?php

namespace App\Shared\Notifications;

use Exception;
use App\Domains\Payment\Models\User;
use Illuminate\Support\Facades\Http;
use App\Shared\Interfaces\NotificationInterface;

class DefaultNotification implements NotificationInterface
{
    /**
     * Realiza a notificação usando o método padrão
     *
     * @param User $receiver quem deve receber a notificação
     * @param string $message a mensagem a ser enviada
     */
    public function notify(User $user, string $message): bool
    {
        $notifier = Http::get('https://run.mocky.io/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6');
        if ($notifier->failed()) {
            throw new Exception('Failed to notify');
        }

        return (bool) $notifier['message'];
    }
}
