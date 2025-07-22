<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Template;
use App\Models\Photo;
use App\Models\Custom;
use App\Models\Payment;
use App\Models\UserChoice;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 5 user
        User::factory(5)->create()->each(function ($user) {

            // Template layout (1 user = 3 template)
            $frame = Template::factory()->create(['type' => 'frame']);
            $sticker = Template::factory()->create(['type' => 'sticker']);
            $shape = Template::factory()->create(['type' => 'shape']);

            // Foto dari user
            $photo = Photo::factory()->create([
                'user_id' => $user->id,
                'template_id' => $frame->id
            ]);

            // Customisasi
            Custom::factory()->create([
                'photo_id' => $photo->id,
                'sticker_used' => $sticker->layout_name,
                'shape_used' => $shape->layout_name,
                'color_frame' => 'blue'
            ]);

            // Donasi / tip user
            Payment::factory()->create([
                'user_id' => $user->id,
                'photo_id' => $photo->id,
                'amount' => rand(5000, 100000)
            ]);

            // User memilih layout tertentu
            UserChoice::factory()->create([
                'user_id' => $user->id,
                'template_id' => $frame->id,
                'filter_chosen' => 'none'
            ]);
        });
    }
}