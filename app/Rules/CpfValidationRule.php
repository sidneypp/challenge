<?php

namespace App\Rules;

use App\Helpers\FormatHelper;
use Illuminate\Validation\Rule;

class CpfValidationRule extends Rule
{

    /**
     * @param $attribute
     * @param $value
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function passes($attribute, $value): bool
    {
        $cpfWithoutMask = FormatHelper::sanitize($value);
        if ($this->hasInvalidSize($cpfWithoutMask)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $cpfWithoutMask[$i++] * $s--) {
        }

        if ($cpfWithoutMask[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $cpfWithoutMask[$i++] * $s--) {
        }

        if ($cpfWithoutMask[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    private function hasInvalidSize($value)
    {
        return strlen($value) <> 11 || preg_match("/^{$value[0]}{11}$/", $value);
    }

    public function message(): string
    {
        return trans('validation.cpf');
    }
}
