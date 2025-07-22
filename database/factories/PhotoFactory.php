<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'template_id' => \App\Models\Template::factory(),
            'filter_used' => $this->faker->word,
            'photo_path' => 'storage/photos/' . $this->faker->uuid . '.jpg',
        ];
    }
}