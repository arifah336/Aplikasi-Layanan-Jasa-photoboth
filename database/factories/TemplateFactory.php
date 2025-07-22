<?php

namespace Database\Factories;

use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFactory extends Factory
{
    protected $model = Template::class;

    public function definition()
    {
        return [
            'layout_name' => $this->faker->word . ' Frame',
            'type' => $this->faker->randomElement(['frame', 'sticker', 'shape']),
            'language_id' => $this->faker->numberBetween(1, 2),
            'is_active' => true,
        ];
    }
}