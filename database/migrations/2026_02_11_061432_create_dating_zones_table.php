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
        Schema::create('dating_zones', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->longText('description');
            $table->string('tag1')->nullable();
            $table->string('tag2')->nullable();
            $table->integer('count')->default(0);
            $table->text('metaKeywords')->nullable();
            $table->text('metaDescription')->nullable();
            $table->longText('customScript')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dating_zones');
    }
};
