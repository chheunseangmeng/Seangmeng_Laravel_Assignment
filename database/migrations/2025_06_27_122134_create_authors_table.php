<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED and AUTO_INCREMENT
            $table->string('name');
            $table->string('dob');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('nationality');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
