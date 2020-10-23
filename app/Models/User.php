<?php

namespace App\Models;

use App\Helpers\FormatHelper;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'type'
    ];

    protected $hidden = [
        'password',
    ];

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = FormatHelper::sanitize($value);
    }
}
