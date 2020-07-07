<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeerType extends Model
{
    protected $fillable = [
        'price',
    ];

    public function beers()
    {
        return $this->hasMany('App\Beer');
    }
}
