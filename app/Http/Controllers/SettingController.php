<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Arr;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.setting',  ["title" => "Configuración"]);
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

        $rules = Setting::getValidationRules();
        $rules2 = array();
        foreach ($rules as $key => $value) {
            $key = str_replace("[]","",$key);
            $rules2[$key] = $value;
        }
        //$data = $this->validate($request, $rules);
        $data = Validator::make($request->all(), $rules2);
        $error = $data->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $data->messages(),
            ]);
        } else {
            $validSettings = array_keys($rules2);

            foreach ($request->all() as $key => $val) {
                if (in_array($key, $validSettings)) {
                    if(is_array($request[$key]) ){
                        $values = [];
                        $values = array_merge($values, $request[$key]);
                        $val = implode(",",$values);
                    }
                    Setting::add($key, $val, Setting::getDataType($key));
                }
            }

            return response()->json([
                'status' => 200,
                'errors' => $data->messages(),
            ]);
        }
        //return redirect()->back()->with('status', 'Settings has been saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
