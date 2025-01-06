<?php

namespace App\Http\Controllers;

use App\Models\UseVehicle;
use Illuminate\Http\Request;

use App\Models\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Exports\UseVehicleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;


class UseVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $values = UseVehicle::withTrashed()->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%")
                                    ->orWhere('abbreviation', 'like', "%" . request('search') . "%");
                            }
                        })->get();

            //return datatables()->of($values)->toJson();
            return datatables()->of($values)->toJson();
        }

        return view('config.usevehicle', ["title" => "Usos de Vehiculos"]);
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
        $validator = $this->validator($request,0);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            UseVehicle::create($request->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Use  $use
     * @return \Illuminate\Http\Response
     */
    public function show(UseVehicle $useVehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Use  $use
     * @return \Illuminate\Http\Response
     */
    public function edit(UseVehicle $useVehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Use  $use
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UseVehicle $usevehicle)
    {
        $validator = $this->validator($request, $usevehicle->id);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            UseVehicle::find($usevehicle->id)->update(request()->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Use  $use
     * @return \Illuminate\Http\Response
     */
    public function destroy(UseVehicle $usevehicle)
    {
        $deleted = $usevehicle->delete();
        if ($deleted) {
            return response()->json([
                'status' => 200,
                'message' => "Eliminado Correctamente",
            ]);
        }
    }

    public function validator(Request $request, $id)
    {
        $rules = [
            'name' => ['required',Rule::unique('use_vehicles')->ignore($id),],
            'abbreviation' => 'required|max:15',
        ];


        $messages =  [
            'name.required' => 'Debe ingresar Nombre',
            'abbreviation.required' => 'Debe ingresar Abreviacion',
            'abbreviation.max' => 'Abreviación: El maximo de caracteres debe ser 15',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    public function activate(Request $request){
        $use = UseVehicle::withTrashed()->find($request->id);
        $use->restore();
    }

    public function export()
    {
        $location = "Usos";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new UseVehicleExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }
}
