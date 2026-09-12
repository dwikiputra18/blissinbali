<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->string('location')->nullable()->after('duration');
            $table->decimal('rating', 2, 1)->nullable()->after('location');
            $table->string('badge_icon')->nullable()->after('rating');
            $table->string('badge_label')->nullable()->after('badge_icon');
        });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'location', 'rating', 'badge_icon', 'badge_label']);
        });
    }
};