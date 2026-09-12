<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->decimal('price_1_pax', 12, 2)->nullable()->after('price');
        });

        DB::statement('UPDATE tour_packages SET price_1_pax = price_2_4 + 300000 WHERE price_1_pax IS NULL AND price_2_4 IS NOT NULL');
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn('price_1_pax');
        });
    }
};
