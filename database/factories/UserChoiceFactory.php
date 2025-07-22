<?php

namespace Database\Factories;

use App\Models\UserChoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserChoiceFactory extends Factory
{
    protected $model = UserChoice::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'template_id' => \App\Models\Template::factory(),
            'filter_chosen' => $this->faker->word,
            'chosen_at' => now(),
        ];
    }
}