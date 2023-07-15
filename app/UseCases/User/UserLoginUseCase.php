<?php

namespace App\UseCases\User;

use Illuminate\Support\Facades\Hash;
use App\Tasks\User\GetUserByPhoneTask;
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

        if ($user->user_type == UserTypeConstants::USER_TYPE_DEVELOPER && $user->skills->count() == 0) {
            throw new BusinessLogicException('Добавьте свои навыки');
        }

        if (!Hash::check($password, $user->password)) {
            throw new BusinessLogicException('Не правильный пароль');
        }

        return  $user->createToken('DevstartApiApp')->plainTextToken;
    }
}
