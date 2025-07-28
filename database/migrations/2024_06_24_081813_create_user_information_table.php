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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('current_address');
            $table->string('hometown_address');
            $table->string('province');
            $table->string('city');
            $table->string('postal_code');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
