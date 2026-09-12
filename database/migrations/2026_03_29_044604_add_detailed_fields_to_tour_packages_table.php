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
            $table->string('subtitle')->nullable()->after('title');
            $table->text('highlights')->nullable()->after('description');
            $table->text('itinerary')->nullable()->after('highlights');
            $table->text('includes')->nullable()->after('itinerary');
            $table->text('excludes')->nullable()->after('includes');
            $table->string('pickup_time')->nullable()->after('excludes');
            $table->text('terms')->nullable()->after('pickup_time');
        });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'highlights', 'itinerary', 'includes', 'excludes', 'pickup_time', 'terms']);
        });
    }
};
