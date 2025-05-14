<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Address;
use App\Models\Email;
use App\Models\Phone;

use App\Models\Notification;
use App\Rules\IdentificatorRule;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Exports\CompanyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $values = Company::withTrashed()
                            ->with(["addresses" => function($query){
                                $query->with(["type", "commune" => function($query) {
                                    $query->with(["city"  => function($query2) {
                                        $query2->with(["region"]);
                                }]);
                            },]);
                            }, "emails" => function($query){
                                $query->with(["type"]);
                            }, "phones" => function($query){
                                $query->with(["type"]);
                            }, "photo", "type"])
                            ->where(function ($query) {
                                if (request()->has('search') && !is_array(request()->search)) {
                                    $query->where('name', 'like', "%" . request('search') . "%");
                                }
                            })
                            ->where(function ($query) use($request){
                                if($request->select2 != null){
                                    $query->whereNull('deleted_at');
                                }
                            })->get();

            return datatables()->of($values)->toJson();
        }

        return view('config.company');
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
        $validator = $this->validator($request, 0);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $company = Company::create($request->all());

            if(isset($request["cont_address"])){
                $cont_address = $request["cont_address"];
                for ($i=0; $i < $cont_address; $i++) {
                    if(isset($request["address_".$i])){
                        $address = new Address();
                        $address->address = $request["address_".$i];
                        $address->commune_id = $request["commune_id_".$i];
                        $address->type_id = $request["type_address_id_".$i];
                        $company->addresses()->save($address);
                    }
                }
            }

            if(isset($request["cont_email"])){
                $cont_email = $request["cont_email"];
                for ($i=0; $i < $cont_email; $i++) {
                    if(isset($request["email_".$i])){
                        $email = new Email();
                        $email->email = $request["email_".$i];
                        $email->type_id = $request["type_email_id_".$i];
                        $company->emails()->save($email);
                    }
                }
            }

            if(isset($request["cont_phone"])){
                $cont_phone = $request["cont_phone"];
                for ($i=0; $i < $cont_phone; $i++) {
                    if(isset($request["phone_".$i])){
                        $phone = new Phone();
                        $phone->phone = $request["phone_".$i];
                        $phone->type_id = $request["type_phone_id_".$i];
                        $company->phones()->save($phone);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validator = $this->validator($request, $company->id);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            Company::find($company->id)->update(request()->all());

            $company = Company::find($company->id);
            $company->addresses()->delete();
            $company->emails()->delete();
            $company->phones()->delete();

            if(isset($request["cont_address"])){
                $cont_address = $request["cont_address"];
                for ($i=0; $i < $cont_address; $i++) {
                    if(isset($request["address_".$i])){
                        $address = new Address();
                        $address->address = $request["address_".$i];
                        $address->commune_id = $request["commune_id_".$i];
                        $address->type_id = $request["type_address_id_".$i];
                        $company->addresses()->save($address);
                    }
                }
            }

            if(isset($request["cont_email"])){
                $cont_email = $request["cont_email"];
                for ($i=0; $i < $cont_email; $i++) {
                    if(isset($request["email_".$i])){
                        $email = new Email();
                        $email->email = $request["email_".$i];
                        $email->type_id = $request["type_email_id_".$i];
                        $company->emails()->save($email);
                    }
                }
            }

            if(isset($request["cont_phone"])){
                $cont_phone = $request["cont_phone"];
                for ($i=0; $i < $cont_phone; $i++) {
                    if(isset($request["phone_".$i])){
                        $phone = new Phone();
                        $phone->phone = $request["phone_".$i];
                        $phone->type_id = $request["type_phone_id_".$i];
                        $company->phones()->save($phone);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $deleted = $company->delete();
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
            'name' => ['required',Rule::unique('companies')->ignore($id),],
            'abbreviation' => 'required|max:20',
            'identification' => ['nullable',new IdentificatorRule],
        ];

        $messages =  [
            'name.required' => 'Debe ingresar Nombre',
            'name.unique' => 'Nombre ya se encuentra registrado',
            'abbreviation.required' => 'Debe ingresar Abreviación',
        ];

        if(isset($request["cont_address"])){
            $cont_address = $request["cont_address"];
            for ($i=0; $i < $cont_address; $i++) {
                if(isset($request["address_".$i])){
                    $rules["type_address_id_".$i] = 'required|not_in:0';
                    $rules["region_id_".$i] = 'required';
                    $rules["city_id_".$i] = 'required';
                    $rules["commune_id_".$i] = 'required';
                    $rules["address_".$i] = 'required';

                    $messages["type_address_id_".$i.".required"] = 'Debe ingresar Tipo de Direccion '.($i + 1);
                    $messages["region_id_".$i.".required"] = 'Debe ingresar Región '.($i + 1);
                    $messages["city_id_".$i.".required"] = 'Debe ingresar Ciudad '.($i + 1);
                    $messages["commune_id_".$i.".required"] = 'Debe ingresar Comuna '.($i + 1);
                    $messages["address_".$i.".required"] = 'Debe ingresar Dirección '.($i + 1);
                }
            }
        }

        if(isset($request["cont_email"])){
            $cont_email = $request["cont_email"];
            for ($i=0; $i < $cont_email; $i++) {
                if(isset($request["email_".$i])){
                    $rules["type_email_id_".$i] = 'required|not_in:0';
                    $rules["email_".$i] = 'required|email';

                    $messages["type_email_id_".$i.".required"] = 'Debe ingresar Tipo de Email '.($i + 1);
                    $messages["email_".$i.".required"] = 'Debe ingresar Email '.($i + 1);
                    $messages["email_".$i.".email"] = 'Formato de Email incorrecto, Email '.($i + 1);
                    $i = $i + 1;
                }
            }
        }

        if(isset($request["cont_phone"])){
            $cont_phone = $request["cont_phone"];
            for ($i=0; $i < $cont_phone; $i++) {
                if(isset($request["phone_".$i])){
                    $rules["type_phone_id_".$i] = 'required|not_in:0';
                    $rules["phone_".$i] = 'required';

                    $messages["type_phone_id_".$i.".required"] = 'Debe ingresar Tipo de Telefono '.($i + 1);
                    $messages["phone_".$i.".required"] = 'Debe ingresar Telefono '.($i + 1);
                    $i = $i + 1;
                }
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    public function activate(Request $request){
        $company = Company::withTrashed()->find($request->id);
        $company->restore();
    }

    public function export()
    {
        $location = "Compañias";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new CompanyExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }

    public function download(Request $request)
    {
        $file = $request["filename"];
        return response()->download(storage_path('app/'. $file));
    }
}
