<?php

namespace App\Http\Requests\Api\User;

use App\Сonstants\Regex\RegexConstants;
use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest {
    /**
     * @return array[]
     */
    public function rules(): array {
        return [
            'phone' => ['required', 'string', 'regex:' . RegexConstants::getPhoneRegex()],
            'skill_ids' => ['required', 'array'],
            'skill_ids.*' => ['required', 'int'],
        ];
    }
}
