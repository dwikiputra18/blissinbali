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
        Schema::table('tour_packages', function (Blueprint $table) {
        // Renaming konseptual: price_2_4, price_5_7, price_8_14 digunakan untuk SINGLE
        // Tambahkan kolom khusus TANDEM:
        $table->decimal('tandem_price_2_4', 12, 2)->nullable()->after('activity_tandem_price');
        $table->decimal('tandem_price_5_7', 12, 2)->nullable()->after('tandem_price_2_4');
        $table->decimal('tandem_price_8_14', 12, 2)->nullable()->after('tandem_price_5_7');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            //
        });
    }
};
