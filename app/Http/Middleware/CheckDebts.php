<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckDebts
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $user = \App\User::where('id', '=', Auth::user()->id)
            ->withCount(['beers AS debts' => function ($query) {
                $query->select(DB::raw("sum(cost) as cost_sum"));
            }])
            ->withCount(['cashflows AS cashflow' => function ($query) {
                $query->select(DB::raw("sum(amount) as amount_sum"));
            }])
            ->first();

        $debts = -$user->debts + $user->cashflow;

        if ($debts < -10) {
            // Do your logic to flash data to session...
            session()->flash('popup_message', $debts);
        }

        return $response;
    }
}
