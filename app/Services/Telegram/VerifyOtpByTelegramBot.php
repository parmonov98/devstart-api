<?php

namespace App\Services\Telegram;

use App\Services\Telegram\BaseTelegramClass\AbstractTelegram;

class VerifyOtpByTelegramBot extends AbstractTelegram {
    protected function getBot(): string {
        return config('telegram_bots.verify_otp');
    }

    public function setWebHook(): array {
        return [];
    }
}
