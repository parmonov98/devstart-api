<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Validation\Rule;
use App\Сonstants\Regex\RegexConstants;
use App\Сonstants\User\UserTypeConstants;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest {
    /**
     * @return array[]
     */
    public function rules(): array {
        return [
            'name' => ['required', 'string'],
            'email' => ['nullable', 'string'],
            'phone' => ['required', 'string', 'regex:' . RegexConstants::getPhoneRegex()],
            'email_verified_at' => ['nullable', 'string'],
            'phone_verified_at' => ['nullable', 'string'],
            'password' =>['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
            'user_type' => ['string', 'required', Rule::in([UserTypeConstants::USER_TYPE_DEVELOPER, UserTypeConstants::USER_TYPE_IDEA_HOLDER])],
        ];
    }
}
