<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\File;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class ExtraController extends Controller
{

    public function store(Request $request)
    {


        $activity = Activity::find($request->actividad);
        $activity->users()->attach($request->nuevoUsuario);


        // return $activity;
        return redirect()->route('activities.edit', $activity);

    }

}