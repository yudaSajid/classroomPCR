<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_assignment_statuses', function (Blueprint $table) {
            $table->string('link')->nullable(); // Menambahkan kolom link
        });
    }

    public function down()
    {
        Schema::table('user_assignment_statuses', function (Blueprint $table) {
            $table->dropColumn('link'); // Menghapus kolom link jika migrasi di-rollback
        });
    }
};
