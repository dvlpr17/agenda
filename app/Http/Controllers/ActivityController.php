<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\File;
use App\Models\Note;
use App\Models\User;
use App\Notifications\FilesNotification;
use App\Notifications\NotasNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Activities.create')->only('create', 'store');
        $this->middleware('can:Activities.edit')->only('edit', 'update');
        $this->middleware('can:Activities.destroy')->only('destroy');
    }


    public function index()
    {

        //$activities = Activity::orderBy("id", "asc")->get();
        // return view('activities.index', compact('activities'));

        //------------------------------------
        //SOLO LAS ACTIVIDADES RELACIONADAS CON EL USUARIO EN TURNO
        // $activities = auth()->user()->activities;
        // return view('activities.index', compact('activities'));
        //------------------------------------

        $activities = Activity::orderBy("id", "asc")->get();
        if (is_null($activities)) {
            return view('activities.index', compact('activities'));
        } else {
            $activities = auth()->user()->activities;
            return view('activities.index', compact('activities'));
        }

       

    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'concept' => 'required',
            'description' => 'required',
            'date_petition' => 'required',
            'deadline' => 'required',
            'date_entry' => 'required',
            'status' => 'required'
        ]);

        if($request->input('user_id') != auth()->user()->id){
            //POR SI EL USUARIO MODIFICA EL ID CON EL QUE SE ESTA DANDO DE ALTA LA ACTIVIDAD
            return redirect()->guest(route('activities.create'));
        }
        //GUARDANDO LOS REGISTROS
        $activity = Activity::create($request->all());
        //GUARDANDO LA RELACIÓN USUARIOS ACTIVIDADES
        $activity->users()->attach($request->user_id);
        
        return redirect()->route('activities.edit', $activity);
    }


    public function edit(Activity $activity)
    {
        $theNoteUsers = [];
        $theFilesUsers = [];

        //---------------------------------------------------------
        // USUARIOS QUE AGREGARON NOTAS
        //---------------------------------------------------------
        $notes = Note::where('activity_id', $activity->id)->latest('id')->get();
        if(isset($notes)){
            foreach ($notes as $note) {
                $theNoteUsers[] = $note->user_id;
            }
        }
        $notesUsers = User::findMany($theNoteUsers);
        // return $notesUsers;
        //---------------------------------------------------------



        //---------------------------------------------------------
        // USUARIOS QUE SUBIERON ARCHIVOS
        //---------------------------------------------------------
        $files = File::where('activity_id', $activity->id)->latest('id')->get();
        if (isset($files)) {
            foreach ($files as $file) {
                $theFilesUsers[] = $file->user_id;
            }
        } 
        $filesUsers = User::findMany($theFilesUsers);
        // return $filesUsers;
        //---------------------------------------------------------



        //---------------------------------------------------------
        // USUARIOS REGISTRADOS EN LA ACTIVIDAD
        //---------------------------------------------------------
        $users = $activity->users;
        $au = [];

        if(!empty($users)){
            foreach ($users as $elUsuario) {
                $au[] = $elUsuario->id;
            }
        }

        //Solo los usuarios no agregados a la actividad
        $allUsers = User::select("*")->whereNotIn('id', $au)->get();
        // $allUsers = User::all();
        //return $activity->users;
        //---------------------------------------------------------



        if(session()->has('procedencia')){

            $value = session()->get('procedencia');
            session()->forget('procedencia');

            $NombreCompleto = auth()->user()->name.' '.auth()->user()->lastname;
            $admins = User::role('Admin')->get();
            
            //---------------------------------------------------------
            // CORREO POR UN ARCHIVO
            //---------------------------------------------------------
            if($value === 'Files'){
                Notification::send($admins, new FilesNotification($NombreCompleto, $activity->concept));
            }
            
            //---------------------------------------------------------
            // CORREO POR UNA NOTA
            //---------------------------------------------------------
            if ($value === 'Notas') {
                Notification::send($admins, new NotasNotification($NombreCompleto, $activity->concept));
            }


        }
        
        return view('activities.edit', compact('activity','notes', 'notesUsers', 'files', 'filesUsers', 'users', 'allUsers'));

        
        //---------------------------------------------------------



        // return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'concept' => 'required',
            'description' => 'required',
            'date_petition' => 'required',
            'deadline' => 'required',
            'date_entry' => 'required',
            'status' => 'required'
        ]);

        if ($request->input('user_id') != auth()->user()->id) {
            // POR SI EL USUARIO MODIFICA EL ID CON EL QUE SE ESTA DANDO DE ALTA LA ACTIVIDAD
            return redirect()->guest(route('activities.index'));
        }
        //ACTULIZAR LOS DATOS DEL REGISTROS
        $activity->update($request->all());

        
        return redirect()->route('activities.index');        
        
    }

    public function destroy(Activity $activity)
    {


        //-------------------------------------
        // Manera 1.-  Si funciona, pero no es necesaria

        // Note::where('activity_id', $activity->id)->latest('id')->delete();
        // File::where('activity_id', $activity->id)->latest('id')->delete();

        //-------------------------------------
        // Manera 2.- Es la mejor opción

        //BORRA LOS ARCHIVOS RELACIONADOS CON LA ACTIVIDAD
        $files = File::where('activity_id', $activity->id)->latest('id')->get();
        foreach ($files as $file) {
            Storage::delete($file->ruta);
        }

        $activity->users()->detach();
        $activity->delete();

        return redirect()->route('activities.index');

        //-------------------------------------

        
    }

    public function involucradosRemover(Request $request){
        // "usuario": "10",
        // "actividad": "30"
        $activity = Activity::find($request->actividad);
        $activity->users()->detach($request->usuario);      
        // $activity->users()->wherePivot('role_id', '!=', 3)->detach();
        
        return redirect()->route('activities.edit', $activity);
    }


}
