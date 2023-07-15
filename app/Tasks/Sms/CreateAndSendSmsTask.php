<?php

namespace App\Tasks\Sms;

use Exception;
use App\Models\User;
use App\Models\SmsVerification;

class CreateAndSendSmsTask {
    /**
     * @throws Exception
     */
    public function run(User $user): void {
        $sms = new SmsVerification();
        $sms->user_id = $user->id;
        $sms->code = random_int(1000, 9999);
        $sms->save();
    }
}
