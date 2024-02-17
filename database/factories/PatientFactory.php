<?php

namespace Database\Factories;

use App\Enums\PatientType;
use App\Models\Owner;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => PatientType::class,
            'date_of_birth' => $this->faker->date(),
            'owner_id' => Owner::factory(),
        ];
    }
}
