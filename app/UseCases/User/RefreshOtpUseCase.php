<?php

namespace App\UseCases\User;

use App\Tasks\User\GetUserByPhoneTask;
use App\Tasks\Sms\CreateAndSendSmsTask;

class RefreshOtpUseCase {
    public function __construct(
        private GetUserByPhoneTask $getUserByPhoneTask,
        private CreateAndSendSmsTask $createAndSendSmsTask
    ) {
    }

    public function perform(string $phone) {
        $user = $this->getUserByPhoneTask->run($phone, ['sms']);

        $this->createAndSendSmsTask->run($user);
    }
}
