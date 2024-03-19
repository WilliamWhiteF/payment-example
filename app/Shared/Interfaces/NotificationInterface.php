<?php

namespace App\Shared\Interfaces;

use App\Domains\Payment\Models\User;

interface NotificationInterface {
    public function notify(User $user, string $message): bool;
}
