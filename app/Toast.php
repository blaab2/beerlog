<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toast extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];
}
