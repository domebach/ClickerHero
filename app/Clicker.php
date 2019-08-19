<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clicker extends Model
{
    protected $guarded = [];

    protected $casts = [
        'hero1DpsEnabled' => 'boolean',
    ];
}
