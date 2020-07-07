<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;
    use AuthenticatesUsers {
        redirectPath as laravelRedirectPath;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Use log message to try to find out why login is stuck sometimes....
        Log::info('This is LoginController');
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
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

        // Return the results of the method we are overriding that we aliased.
        return $this->laravelRedirectPath();
    }
}
