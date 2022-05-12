<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\File;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // ELIMINAR Y CREAR LA CARPETA DE LOS ARCHIVOS
        Storage::deleteDirectory('archivos');
        Storage::makeDirectory('archivos');


        // CREACION DE USUARIOS RANDOM
        User::factory(9)->create();
        $activities = Activity::factory(30)->create();
        
        // CREACIÓN DE NOTAS ARCHIVOS Y RELACIÓN ENTRE USUARIOS Y ACTIVIDADES
        foreach ($activities as $activity) {

            Note::factory(1)->create([
                'user_id' => User::all()->random()->id,
                'activity_id' => Activity::all()->random()->id
            ]);

            File::factory(1)->create([
                'user_id' => User::all()->random()->id,
                'activity_id' => Activity::all()->random()->id
            ]);

            
            $users = User::inRandomOrder()->take(rand(1,3))->pluck('id');
            $activity->users()->attach($users);

            
            
        }

    }
}
