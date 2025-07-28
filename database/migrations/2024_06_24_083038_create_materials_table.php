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
        Schema::create('materials', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('material_name');
            $table->text('material_type');
            $table->text('material_link')->nullable();
            $table->text('material_text')->nullable();
            $table->foreignUlid('chapter_id')->constrained('chapters')->onDelete('cascade');
            $table->integer('order_number');
            $table->time('duration');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
