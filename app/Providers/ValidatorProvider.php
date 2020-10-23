<?php

namespace App\Providers;

use App\Rules\CpfValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('cpf', CpfValidationRule::class . '@passes');
    }
}
