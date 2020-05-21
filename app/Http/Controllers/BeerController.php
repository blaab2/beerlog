<?php

namespace App\Http\Controllers;

use App\Beer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        
    }

	 /**
     * Add a beer to this resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addBeer(Request $request)
    {
		return $this->store(Auth::user(),$request);
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
		$count = 1;
		if (!is_null($request->count))
		{
			$count = intval($request->count);
		}
		
		for ($i = 1; $i <= $count; $i++) {
			$user->beers()->create();
		}
        return redirect()->back()->with(['flash_message'=>'Added '. $count . ' beer to '.$user->nickname ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function show(Beer $beer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function edit(Beer $beer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beer $beer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beer $beer)
    {
        //
    }
}
