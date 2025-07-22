<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'photo_id' => \App\Models\Photo::factory(),
            'amount' => $this->faker->randomFloat(5000, 50000),
            'or_code' => $this->faker->uuid,
            'payment_date' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
