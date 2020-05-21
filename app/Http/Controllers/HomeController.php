<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

		$users1 = \App\User::select('id','nickname')->withCount('beers')->having('beers_count','>=',Auth::user()->beers()->count())->take(2)->orderBy('beers_count')->get();
		$users2 = \App\User::select('id','nickname')->withCount('beers')->having('beers_count','<',Auth::user()->beers()->count())->take(2)->orderBy('beers_count')->get();

		$data['items'] = $users1->merge($users2);		
	
        return view('home',$data);
    }
}
