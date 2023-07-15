<?php

namespace App\Tasks\User;

use App\Models\User;
use App\Exceptions\BusinessLogicException;

class CheckUserPhoneTask {
    /**
     * @throws BusinessLogicException
     */
    public function run(string $phone): void {
        if (User::query()->where('phone', '=', $phone)->first()) {
            throw new BusinessLogicException('Пользователь уже существует');
        }
    }
}
