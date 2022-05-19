<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = File::class;

    public function definition()
    {

        return [
            // 'ruta' => 'archivos/'.$this->faker->image('public/storage/archivos',640,480,null,false)
            'ruta' => 'archivos/'.$this->faker->image('public/storage/archivos',640,480,null,false)
        ];






    }
}
