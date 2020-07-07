<?php

namespace App\Http\Controllers;

use App\BeerType;
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

        $user = \App\User::where('id', '=', Auth::user()->id)
            ->withCount('beers AS total_beers_count')
            ->withCount(['beers AS beers_count' => function ($query) {
                $query->whereDate('created_at', '>', Carbon::now()->subDays(30));
            }])
            ->withCount(['cashflows AS cashflow' => function ($query) {
                $query->select(DB::raw("sum(amount) as amount_sum"));
            }])
            ->withCount(['beers AS debts' => function ($query) {
                $query->select(DB::raw("sum(cost) as cost_sum"));
            }])
            ->first();

        $user_count = $user->beers_count;

        $users1 = \App\User::select('id', 'nickname')
            ->where('id', '!=', $user->id)
            ->withCount(['beers AS beers_count' => function ($query) {
                $query->whereDate('created_at', '>', Carbon::now()->subDays(30));
            }])
            ->having('beers_count', '>=', $user_count)->orderBy('beers_count', 'asc')->take(5)->get();
        $users2 = \App\User::select('id', 'nickname')->withCount(['beers AS beers_count' => function ($query) {
            $query->whereDate('created_at', '>', Carbon::now()->subDays(30));
        }])
            ->having('beers_count', '<', $user_count)->orderBy('beers_count', 'desc')->take(5)->get();

        $show_count = 5;
        $total_count = $users1->count() + $users2->count();
        $diff_count = $total_count - $show_count;


        for ($i = 0; $i < $diff_count; $i++) {
            if ($users1->count() > $users2->count()) {
                $users1->pop();
            } else {
                $users2->pop();
            }
        }


        $data['beer_price'] = BeerType::find(1, ['price'])->price;
        $data['users'] = $users1->push($user)->merge($users2);
        $data['beers'] = Auth::user()->beers()->with('reporter', 'beerType')->take(10)->orderBy('created_at', 'desc')->get();
        $data['user'] = $user;
        $data['cashflows'] = Auth::user()->cashflows()->take(10)->orderBy('created_at', 'desc')->get();
        return view('home', $data);
    }
}
