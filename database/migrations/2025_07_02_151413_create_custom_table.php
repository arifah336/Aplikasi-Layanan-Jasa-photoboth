<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('custom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('photo_id'); // ✅ pastikan ini unsigned
            $table->string('sticker_used')->nullable();
            $table->string('shape_used')->nullable();
            $table->string('color_frame')->nullable();
            $table->timestamps();

            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom');
    }
};
