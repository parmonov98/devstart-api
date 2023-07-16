<?php

namespace App\Сonstants\Regex;

class RegexConstants {
    /**
     * @return string
     */
    public static function getPhoneRegex(): string {
        return "/^998[0-9]{2}[0-9]{7}$/";
    }
}
