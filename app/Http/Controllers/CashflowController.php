<?php

namespace App\Http\Controllers;

use App\Cashflow;
use App\Beer;
use App\User;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashflowController extends Controller
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
    public function store(User $user, Request $request)
    {
		if ($this->authorize('create', Cashflow::class)) {
			
			
			 $validatedData = $request->validate([
				'amount' => 'required|numeric',
				'description' => 'required|string|max:255',
			]);
			
			$user->cashflows()->create([
					'amount' => $request->amount,
					'description' => $request->description,
					'reported_by' => Auth::user()->id
				]);
					
				return redirect()->back()->with(['flash_message'=>'Added a cashflow with '. $request->amount . '€ to '.$user->nickname ]);
		}
		
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function show(cashflow $cashflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function edit(cashflow $cashflow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cashflow $cashflow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(cashflow $cashflow)
    {
        //
    }
}
