<?php

namespace App\Services\Telegram;

use App\Services\Telegram\BaseTelegramClass\AbstractTelegram;

class VerifyOtpByTelegramBot extends AbstractTelegram {
    /**
     * @return string
     */
    protected function getBot(): string {
        return config('telegram_bots.verify_otp');
    }

    /**
     * @return array
     */
    public function setWebHook(): array {
        return [];
    }
}
