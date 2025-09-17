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
    Schema::table('penerimaan_barangs', function (Blueprint $table) {
        $table->string('petugas_penerima')->change();
    });
}

public function down(): void
{
    Schema::table('penerimaan_barangs', function (Blueprint $table) {
        $table->date('petugas_penerima')->change();
    });
}

};
