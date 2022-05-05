<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\File;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        // $activities = Activity::all();
        $activities = Activity::orderBy("id", "asc")->get();
        return view('activities.index', compact('activities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $theNoteUsers = [];
        $theFilesUsers = [];

        /////////////////////////////////////////////////////////////////////////
        // usuarios que agregaron notas
        $notes = Note::where('activity_id', $activity->id)->latest('id')->get();
        if(isset($notes)){
            foreach ($notes as $note) {
                $theNoteUsers[] = $note->user_id;
            }
        }
        $notesUsers = User::findMany($theNoteUsers);
        // return $notesUsers;
        
        /////////////////////////////////////////////////////////////////////////
        // usuarios que subieron archivos
        $files = File::where('activity_id', $activity->id)->latest('id')->get();
        if (isset($files)) {
            foreach ($files as $file) {
                $theFilesUsers[] = $file->user_id;
            }
        } 
        $filesUsers = User::findMany($theFilesUsers);
        // return $filesUsers;
        
        /////////////////////////////////////////////////////////////////////////


        return view('activities.edit', compact('activity','notes', 'notesUsers', 'files', 'filesUsers'));
        // return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {


        //-------------------------------------
        // Manera 1.-  Si funciona, no es necesaria

        // Note::where('activity_id', $activity->id)->latest('id')->delete();
        // File::where('activity_id', $activity->id)->latest('id')->delete();

        //-------------------------------------
        // Manera 2.- Si funciona

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
}
