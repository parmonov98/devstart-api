<?php

namespace App\Http\Controllers\ApiController\User;

use Illuminate\Http\Request;
use App\DTO\User\UserRegisterDTO;
use Illuminate\Http\JsonResponse;
use App\UseCases\User\UserLoginUseCase;
use App\Exceptions\BusinessLogicException;
use App\UseCases\User\UserRegistrationUseCase;
use App\Http\Requests\Api\User\UserLoginRequest;
use App\Http\Requests\Api\User\UserRegisterRequest;
use App\Http\Controllers\BaseController\ApiController;

class UserController extends ApiController {
    /**
     * @param UserRegisterRequest $request
     * @param UserRegistrationUseCase $useCase
     * @return void
     * @throws BusinessLogicException
     */
    public function userRegistration(UserRegisterRequest $request, UserRegistrationUseCase $useCase): void {
        $dto = (new UserRegisterDTO(
            $request->integer('name'),
            $request->input('password'),
            $request->input('user_type'),
            $request->input('phone')
        ))->setEmail($request->input('email'))
            ->setEmailVerifiedAt($request->input('email_verified_at'))
            ->setPhoneVerifiedAt($request->input('phone_verified_at'));

        $useCase->perform($dto);
    }

    /**
     * @param UserLoginRequest $request
     * @param UserLoginUseCase $useCase
     * @return JsonResponse
     * @throws BusinessLogicException
     */
    public function userLogin(UserLoginRequest $request, UserLoginUseCase $useCase): JsonResponse {
        $token = $useCase->perform($request->input('phone'), $request->input('password'));

        return $this->responseWithToken($token);
    }

    public function verifyOtp(Request $request, UserLoginUseCase $useCase): JsonResponse {
    }
}
