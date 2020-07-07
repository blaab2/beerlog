<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cost', 'reported_by', 'beer_type_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reporter()
    {
        return $this->belongsTo('App\User', 'reported_by');
    }

    public function beerType()
    {
        return $this->belongsTo('App\BeerType');
    }
}
