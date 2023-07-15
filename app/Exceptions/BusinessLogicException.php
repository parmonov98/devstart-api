<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class BusinessLogicException extends \Exception {
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse {
        return new JsonResponse([
            'message' => $this->getMessage(),
        ], 500);
    }
}
