<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'info',
        'light_white',
        'light_red',
        'temperature',
        'temp_delta_top',
        'temp_delta_bot',
        'humidity',
        'hum_delta_top',
        'hum_delta_bot'
    ];
}
