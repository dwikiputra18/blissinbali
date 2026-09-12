<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('country_code')->default('+62')->after('phone');
            $table->text('pickup_point')->nullable()->after('travel_date');
            $table->decimal('latitude', 10, 8)->nullable()->after('pickup_point');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['country_code', 'pickup_point', 'latitude', 'longitude']);
        });
    }
};
