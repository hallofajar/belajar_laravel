<?php

namespace Database\Factories;

use App\Models\pendudukRumahModels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class pendudukRumahModelsFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	protected $model = pendudukRumahModels::class;
	public function definition()
	{
		return [
			'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
			'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
			'nama_kk' => $this->faker->name(),
			'noKK' => $this->faker->randomNumber(6,true),
			'rt' => $this->faker->numberBetween(1,4),
			'jumlah_anggota' => $this->faker->numberBetween(1,5),
			'koor_x' => '0',
			'koor_y' => '0',
		];
	}
}
