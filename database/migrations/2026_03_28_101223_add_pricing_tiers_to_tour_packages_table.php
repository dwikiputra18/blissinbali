<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->decimal('price_2_4', 12, 2)->nullable()->after('price')->comment('Price per person for 2-4 guests');
            $table->decimal('price_5_7', 12, 2)->nullable()->after('price_2_4')->comment('Price per person for 5-7 guests');
            $table->decimal('price_8_14', 12, 2)->nullable()->after('price_5_7')->comment('Price per person for 8-14 guests');
        });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['price_2_4', 'price_5_7', 'price_8_14']);
        });
    }
};
