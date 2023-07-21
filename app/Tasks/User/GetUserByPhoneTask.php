<?php

namespace App\Tasks\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GetUserByPhoneTask
{
    /**
     * @param string $phone
     * @param array $relations
     *
     * @return Builder|Model
     */
    public function run(string $phone, array $relations = []): Model|Builder
    {
        return User::query()->where('phone', $phone)->with($relations)->firstOrFail();
    }
}
