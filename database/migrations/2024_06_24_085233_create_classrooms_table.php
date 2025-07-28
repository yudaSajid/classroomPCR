<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('class_name');
            $table->string('enrollment_year')->nullable();
            $table->string('class_alphabet')->nullable();
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->string('class_code')->unique();
            $table->string('class_description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
