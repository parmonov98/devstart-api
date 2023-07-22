<?php

namespace App\UseCases\User;

use Illuminate\Support\Facades\Hash;
use App\Tasks\User\GetUserByPhoneTask;
use App\Сonstants\Exceptions\StatusCode;
use App\Exceptions\BusinessLogicException;
use App\Сonstants\User\UserTypeConstants;

class UserLoginUseCase {
    public function __construct(
        private GetUserByPhoneTask $getUserByPhoneTask
    ) {
    }

    /**
     * @param string $phone
     * @param string $password
     * @return string
     * @throws BusinessLogicException
     */
    public function perform(string $phone, string $password): string {
        $user = $this->getUserByPhoneTask->run($phone, ['skills']);

        if (is_null($user->phone_verified_at)) {
            throw new BusinessLogicException('Подтвердите свой номер телефона', StatusCode::ERROR_NEED_PHONE_VERIFICATION);
        }

        if ($user->user_type === UserTypeConstants::USER_TYPE_DEVELOPER && $user->skills->count() === 0) {
            throw new BusinessLogicException('Добавьте свои навыки', StatusCode::ERROR_NEED_DEVELOPER_SKILL);
        }

        if (!Hash::check($password, $user->password)) {
            throw new BusinessLogicException('Не правильный пароль', StatusCode::ERROR_INVALID_PASSWORD);
        }

        return  $user->createToken('DevStartApiApp')->plainTextToken;
    }
}
