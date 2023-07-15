<?php

namespace App\Сonstants\Regex;

class RegexConstants {
    /**
     * @return string
     */
    public static function getPhoneRegex(): string {
        return "/^998([378]{2}|(9[013-57-9]))\d{7}$/";
    }
}
