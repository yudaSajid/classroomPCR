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
        Schema::create('challenges', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('challenge_name');
            $table->text('challenge_description');
            $table->string('challenge_slug')->unique();
            $table->boolean('challenge_publish')->default(false);
            $table->string('challenge_photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
