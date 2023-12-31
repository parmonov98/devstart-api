<?php

namespace App\Http\Requests\Api\User;

use App\Сonstants\Regex\RegexConstants;
use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest {
    public function rules(): array {
        return [
            'phone' => ['required', 'string', 'regex:' . RegexConstants::getPhoneRegex()],
            'code' => ['integer', 'min:4'],
        ];
    }
}
