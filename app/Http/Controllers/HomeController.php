<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

		$user_count = \App\User::where('id','=',Auth::user()->id)
			->withCount(['beers AS beers_count' => function ($query) {$query->whereDate('created_at', '>', Carbon::now()->subDays(30));}])
			->first()->beers_count;
			
		$users1 = \App\User::select('id','nickname')
		->withCount(['beers AS beers_count' => function ($query) {$query->whereDate('created_at', '>', Carbon::now()->subDays(30));}])
		->having('beers_count','>=',$user_count)->orderBy('beers_count','asc')->take(3)->get();
		$users2 = \App\User::select('id','nickname')->withCount(['beers AS beers_count' => function ($query) {$query->whereDate('created_at', '>', Carbon::now()->subDays(30));}])
		->having('beers_count','<',$user_count)->orderBy('beers_count','desc')->take(2)->get();

		
		
		$data['users'] = $users1->merge($users2);		
		$data['beers'] = Auth::user()->beers()->with('reporter')->take(10)->orderBy('created_at','desc')->get(); 
		$data['user'] = Auth::user()->withCount(['cashflows AS cashflow' => function ($query) {$query->select(DB::raw("sum(amount) as amount_sum"));}]);
		$data['cashflows'] = Auth::user()->cashflows()->take(10)->orderBy('created_at','desc')->get();
        return view('home',$data);
    }
}
