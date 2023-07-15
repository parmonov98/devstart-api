<?php

namespace App\Tasks\User;

use App\Models\User;
use App\Exceptions\BusinessLogicException;
use App\Сonstants\User\UserTypeConstants;

class CheckUserTypeForDeveloperTask {
    /**
     * @param User $user
     * @throws BusinessLogicException
     */
    public function run(User $user): void {
        if ($user->user_type != UserTypeConstants::USER_TYPE_DEVELOPER) {
            throw new BusinessLogicException('Вы не являетесь разработчиком');
        }
    }
}
