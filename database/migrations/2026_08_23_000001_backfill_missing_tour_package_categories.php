<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tour_packages') || ! Schema::hasTable('tour_categories')) {
            return;
        }

        $category = DB::table('tour_categories')
            ->where('slug', 'uncategorized')
            ->first();

        if (! $category) {
            $categoryId = DB::table('tour_categories')->insertGetId([
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'is_active' => true,
                'sort_order' => 999,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $categoryId = $category->id;
        }

        DB::table('tour_packages')
            ->whereNull('tour_category_id')
            ->update(['tour_category_id' => $categoryId]);
    }

    public function down(): void
    {
        // Existing package assignments must not be removed during rollback.
    }
};
