<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('banners', 'site_id')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->unsignedBigInteger('site_id')->default(1)->after('id');
                $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
            $table->dropColumn('site_id');
        });
    }
};
