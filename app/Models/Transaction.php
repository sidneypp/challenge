<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'payer',
        'payee',
        'value'
    ];

    public function payer()
    {
        return $this->hasOne(User::class, 'id', 'payer');
    }

    public function payee()
    {
        return $this->hasOne(User::class, 'id', 'payee');
    }
}
