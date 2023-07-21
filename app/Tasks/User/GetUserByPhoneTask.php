<?php

namespace App\Tasks\User;

use App\Exceptions\BusinessLogicException;
use App\Models\User;
use App\Сonstants\Exceptions\StatusCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GetUserByPhoneTask
{
    /**
     * @param string $phone
     * @param array $relations
     *
     * @return Builder|Model
     * @throws BusinessLogicException
     */
    public function run(string $phone, array $relations = []): Model|Builder
    {
        $user = User::query()->where('phone', '=', $phone)->with($relations)->first();

        if (is_null($user)) {
            throw new BusinessLogicException('Пользователь не существует', StatusCode::ERROR_NOT_FOUND);
        }

        return $user;
    }
}
