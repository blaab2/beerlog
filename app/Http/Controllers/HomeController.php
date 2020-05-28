<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

		$users1 = \App\User::select('id','nickname')->withCount('beers')->having('beers_count','>=',Auth::user()->beers()->count())->take(2)->orderBy('beers_count','asc')->get();
		$users2 = \App\User::select('id','nickname')->withCount('beers')->having('beers_count','<',Auth::user()->beers()->count())->take(2)->orderBy('beers_count','desc')->get();

		
		
		$data['users'] = $users1->merge($users2);		
		$data['beers'] = Auth::user()->beers()->with('reporter')->take(10)->orderBy('created_at','desc')->get(); 
		$data['user'] = Auth::user()->withCount(['cashflows AS cashflow' => function ($query) {$query->select(DB::raw("sum(amount) as amount_sum"));}]);
		$data['cashflows'] = Auth::user()->cashflows()->take(10)->orderBy('created_at','desc')->get();
        return view('home',$data);
    }
}
