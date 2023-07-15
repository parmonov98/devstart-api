<?php

namespace App\Http\Requests\Api\User;

use App\Сonstants\Regex\RegexConstants;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest {
    /**
     * @return array[]
     */
    public function rules(): array {
        return [
            'phone' => ['required', 'string', 'regex:' . RegexConstants::getPhoneRegex()],
            'password' => ['string', 'min:6'],
        ];
    }
}
