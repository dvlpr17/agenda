<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function crearFile(Activity $activity)
    {
        return view('files.create', compact('activity'));
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
    public function create()
    {
        // return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //---------------------------------
        //          VALIDACIÓN
        //---------------------------------
        $request->validate([
            'file' => 'required'
        ]);
        //---------------------------------



        //---------------------------------
        //GUARDAR ARCHIVO EN LA CARPETA ARCHIVOS DENTRO DE STORAGE
        //---------------------------------
        $url = Storage::put('archivos', $request->file('file'));
        //---------------------------------




        //---------------------------------
        //GUARDANDO REGISTRO EN LA TABLA FILES
        //---------------------------------
        File::create([
            'user_id' => $request->user_id,
            'activity_id' => $request->activity_id,
            'ruta' => $url
        ]);
        //---------------------------------

        
        
        session(['procedencia' => 'Files']);
        
        //---------------------------------
        //ESTA PARTE NO SE REQUIERE PUES DESDE EL FORMULARIO files.create.blade CON AJAX YA SE REDIRECCIONA
        //---------------------------------
        // $activity = Activity::find($request->activity_id);
        //return redirect()->route('activities.edit', $activity);
        //---------------------------------

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(File $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(File $files)
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
    public function update(Request $request, File $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $files)
    {
        
    }
}
