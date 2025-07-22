<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('layout_name', 50);
            $table->string('type', 20); // frame, sticker, shape
            $table->integer('language_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('templates');
    }
};
