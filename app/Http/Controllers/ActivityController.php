<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

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
        $notes = Note::where('activity_id', $activity->id)->latest('id')->get();
        foreach ($notes as $note) {
            $theUsers[] = $note->user_id;
        }

        $users = User::findMany($theUsers);
        return view('activities.edit', compact('activity','notes','users'));
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

        // if ($request->input('user_id') != auth()->user()->id) {
            //POR SI EL USUARIO MODIFICA EL ID CON EL QUE SE ESTA DANDO DE ALTA LA ACTIVIDAD
            // return redirect()->guest(route('activities.create'));
        // }
        //GUARDANDO LOS REGISTROS
        // $activity = Activity::create($request->all());
        //GUARDANDO LA RELACIÓN USUARIOS ACTIVIDADES
        // $activity->users()->attach($request->user_id);

        return $request;
        // return redirect()->route('activities.edit', $activity);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
