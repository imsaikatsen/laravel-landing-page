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
        $tables = ['mini_apps', 'dating_zones', 'live_zones', 'mall_products'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                // Adding as nullable so existing rows don't break
                // $table->string('meta_title')->nullable()->before('metaKeywords'); 
                $table->string('metaTitle')->nullable()->after('metaKeywords');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['mini_apps', 'dating_zones', 'live_zones', 'mall_products'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('metaTitle');
            });
        }
    }
};
