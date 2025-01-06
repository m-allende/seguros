<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Site;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    public function __construct()
    {
        //dd(request()->getRequestUri());
        /*
        $this->middleware('auth');
        if(!request()->ajax()){
            $this->middleware('permission:access-roles-view|access-roles-admin', ['only' => ['index','show', 'profile']]);
            $this->middleware('permission:access-roles-create|access-roles-admin', ['only' => ['create','store']]);
            $this->middleware('permission:access-roles-edit|access-roles-admin', ['only' => ['edit','update']]);
            $this->middleware('permission:access-roles-delete|access-roles-admin', ['only' => ['destroy']]);
        }*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $values = Role::where("name","!=", "super-admin")->where(function ($query) {
                            if (request()->has('search') && !is_array(request()->search)) {
                                $query->where('name', 'like', "%" . request('search') . "%")
                                    ->orWhere('abbreviation', 'like', "%" . request('search') . "%");
                            }
                        })->get();

            return datatables()->of($values)->toJson();
        }

        return view('access.role.index', ["title" => "Roles"]);
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
            Role::create($request->all());

            return response()->json([
                'status' => 200,
                'errors' => $validator->messages(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        $perm = array();
        foreach ($permissions as $value) {
            // Posición 0 => Módulo
            // Posición 1 => Permiso
            // Posición 2 => Acción
            $permArray = explode("-", $value->name);
            if (!isset($perm[$permArray[0]])) {
                $perm[$permArray[0]] = array();
            }
            if (!isset($perm[$permArray[0]][$permArray[1]])) {
                $perm[$permArray[0]][$permArray[1]] = array();
            }
            $perm[$permArray[0]][$permArray[1]][$permArray[2]] = $value->id;
        }
        $order = ["admin", "create", "view", "edit", "delete"];

        //return view('access.role.index', ["title" => "Roles"]);
        return view("access.role.view", ["title" => "Permisos", "role" => $role, "permissions" => $perm, "permOrder" => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $input = $request->all();
        $data["name"] = $input["roleName"];
        $data["status"] = isset($input["status"]);
        $data["is_manager"] = isset($input["isAdmin"]);
        $role->fill($data)->save();

        return redirect('role')->with('success', "update-success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $data["status"] = 0;
        $role->fill($data)->save();
        return redirect('role')->with('success', "delete-success");
    }


    public function listRoles(Request $request){
        if (isset($request->cod)) {
            if (isset($request->search)) {
                $roles = Role::whereIn("site_id", explode(",",$request->cod))
                            ->where('name', "like", '%' . $request->search . '%')
                            ->get();
            } else {
                $roles = Role::whereIn("site_id", explode(",",$request->cod))->get();
            }

            return response()->json(
                [
                    'lista' => $roles,
                    'success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false
                ]
            );
        }
    }

    public function givePermission(Request $request){
        $role = Role::find($request->id);
        $role->givePermissionTo($request->add);
        return true;
    }

    public function revokePermission(Request $request){
        $role = Role::find($request->id);
        $role->revokePermissionTo($request->revoke);
    }

    public function validator(Request $request, $id){
        $messages = [
            'name.required' => 'Debe ingresar nombre',
        ];
        $rules = [
            'name' => ['required',Rule::unique('roles')->ignore($id),],
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        return $validator;
    }

    public function export(Request $request)
    {
        $filename = 'Roles_'.time() .'.xlsx';
        //creo la notificacion para cuando se recarga la pagina
        $data["json"] = '{"filename": "'.$filename.'", "location": "Roles"}';
        $data["ready"] = false;
        $notification = request()->user()->notifications()->create($data);
        //coloco en fila la creacion del excel
        (new RoleExport)->queue($filename);
        //creo una cola de la exportacion done....
        event(new ExportDone($notification->id, $filename, "Roles"));
        return back()->withSuccess('Export started!');
    }

    public function activate(Request $request){
        $role = Role::find($request->id);
        $data["status"] = 1;
        $role->fill($data)->save();
    }
}
