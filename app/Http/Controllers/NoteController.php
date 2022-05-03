<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{



    public function crearNota(Activity $activity)
    {
        return view('notes.create', compact('activity'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function guardarNota(Request $request){

    }

    public function create()
    {
        return view('notes.create');
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
            'nota' => 'required'
        ]);

        //GUARDANDO LOS REGISTROS
        Note::create($request->all());

        // OBTENER EL OBJETO ACTIVITY CON EL ID PARA REDIRECCIONAR A LA VISTA EDIT Y MOSTRAR LA NOTA
        $activity = Activity::find($request->activity_id);
        return redirect()->route('activities.edit', $activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
