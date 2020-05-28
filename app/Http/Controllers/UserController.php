<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['items'] = \App\User::with('roles')
		->withCount('beers AS total_beers_count')
		->withCount(['beers AS depts' => function ($query) {$query->select(DB::raw("sum(cost) as cost_sum"));}])
		->withCount(['beers AS beers_count' => function ($query) {$query->whereDate('created_at', '>', Carbon::now()->subDays(30));}])
		->withCount(['cashflows AS cashflow' => function ($query) {$query->select(DB::raw("sum(amount) as amount_sum"));}])
		->orderBy('depts','desc')->get();
					
		foreach ($data['items']  as $item)
		{
			if ($item->can('make admin'))
			{
				$item->admin = 1;
			}
		}
					
        return view('user.index',$data);
				
    }
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\User $user)
    {
        $users1 = \App\User::select('id','nickname')
			->withCount(['beers AS beers_count' => function ($query) {$query->select(DB::raw("sum(cost) as cost_sum"));}])
			->having('beers_count','>=',$user->beers()->count())->take(2)->orderBy('beers_count','asc')->get();
			
		$users2 = \App\User::select('id','nickname')
			->withCount(['beers AS beers_count' => function ($query) {$query->select(DB::raw("sum(cost) as cost_sum"));}])
			->having('beers_count','<',$user->beers()->count())->take(2)->orderBy('beers_count','desc')->get();

		$data['users'] = $users1->merge($users2);		
		$data['beers'] = $user->beers()->with('reporter')->take(10)->orderBy('created_at','desc')->get(); 
		$data['user'] = $user;
        return view('user.show',$data);
    }

	/**
     * Change the specified resource's admin status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function swapAdminStatus(\App\User $user)
    {
        if ($user->hasRole('admin'))
		{
			if (\App\User::role('admin')->count()>1)
			{
				$user->removeRole('admin');
				//return redirect()->back()->with(['flash_message'=>'Removed role admin from '.$user->nickname ]);
				return response()->json([
					'msg' => 'Removed role admin from '.$user->nickname ,
					'state' => '1',
					'admin' => 0
				], 200 );
			}
			else
			{
				//return redirect()->back()->with(['flash_error'=>'Did NOT remove role admin from '.$user->nickname.'. There needs to be one admin remaining.']);
				return response()->json([
					'msg' => 'Did NOT remove role admin from '.$user->nickname.'. There needs to be one admin remaining.',
					'state' => '0'
				], 420 );
			}
			
		}
		else
		{
			$user->assignRole('admin');
			//return redirect()->back()->with(['flash_message'=>'Assigned role admin to '.$user->nickname ]);
			return response()->json([
					'msg' => 'Assigned role admin to '.$user->nickname ,
					'state' => '1',
					'admin' => 1
				], 200 );
		}
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
