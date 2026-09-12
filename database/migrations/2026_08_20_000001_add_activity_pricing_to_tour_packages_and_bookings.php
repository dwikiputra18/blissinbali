<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->boolean('is_activity')->default(false)->after('tour_category_id');
            $table->decimal('activity_single_price', 12, 2)->nullable()->after('price_8_14');
            $table->decimal('activity_tandem_price', 12, 2)->nullable()->after('activity_single_price');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->string('pricing_option')->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('pricing_option');
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['is_activity', 'activity_single_price', 'activity_tandem_price']);
        });
    }
};