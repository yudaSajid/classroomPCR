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
        Schema::table('user_assignment_statuses', function (Blueprint $table) {
            //
            // $table->dropColumn('completed_at');
            // Tambahkan kolom 'status' dengan tipe string
            $table->string('status')->nullable()->after('user_id'); // Sesuaikan posisi dengan kolom sebelumnya jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_assignment_statuses', function (Blueprint $table) {
            // Hapus kolom 'status'
            $table->dropColumn('status');
        });
    }
};
