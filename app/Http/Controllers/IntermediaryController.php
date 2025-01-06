<?php

namespace App\Http\Controllers;

use DateTime;

use App\Models\Intermediary;
use App\Models\Address;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Code;

use App\Models\Notification;
use App\Rules\IdentificatorRule;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Exports\IntermediaryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;


class IntermediaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $code)
    {
        if ($request->ajax()) {
            $values = Intermediary::withTrashed()
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
                            }, "photo", "type", "marital_status", "gender"])
                            ->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%")
                                    ->orwhere('identification', 'like', "%" . request('search') . "%");
                            }
                        })
                        ->where("intermediate_id","=", $code)
                        ->get();

            return datatables()->of($values)->toJson();
        }
        $name = Code::find($code)->name;
        return view('config.intermediary', ["title" => "Intermediarios", "code" => $code, "name"=> $name]);
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
            if(isset($request["birthdate"]) && $request["birthdate"] != ""){
                $fecha = DateTime::createFromFormat('d/m/Y', $request["birthdate"]);
                $request["birthdate"] = $fecha->format('Y-m-d');
            }
            if($request["last_name"] == ""){
                $request["full_name"] = $request["name"];
            }else{
                $request["full_name"] = $request["last_name"]." ".$request["mother_last_name"].", ". $request["name"];
            }

            $intermediary = Intermediary::create($request->all());

            if(isset($request["cont_address"])){
                $cont_address = $request["cont_address"];
                for ($i=0; $i < $cont_address; $i++) {
                    if(isset($request["address_".$i])){
                        $address = new Address();
                        $address->address = $request["address_".$i];
                        $address->commune_id = $request["commune_id_".$i];
                        $address->type_id = $request["type_address_id_".$i];
                        $intermediary->addresses()->save($address);
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
                        $intermediary->emails()->save($email);
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
                        $intermediary->phones()->save($phone);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
                'intermediary' => $intermediary
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function show(Intermediary $intermediary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function edit(Intermediary $intermediary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intermediary $intermediary)
    {
        $validator = $this->validator($request, $intermediary->id);
        $error = $validator->errors();
        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            if(isset($request["birthdate"]) && $request["birthdate"] != ""){
                $fecha = DateTime::createFromFormat('d/m/Y', $request["birthdate"]);
                $request["birthdate"] = $fecha->format('Y-m-d');
            }

            if($request["last_name"] == ""){
                $request["full_name"] = $request["name"];
            }else{
                $request["full_name"] = $request["last_name"]." ".$request["mother_last_name"].", ". $request["name"];
            }

            Intermediary::find($intermediary->id)->update(request()->all());

            $intermediary = Intermediary::find($intermediary->id);
            $intermediary->addresses()->delete();
            $intermediary->emails()->delete();
            $intermediary->phones()->delete();

            if(isset($request["cont_address"])){
                $cont_address = $request["cont_address"];
                for ($i=0; $i < $cont_address; $i++) {
                    if(isset($request["address_".$i])){
                        $address = new Address();
                        $address->address = $request["address_".$i];
                        $address->commune_id = $request["commune_id_".$i];
                        $address->type_id = $request["type_address_id_".$i];
                        $intermediary->addresses()->save($address);
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
                        $intermediary->emails()->save($email);
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
                        $intermediary->phones()->save($phone);
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
     * @param  \App\Models\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intermediary $intermediary)
    {
        $deleted = $intermediary->delete();
        if ($deleted) {
            return response()->json([
                'status' => 200,
                'message' => "Eliminado Correctamente",
            ]);
        }
    }

    public function validator(Request $request, $id)
    {
        $typeperson = Code::where("type", "=", "person")
                            ->where("usage", "=", "1")
                            ->first();

        $rules = [
            'type_id' => ['required',],
            'name' => ['required',],
            'last_name' => ['required_if:type_id,'.$typeperson->id,],
            'mother_last_name' => ['required_if:type_id,'.$typeperson->id,],
            'abbreviation' => 'required|max:20',
            'identification' => ['required',new IdentificatorRule, Rule::unique('intermediaries')->ignore($id)],
            'birthdate' => 'nullable|date_format:d/m/Y|before:tomorrow',
        ];

        if(isset($request["type_id"]) && $request["type_id"] != $typeperson->id){
            $messages =  [
                'type_id.required' => 'Debe ingresar Tipo',
                'name.required' => 'Debe ingresar Razón Social',
                'name.unique' => 'Nombre ya se encuentra registrado',
                'abbreviation.required' => 'Debe ingresar Abreviación',
                'identification.required' => 'Debe ingresar RUT',
            ];
        }else{
            $messages =  [
                'type_id.required' => 'Debe ingresar Tipo',
                'name.required' => 'Debe ingresar Nombre',
                'name.unique' => 'Nombre ya se encuentra registrado',
                'abbreviation.required' => 'Debe ingresar Abreviación',
                'identification.required' => 'Debe ingresar RUT',
                'last_name.required_if' => 'Debe ingresar Apellido Paterno',
                'mother_last_name.required_if' => 'Debe ingresar Apellido Materno',
                'birthdate.date_format' => 'Debe ingresar fecha correcta',
                'birthdate.before' => 'Debe ingresar fecha anterior a hoy',
            ];


        }

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
        $intermediary = Intermediary::withTrashed()->find($request->id);
        $intermediary->restore();
    }

    public function export()
    {
        $location = "Intermediarios";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new PersonExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }

    public function download(Request $request)
    {
        $file = $request["filename"];
        return response()->download(storage_path('app/'. $file));
    }

    public function viewInfo(Request $request, Person $person){
        $case = $request->case;
        $documentTypes = DocumentType::where('used_in', "like", '%Drivers%')->get();
        return view(
            "person.info",
            [
                'person' => $person,
                'documentTypes' => $documentTypes,
                'case' => $case
            ]
        );
    }

    public function modal(Request $request)
    {
        $add = true;
        $person = null;
        if(isset($request["id"])){
            $person = Person::find($request["id"]);
            $add = false;
        }

        return view('modals.person', ["add" => $add, "person" => $person]);
    }
}
