<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function index()
    {
        // $users = User::orderBy("id", "asc")->get();
        $users = User::all()->except(auth()->user()->id);

        return view('users.index', compact('users'));
    }

    
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
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
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
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
        //GUARDAR ROLES
        $user->roles()->sync($request->roles);


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
        $user->activities()->detach();
        $user->delete();

        return redirect()->route('users.index');
    }
}
