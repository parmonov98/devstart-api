<?php

namespace App\UseCases\User;

use App\Tasks\User\GetUserByPhoneTask;
use App\Exceptions\BusinessLogicException;

class UserVerifyOtpUseCase {
    public function __construct(
        private GetUserByPhoneTask $getUserByPhoneTask
    ) {
    }

    /**
     * @param string $phone
     * @param int $code
     * @return string
     * @throws BusinessLogicException
     */
    public function perform(string $phone, int $code): string {
        $user = $this->getUserByPhoneTask->run($phone, ['sms']);

        if (is_null($user->sms)) {
            throw new BusinessLogicException('Для этого пользователя нет код для подтверждения ' . $phone);
        }

        if ($user->sms->expired_at < now()) {
            throw new BusinessLogicException('Время подтверждения кода истекло');
        }

        if ($user->sms->code !== $code) {
            throw new BusinessLogicException('Код подтверждения не правильный');
        }

        $user->phone_verified_at = now();
        $user->save();

        return $user->createToken('DevStartApi')->plainTextToken;
    }
}
