<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount','description','reported_by'];
	
	public function reporter()
    {
        return $this->belongsTo('App\User','reported_by');
    }
}
