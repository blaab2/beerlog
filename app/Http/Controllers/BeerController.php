<?php

namespace App\Http\Controllers;

use App\Beer;
use App\User;
use App\Setting;
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
        if ($this->authorize('viewAny', Beer::class)) {
            $data['beers'] = Beer::all();
            return view('beer.index', $data);
        }
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
        if (!is_null($request->count)) {
            $count = intval($request->count);
        }

        $beer_price = Setting::getValue('beer_price');

        //dd($beer_price);

        for ($i = 1; $i <= $count; $i++) {
            $user->beers()->create([
                'cost' => $beer_price,
                'reported_by' => Auth::user()->id
            ]);
        }

        $msg = 'Added ' . $count . ' beer to ' . $user->nickname;

        if ($request->ajax()) {
            return response()->json([
                'status' => $msg,
                'state' => '1'
            ]);
        }

        return redirect()->back()->with(['flash_message' => 'Added ' . $count . ' beer to ' . $user->nickname]);
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
        if ($this->authorize('delete', $beer)) {
            $beer->delete();
            return redirect()->back()->with(['flash_message' => 'Beer deleted']);
        }
    }
}
