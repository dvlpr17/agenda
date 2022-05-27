<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //CREACIÓN DE FECHAS INICIO, FIN Y ENTREGA
        $stD = $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d');
        $endDate = $this->faker->dateTimeBetween('now','+30 days')->format('Y-m-d');
        $lastChance = $this->faker->dateTimeBetween('now', '+60 days')->format('Y-m-d');

        return [

            'concept' => $this->faker->text(150),
            'description' => $this->faker->text(2000),
            'date_petition' => $stD,
            'deadline' => $endDate,
            'date_entry' => $lastChance,
            'status' => $this->faker->randomElement(['Concluida','En Proceso','Caduca'])
            
        ];
    }
}
