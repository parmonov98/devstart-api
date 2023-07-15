<?php

namespace App\Http\Controllers\ApiController\Skill;

use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use App\Exceptions\BusinessLogicException;
use App\Http\Requests\Api\User\SkillRequest;
use App\UseCases\User\SetSkillForUserWhoIsDeveloperUseCase;

class SkillController {
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $skills = Skill::query()->whereNull('parent_skill')->with('children')->get();

        return new JsonResponse($skills);
    }

    /**
     * @param SkillRequest $request
     * @param SetSkillForUserWhoIsDeveloperUseCase $useCase
     * @throws BusinessLogicException
     */
    public function setSkillForUserWhoIsDeveloper(
        SkillRequest $request,
        SetSkillForUserWhoIsDeveloperUseCase $useCase
    ): void {
        $useCase->perform($request->input('phone'), $request->input('skill_ids'));
    }

    public function store() {
    }

    public function show(int $id) {
    }

    public function update(int $id) {
    }

    public function remove(int $id) {
    }
}
