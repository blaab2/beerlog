<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'value',
    ];

    static function getValue($key)
    {
        return Setting::where('key', $key)->get('value')->pluck('value')[0];
    }
}
