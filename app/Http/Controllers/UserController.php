<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Social;
use App\Models\Photo;
use Illuminate\Http\Request;

use App\Models\Notification;
use App\Rules\IdentificatorRule;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportDone;

use Illuminate\Support\Facades\Hash; // <-- import it at the top


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $values = User::withTrashed()->with(["roles"])->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%");
                            }
                        })->get();

            //return datatables()->of($values)->toJson();
            return datatables()->of($values)->toJson();
        }

        return view('access.user.index', ["title" => "Usuarios"]);
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
            $input = $request->all();
            $input["password"] = Hash::make($input["password"]);

            $user = User::create($request->all());

            $role = Role::find($input["role_id"]);
            $user->assignRole($role->name);

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('access.user.profile', ["title" => "Usuarios", "user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('access.user.edit', ["title" => "Usuarios", "user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $this->validator($request, $user->id);
        $error = $validator->errors();

        if ($error->first()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            //codigo si no tiene error
            DB::beginTransaction();
            try {
                if(isset($request["birthday"]) && $request["birthday"] != null){
                    $date = explode("/",$request["birthday"]);
                    $request["birthday"] = $date[2]."-".$date[1]."-".$date[0];
                }
                User::find($user->id)->update($request->all());
                //socials
                if(!empty($request["where"]) && $request["where"] == "social"){
                    foreach ($request->all() as $key => $value) {
                        if($value != ""){
                            $name = explode("_",$key);
                            if($key == "where" || $name[0] != "social"){
                                continue;
                            }

                            $social = Social::where("name", "=", $name[1])->where("user_id", "=", $user->id)->first();
                            if($social == null){
                                $social = new Social();
                                $social->name = $name[1];
                                $social->value = $value;
                                $user->socials()->save($social);
                            }else{
                                $social->value = $value;
                                $social->update();
                            }
                        }
                    }
                }

                DB::commit();

                return response()->json([
                    'status' => 200,
                    'errors' => '',
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 400,
                    'errors' => $e->getMessage()
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if ($deleted) {
            return response()->json([
                'status' => 200,
                'message' => "Eliminado Correctamente",
            ]);
        }
    }

    public function validator(Request $request, $id)
    {
        if(empty($request["where"])){
            $rules = [
                'name' => ['required'],
                'email' => ['required','email',Rule::unique('users')->ignore($id),],
                'description' => 'required',
                'password' => [
                    'required_if:id,0',
                    'min:6',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
                ],
                'role_id' => 'required|not_in:0',
            ];


            $messages =  [
                'name.required' => 'Debe ingresar Nombre',
                'description.required' => 'Debe ingresar Descripción',
                'email.required' => 'Debe ingresar Email',
                'email.email' => 'Formato de Email incorrecto',
                'email.unique' => 'Email ya se encuentra registrado',
                'password.required' => 'Debe ingresar Password',
                'password.min' => 'Password minimo de 6 caracteres',
                'password.regex' => 'Formato de Password incorrecta',
                'role_id.required' => 'Debe Ingresar Rol',
            ];
        }elseif ($request["where"] == "laboral"){
            $rules = [
                'email_laboral_1' => ['nullable','email',Rule::unique('users')->ignore($id),],
                'email_laboral_2' => ['nullable','email',Rule::unique('users')->ignore($id),],
            ];


            $messages =  [
                'email_laboral_1.email' => 'Formato de Email Laboral 1 incorrecto',
                'email_laboral_1.unique' => 'Email Laboral 1 ya se encuentra registrado',
                'email_laboral_2.email' => 'Formato de Email Laboral 2 incorrecto',
                'email_laboral_2.unique' => 'Email Laboral 2 ya se encuentra registrado',
            ];
        }else{
            $rules =[
                'where' => ['nullable'],
            ];
            $messages = [
                'where' => 'nullable',
            ];
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        return $validator;
    }

    public function activate(Request $request){
        $user = User::withTrashed()->find($request->id);
        $user->restore();
    }

    public function export()
    {
        $location = "Usuarios";
        $filename = $location.'_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "'.$location.'"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new UserExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, $location));
        return back()->withSuccess('Export started!');
    }

    public function uploadImage(Request $request, User $user){
        if($request->hasFile('filepond'))
        {
            $file = $request->file('filepond');
            $filenameWithExt = $request->file('filepond')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('filepond')->getClientOriginalExtension();
            $fileNameToStore = $user->id . '_' . date('mdYHis') . uniqid() . '.' . $extension;
            //$path = $request->file('filepond')->storeAs('public/profile-image/', $fileNameToStore);
            $path = $request->file('filepond')->move(public_path('img/upl/'), $fileNameToStore);
            //\File::put(public_path('img/upl/'). $fileNameToStore , $file);

            $photo = new Photo();
            $photo->path = $fileNameToStore ;
            $user->photos()->save($photo);

            return $data['filepond'] = $fileNameToStore;
        }
    }

    public function deleteImage(Request $request, User $user){
        $file = $request->getContent();
        Storage::disk('public')->delete('profile-image/'.$file);
    }
}
