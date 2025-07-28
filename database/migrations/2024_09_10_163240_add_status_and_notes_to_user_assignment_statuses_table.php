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


            // Tambahkan kolom notes dengan tipe text dan nullable
            $table->text('notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_assignment_statuses', function (Blueprint $table) {

            // Hapus kolom notes
            $table->dropColumn('notes');
        });
    }
};
