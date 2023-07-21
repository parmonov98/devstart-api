<?php

namespace App\Tasks\Sms;

use Exception;
use App\Models\User;
use App\Models\SmsVerification;
use Illuminate\Http\Client\RequestException;
use App\Services\Telegram\VerifyOtpByTelegramBot;

class CreateAndSendSmsTask {
    /**
     * @param VerifyOtpByTelegramBot $telegramBot
     */
    public function __construct(
        private VerifyOtpByTelegramBot $telegramBot
    ) {
    }

    /**
     * @param User $user
     * @throws RequestException
     * @throws Exception
     */
    public function run(User $user): void {
        if ($user->sms) {
            $sms = $user->sms;
            $sms->expired_at = now()->addMinutes(5);
        } else {
            $sms = new SmsVerification();
            $sms->user_id = $user->id;
        }
        $sms->code = random_int(1000, 9999);
        $sms->save();
        $this->telegramBot->sendMessage(
            [
                'chat_id' => config('telegram_bots.channels.DevStartOtp'),
                'text' => $sms->code,
            ]
        );
    }
}
