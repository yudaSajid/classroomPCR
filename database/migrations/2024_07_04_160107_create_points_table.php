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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade'); // Menghubungkan dengan tabel users
            $table->integer('points'); // Jumlah poin yang diberikan
            $table->string('reason')->nullable(); // Alasan pemberian poin
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
            $table->foreignId('quiz_id')->nullable()->constrained('quizzes');
            $table->foreignUuid('course_id')->nullable()->constrained('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
