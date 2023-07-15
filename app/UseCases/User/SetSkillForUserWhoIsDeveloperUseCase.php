<?php

namespace App\UseCases\User;

use App\Models\Skill;
use App\Tasks\User\GetUserByPhoneTask;
use App\Exceptions\BusinessLogicException;
use App\Tasks\User\CheckUserTypeForDeveloperTask;

class SetSkillForUserWhoIsDeveloperUseCase {
    public function __construct(
        private GetUserByPhoneTask $getUserByPhoneTask,
        private CheckUserTypeForDeveloperTask $checkUserTypeForDeveloperTask
    ) {
    }

    /**
     * @throws BusinessLogicException
     */
    public function perform(string $phone, array $skill_ids): void {
        $user = $this->getUserByPhoneTask->run($phone);

        $this->checkUserTypeForDeveloperTask->run($user);

        if (Skill::query()->whereIn('id', $skill_ids)->count() != count($skill_ids)) {
            throw new BusinessLogicException('Навыка не существует');
        }

        $user->skills()->attach($skill_ids);
    }
}
