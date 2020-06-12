<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('viewAny', Setting::class)) {
            $data['settings'] = Setting::all();
            return view('setting.index', $data);
        }
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
     * @param \App\setting $settings
     * @return \Illuminate\Http\Response
     */
    public function show(setting $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\setting $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, setting $setting)
    {

        $setting->update($request->all());
        return redirect()->back()->with(['flash_message' => 'Changed setting ' . $setting->key . ' to ' . $setting->value]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(setting $setting)
    {
        //
    }
}
