<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;

    public function definition()
{
    $jabatan = $this->faker->randomElement(['guru', 'siswa', 'lainnya']);
        $kelas = $jabatan === 'siswa' ? $this->faker->randomElement(['1', '2', '3', '4', '5', '6']) : null;
        // $nisn_nip = $jabatan !== 'lainnya' ? $this->faker->numerify(str_repeat('#', 14)) : null;

        return [
            'nama_anggota' => $this->faker->name,
            'jabatan' => $jabatan,
            'kelas' => $kelas,
            'jenis_kelamin' => $this->faker->randomElement(['pria', 'wanita']),
            'alamat' => $this->faker->address,
            // 'no_telegram' => $this->faker->phoneNumber,
            'chat_id' => $this->faker->numerify('#########'), // nine-digit number
            'nisn_nip' => $this->faker->numerify('#########'), // nine-digit number
            // 'nisn_nip' => $nisn_nip // fourteen-digit number if jabatan is not 'lainnya'
        ];
}
}
