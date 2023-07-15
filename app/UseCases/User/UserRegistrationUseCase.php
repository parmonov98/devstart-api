<?php

namespace App\UseCases\User;

use Exception;
use App\Models\User;
use App\DTO\User\UserRegisterDTO;
use Illuminate\Support\Facades\Hash;
use App\Tasks\User\CheckUserPhoneTask;
use App\Tasks\Sms\CreateAndSendSmsTask;
use App\Exceptions\BusinessLogicException;

class UserRegistrationUseCase {
    /**
     * @param CheckUserPhoneTask $checkUserPhoneTask
     * @param CreateAndSendSmsTask $createAndSendSmsTask
     */
    public function __construct(
        private CheckUserPhoneTask $checkUserPhoneTask,
        private CreateAndSendSmsTask $createAndSendSmsTask
    ) {
    }

    /**
     * @param UserRegisterDTO $DTO
     * @throws BusinessLogicException
     * @throws Exception
     */
    public function perform(UserRegisterDTO $DTO): void {
        $this->checkUserPhoneTask->run($DTO->getPhone());

        $user = new User();
        $user->name = $DTO->getName();
        $user->phone = $DTO->getPhone();
        $user->email = $DTO->getEmail();
        $user->user_type = $DTO->getUserType();
        $user->password = Hash::make($DTO->getPassword());
        $user->phone_verified_at = $DTO->getPhoneVerifiedAt();
        $user->email_verified_at = $DTO->getEmailVerifiedAt();
        $user->save();

        $this->createAndSendSmsTask->run($user);
    }
}
