<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoDocumento>
 */
class TipoDocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_documento'=>$this->faker->words(3, true),
            'codigo'=>$this->faker->stateAbbr(),
            'estado'=>$this->faker->boolean(90),
            'orden'=>$this->faker->numberBetween(1, 10),
        ];
    }
}
