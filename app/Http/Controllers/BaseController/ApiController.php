<?php

namespace App\Http\Controllers\BaseController;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller {
    protected function responseWithToken(string $token): JsonResponse {
        $response = [
            'token' => $token,
        ];

        return new JsonResponse($response);
    }
}
