<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrators';

    protected $hidden = [
        'password',
    ];
}
