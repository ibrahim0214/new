<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik_dosen' => fake()->randomNumber(6),
            'nama_dosen' => fake()->name(),
            'nip' => fake()->randomNumber(9),
            'gelar_depan' => fake()->title(),
            'gelar_belakang' => fake()->text(6),
        ];
    }
}
