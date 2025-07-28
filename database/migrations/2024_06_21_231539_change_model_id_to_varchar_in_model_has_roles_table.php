<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Cek apakah kolom 'model_id' ada sebelum mengubah tipe datanya
        if (Schema::hasColumn('model_has_roles', 'model_id')) {
            Schema::table('model_has_roles', function (Blueprint $table) {
                // Mengubah kolom 'model_id' menjadi VARCHAR(255)
                $table->string('model_id', 255)->change();
            });
        }
    }

    public function down()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            // Mengubah kolom 'model_id' kembali ke tipe sebelumnya
            // Asumsi tipe sebelumnya adalah BIGINT
            $table->bigInteger('model_id')->change();
        });
    }
};
