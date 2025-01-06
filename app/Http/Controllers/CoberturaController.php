<?php

namespace App\Http\Controllers;

use App\Models\Cobertura;
use Illuminate\Http\Request;

use App\Models\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Exports\CoberturaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;

class CoberturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $values = Cobertura::withTrashed()->with(["ramo", "type", "expressed_in"])->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%")
                                    ->orWhere('abbreviation', 'like', "%" . request('search') . "%");
                            }
                            if (request()->has('ramo_id') ) {
                                $query->where('ramo_id', '=', request('ramo_id'));
                            }
                        })->get();

            return datatables()->of($values)->toJson();
        }

        return view('config.cobertura', ["title" => "Coberturas"]);
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
            Cobertura::create($request->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\Http\Response
     */
    public function show(Cobertura $cobertura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\Http\Response
     */
    public function edit(Cobertura $cobertura)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cobertura $cobertura)
    {
        $validator = $this->validator($request, $cobertura->id);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            Cobertura::find($cobertura->id)->update(request()->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cobertura $cobertura)
    {
        $deleted = $cobertura->delete();
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
            'name' => ['required'],
            'ramo_id' => 'required|not_in:0',
            'abbreviation' => 'required|max:15',
            'type_id' => 'required',
            'expressed_in_id' => 'required',
            'tax' => 'required',
            'code' => 'nullable|max:20',
        ];


        $messages =  [
            'ramo_id.required' => 'Debe ingresar Ramo',
            'name.required' => 'Debe ingresar Nombre',
            'abbreviation.required' => 'Debe ingresar Abreviacion',
            'abbreviation.max' => 'Abreviación: El maximo de caracteres debe ser 15',
            'type_id.required' => 'Debe ingresar Tipo',
            'expressed_in_id.required' => 'Debe ingresar como será expresada la cobertura',
            'tax.required' => 'Debe ingresar si la cobertura es Afecta o Exenta',
            'code.max' => 'Código: El maximo de caracteres debe ser 20',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    public function activate(Request $request){
        $cobertura= Cobertura::withTrashed()->find($request->id);
        $cobertura->restore();
    }

    public function export()
    {
        $location = "Coberturas";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new CoberturaExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }
}
