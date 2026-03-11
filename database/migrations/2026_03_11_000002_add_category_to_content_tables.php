<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
         Schema::table('mini_apps', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('categories')
                ->nullOnDelete();
            $table->boolean('category_active')->default(false)->after('category_id');
        });

        Schema::table('dating_zones', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('categories')
                ->nullOnDelete();
            $table->boolean('category_active')->default(false)->after('category_id');
        });

        Schema::table('live_zones', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('categories')
                ->nullOnDelete();
            $table->boolean('category_active')->default(false)->after('category_id');
        });

        Schema::table('mall_products', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('categories')
                ->nullOnDelete();
            $table->boolean('category_active')->default(false)->after('category_id');
        });
    }

    public function down(): void
    {
         Schema::table('mini_apps', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('category_active');
        });

        Schema::table('mall_products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('category_active');
        });

        Schema::table('live_zones', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('category_active');
        });

        Schema::table('dating_zones', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('category_active');
        });
    }
};
