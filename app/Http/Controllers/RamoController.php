<?php

namespace App\Http\Controllers;

use App\Models\Ramo;
use App\Models\Company;
use Illuminate\Http\Request;

use App\Models\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Exports\RamoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $values = Ramo::withTrashed()->with(["type"])->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%")
                                    ->orWhere('abbreviation', 'like', "%" . request('search') . "%");
                            }
                        })->get();

            return datatables()->of($values)->toJson();
        }

        return view('config.ramo', ["title" => "Ramos"]);
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
            Ramo::create($request->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function show(Ramo $ramo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ramo $ramo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ramo $ramo)
    {
        $validator = $this->validator($request, $ramo->id);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            Ramo::find($ramo->id)->update(request()->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ramo $ramo)
    {
        $deleted = $ramo->delete();
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
            'name' => ['required',Rule::unique('ramos')->ignore($id),],
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
        $ramo = Ramo::withTrashed()->find($request->id);
        $ramo->restore();
    }

    public function export()
    {
        $location = "Ramos";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new RamoExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }

    public function companies($id)
    {
        $ramo = Ramo::findOrFail($id);
        $companies = Company::all()->map(function ($company) use ($ramo) {
            return [
                'id' => $company->id,
                'name' => $company->name,
                'checked' => $ramo->companies()->where('company_id', $company->id)->exists(),
            ];
        });

        return response()->json($companies);
    }

    public function saveCompanies(Request $request)
    {
        $ramoId = $request->input('ramo_id');
        $companyIds = $request->input('companies', []);

        $now = Carbon::now();

        // Obtener todas las relaciones actuales (incluyendo soft deleted)
        $currentRelations = DB::table('company_ramo')
            ->where('ramo_id', $ramoId)
            ->get();

        $currentCompanyIds = $currentRelations->pluck('company_id')->toArray();
        $deletedCompanyIds = $currentRelations->whereNotNull('deleted_at')->pluck('company_id')->toArray();

        // 1. Restaurar relaciones eliminadas (soft-deleted) si vienen marcadas
        DB::table('company_ramo')
            ->where('ramo_id', $ramoId)
            ->whereIn('company_id', $companyIds)
            ->whereNotNull('deleted_at')
            ->update(['deleted_at' => null, 'updated_at' => $now]);

        // 2. Crear nuevas relaciones si no existen
        $newIds = array_diff($companyIds, $currentCompanyIds);
        foreach ($newIds as $companyId) {
            DB::table('company_ramo')->insert([
                'company_id' => $companyId,
                'ramo_id' => $ramoId,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        // 3. Soft-deletear las que ya no vienen marcadas
        $toDelete = array_diff($currentCompanyIds, $companyIds);
        DB::table('company_ramo')
            ->where('ramo_id', $ramoId)
            ->whereIn('company_id', $toDelete)
            ->whereNull('deleted_at') // solo las activas
            ->update(['deleted_at' => $now]);

        return response()->json(['status' => 200]);
    }


}
