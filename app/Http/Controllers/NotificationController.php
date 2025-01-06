<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Storage;

class NotificationController extends Controller
{
    public function destroy(Notification $notification){

        $obj = json_decode($notification->json);
        //dd(is_file(storage_path('app/'.$obj->filename)));
        if(is_file(storage_path('app/'.$obj->filename))){
            unlink(storage_path('app/'.$obj->filename));
        }

        $deleted = $notification->delete();

        return response()->json([
            'status' => 200,
            'message' => "Eliminado Correctamente",
        ]);
    }

    public function download(Request $request)
    {
        $file = $request["filename"];
        return response()->download(storage_path('app/'. $file));
    }
}
