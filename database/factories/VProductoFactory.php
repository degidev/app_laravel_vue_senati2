<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_producto'=>$this->faker->jobTitle(),
            'descripcion'=>$this->faker->paragraph(),
            'stock'=>$this->faker->numberBetween(1, 100),
            'estado'=>$this->faker->boolean(90),
        ];
    }
}
