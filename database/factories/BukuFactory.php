<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    protected $model = Buku::class;

    public function definition()
    {
        return [
            'kode_buku' => $this->faker->unique()->numerify('BK#####'),
            'nama_buku' => $this->faker->sentence(3),
            'penulis_buku' => $this->faker->name,
            'tahun_terbit' => $this->faker->year,
            // 'status_buku' => $this->faker->boolean // Generates true or false
            'status_buku' => true
        ];
    }
}
