<?php

namespace App\Http\Controllers;

use App\Models\TypeVehicle;
use Illuminate\Http\Request;

use App\Models\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Exports\TypeVehicleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;

class TypeVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $values = TypeVehicle::withTrashed()->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%")
                                    ->orWhere('abbreviation', 'like', "%" . request('search') . "%");
                            }
                        })->get();

            //return datatables()->of($values)->toJson();
            return datatables()->of($values)->toJson();
        }

        return view('config.typevehicle', ["title" => "Tipos de Vehiculos"]);
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
            TypeVehicle::create($request->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeVehicle  $typeVehicle
     * @return \Illuminate\Http\Response
     */
    public function show(TypeVehicle $typevehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeVehicle  $typeVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeVehicle $typevehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeVehicle  $typeVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeVehicle $typevehicle)
    {
        $validator = $this->validator($request, $typevehicle->id);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            TypeVehicle::find($typevehicle->id)->update(request()->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeVehicle  $typeVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeVehicle $typevehicle)
    {
        $deleted = $typevehicle->delete();
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
            'name' => ['required',Rule::unique('type_vehicles')->ignore($id),],
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
        $type = TypeVehicle::withTrashed()->find($request->id);
        $type->restore();
    }

    public function export()
    {
        $location = "Tipos";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new TypeVehicleExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }
}
