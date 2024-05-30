<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Relawan;
use App\Models\KejadianBencana;
use App\Models\KorbanTerdampak;
use App\Models\KerusakanFasilSosial;
use App\Models\KerusakanRumah;
use App\Models\KerusakanInfrastruktur;
use App\Models\Pengungsian;
use App\Models\EvakuasiKorban;
use App\Models\LayananKorban;
use App\Models\Assessment;
use App\Models\Tsr;
use App\Models\AlatTdb;
use App\Models\Personil;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GiatPMI>
 */
class GiatPMIFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_giatpmi' => $this->faker->unique()->randomNumber(),
            'fk_id_evakuasikankorban' => EvakuasiKorban::factory()->create()->id_evakuasikankorban,
            'fk2_id_layanankankorban' => LayananKorban::factory()->create()->id_layanankankorban,
            'rombong' => $this->faker->sentence(),
        ];
    }
}