<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validate = $this->validateData($request->all());

        if ($validate->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validate->messages(),
            ]);
        }else{
            $credentials = $request->only('email', 'password');
            $user = User::where('email', "=", $request["email"])->first();
            if($user == null){
                return response()->json([
                    'status'=>402,
                    'errors'=>'Usuario o Contraseña Incorrectos',
                ]);
            }else{
                if($request["close"]){
                    //vuelta de la pregunta
                    DB::table('sessions')->where('user_id', $user->id)
                    ->update([
                    'id' => DB::raw("concat('OUTMAN_', user_id,'_', id)"),
                    'user_id' => null,
                    ]);
                }else{
                    $sessions = DB::table('sessions')->where('user_id', $user->id)->first();
                    if($sessions != null){
                        return response()->json([
                            'status'=>401,
                        ]);
                    }
                }
            }


            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status'=>200,
                    'errors'=>"",
                ]);
            }else{
                //return redirect('login')->withErrors(['loginfail' => 'Invalid login details']);
                return response()->json([
                    'status'=>402,
                    'errors'=>'Usuario o Contraseña incorrectos...',
                ]);
            }
        }
    }

    public function validateData($data)
    {
        $rulse = [
            'email' => ['required'],
            'password' => 'required'
        ];

        $msg = [
            'email.required' => 'Usuario es necesario.',
            'password.required' => 'Contraseña es necesaria.'
        ];

        return Validator::make($data,$rulse,$msg);
    }

}
