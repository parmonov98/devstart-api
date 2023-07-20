<?php

namespace App\Tasks\User;

use App\Models\User;
use App\Сonstants\Exceptions\StatusCode;
use App\Exceptions\BusinessLogicException;

class GetUserByPhoneTask {
    /**
     * @param string $phone
     * @param array $relations
     * @return User
     * @throws BusinessLogicException
     */
    public function run(string $phone, array $relations = []): User {
        $user = User::query()->where('phone', '=', $phone)->with($relations)->first();

        if ($user === null) {
            throw new BusinessLogicException('Пользователь не существует', StatusCode::ERROR_NOT_FOUND);
        }

        return $user;
    }
}
