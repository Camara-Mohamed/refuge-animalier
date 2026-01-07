<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adopters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('number');
            $table->string('city');
            $table->string('postal_code');
            $table->enum('house_type', ['apartment', 'house', 'studio', 'loft']);
            $table->boolean('have_garden')->default(false);
            $table->string('message');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('adopters');
    }
};
