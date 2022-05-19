<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
//Para las notificaciones
use App\Notifications\involucradosNotification;

class ExtraController extends Controller
{

    public function store(Request $request)
    {

        
        
        //------------------------------------------------
        // NOTIFICACIÓN A LOS ADMINISTRADORES
        //------------------------------------------------
        // $admins = User::role('Admin')->get();
        // Notification::send($admins, new involucradosNotification());
        
        //------------------------------------------------




        //------------------------------------------------
        // REGISTRAR EL NUEVO INVOLUCRADO EN LA TABLA ACTIVI_USER
        //------------------------------------------------
        $activity = Activity::find($request->actividad);
        $activity->users()->attach($request->nuevoUsuario);
        
        //------------------------------------------------




        //------------------------------------------------
        // NOTIFICACIÓN PARA EL NUEVO INVOLUCRADO
        //------------------------------------------------
        
        $elUsuario = User::find($request->nuevoUsuario);
        $NombreCompleto = $elUsuario->name." ". $elUsuario->lastname;
        $elUsuario->notify(new involucradosNotification($NombreCompleto, $activity->concept));

        //------------------------------------------------


        return redirect()->route('activities.edit', $activity);


            

    }

}