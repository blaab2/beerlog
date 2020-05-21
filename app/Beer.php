<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
