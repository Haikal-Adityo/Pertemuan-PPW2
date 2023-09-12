<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->name(),
            'penulis' => $this->faker->name(),
            'harga' => $this->faker->numberBetween(50000,300000),
            'tgl_terbit' => $this->faker->date()
        ];
    }
}
