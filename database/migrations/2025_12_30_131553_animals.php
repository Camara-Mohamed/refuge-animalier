<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date')->nullable();
            $table->string('chip')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['adopted', 'adoptable', 'in_process'])->default('adoptable');
            $table->string('avatar')->nullable();
            $table->foreignId('specie_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('race_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('coat_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
