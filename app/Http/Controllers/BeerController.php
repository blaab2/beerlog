<?php

namespace App\Http\Controllers;

use App\Beer;
use App\BeerType;
use App\User;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        if ($user->id == null) {

            $data['beers'] = Beer::select(['created_at', 'cost', 'id', 'beer_type_id'])->with('reporter', 'beerType:id,name')->orderBy('created_at', 'desc')
                ->whereDate('created_at', '>', Carbon::now()->subMonths(2))->get();
            $data['beers_y0'] = Beer::where('id', '<', $data['beers']->last()->id)->count();

            $data['user_label'] = 'all users';
            return view('beer.index', $data);
        } else {
            if ($user->id == Auth::id() || $this->authorize('viewAny', Beer::class)) {
                $data['beers'] = Beer::select(['created_at', 'cost', 'id', 'beer_type_id'])->with('reporter', 'beerType:id,name')->orderBy('created_at', 'desc')
                    ->whereDate('created_at', '>', Carbon::now()->subMonths(2))->where('user_id', '=', $user->id)->get();
                $data['beers_y0'] = Beer::whereDate('created_at', '>', Carbon::now()
                    ->subMonths(2))->where('user_id', '=', $user->id)->count();

                $data['user_label'] = $user->nickname;
                return view('beer.index', $data);
            }
        }
    }


    public function index_ajax(User $user, Request $request)
    {
        //dd($request);
        $columns = array(
            0 => 'id',
            1 => 'cost',
            2 => 'created_at'
        );

        $totalData = Beer::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = Beer::select(['created_at', 'cost', 'id', 'beer_type_id'])->with('reporter', 'beerType:id,name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts = Beer::select(['created_at', 'cost', 'id', 'beer_type_id'])->with('reporter', 'beerType:id,name')
                ->where('id', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Beer::select(['created_at', 'cost', 'id', 'beer_type_id'])->with('reporter', 'beerType:id,name')
                ->where('id', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $data[] = $post;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
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
        return $this->store(Auth::user(), $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $count = 1;
        if (!is_null($request->count)) {
            $count = intval($request->count);
        }

        $beer_type_id = 1;
        if (!is_null($request->beer_type_id)) {
            $beer_type_id = intval($request->beer_type_id);
        }

        $beer_type = BeerType::find($beer_type_id);

        for ($i = 1; $i <= $count; $i++) {
            $user->beers()->create([
                'cost' => $beer_type->price,
                'reported_by' => Auth::user()->id,
                'beer_type_id' => $beer_type_id
            ]);
        }

        $msg = 'Added ' . $count . ' ' . $beer_type->name . ' to ' . $user->nickname;

        if ($request->ajax()) {
            return response()->json([
                'status' => $msg,
                'state' => '1'
            ]);
        }

        return redirect()->back()->with(['flash_message' => $msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function show(Beer $beer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function edit(Beer $beer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beer $beer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Beer $beer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Beer $beer)
    {
        if ($this->authorize('delete', $beer)) {
            $beer->delete();
            return redirect()->back()->with(['flash_message' => 'Beer deleted']);
        }
    }
}
