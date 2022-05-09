<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::orderBy("id", "asc")->get();
        return view('users.index', compact('users'));
    }

    
    public function create()
    {
        return view('users.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required'
        ]);

        //GUARDANDO LOS REGISTROS
        User::create($request->only('name','lastname','email','phone_number')
        +[
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('users.index');
    }

    
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);


        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');

        if(empty($request->pass)){

            // User::update($request->only('name', 'lastname', 'email', 'phone_number'));
        }else{

            $user->password = bcrypt($request->input('pass'));
            // User::update($request->only('name', 'lastname', 'email', 'phone_number') + [ 'password' => bcrypt($request->input('pass')) ]);
        }
        $user->update();
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        /*
        $activity->users()->detach();
        $activity->delete();
        
        return redirect()->route('activities.index');
        */
        
        $user->activities()->detach();
        $user->delete();

        return redirect()->route('users.index');

        
    }
}
