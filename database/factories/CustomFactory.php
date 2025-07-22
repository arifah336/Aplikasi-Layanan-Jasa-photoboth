<?php

namespace Database\Factories;

use App\Models\Custom;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomFactory extends Factory
{
    protected $model = Custom::class;

    public function definition()
    {
        return [
            'photo_id' => \App\Models\Photo::factory(),
            'sticker_used' => $this->faker->word,
            'shape_used' => $this->faker->word,
            'color_frame' => $this->faker->safeColorName,
        ];
    }
}