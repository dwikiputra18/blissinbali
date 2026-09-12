<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'banners',
            'tour_categories',
            'tour_packages',
            'bookings',
            'car_rentals',
            'car_bookings',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (! Schema::hasColumn($tableName, 'site_id')) {
                    $table->unsignedBigInteger('site_id')->default(1)->after('id')->index();
                }
            });
        }
    }

    public function down(): void
    {
        $tables = ['banners', 'tour_categories', 'tour_packages', 'bookings', 'car_rentals', 'car_bookings'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'site_id')) {
                    $table->dropIndex(['site_id']);
                    $table->dropColumn('site_id');
                }
            });
        }
    }
};
