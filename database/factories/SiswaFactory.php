<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'level_id' => 2,
            'kelas_id' => $this->faker->numberBetween(1, 6),
            'nama' => $this->faker->name(),
            'no_hp' => $this->faker->phoneNumber(),
            'tgl_lahir' => $this->faker->dateTime(),
            'jenis_kelamin' => $this->faker->randomElement(['pria', 'perempuan']),
            'nomor_induk' => $this->faker->unique()->numberBetween(436, 500),
            'password' => Hash::make('siswa'),
            'remember_token' => Str::random(10),
        ];
    }
}
