<?php

namespace App\Helpers;

class FormatHelper
{
    public static function sanitize(?string $value): string
    {
        return preg_replace('/[^\d]/', '', $value);
    }
}
