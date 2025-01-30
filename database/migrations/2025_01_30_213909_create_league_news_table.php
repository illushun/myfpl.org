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
        Schema::create('league_news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id');

            $table->string('headline')->nullable()->default(null)->index();
            $table->text('description')->nullable()->default(null);
            $table->string('link')->nullable()->default(null);
            $table->unsignedBigInteger('category_id');
            $table->string('hash')->nullable()->default(null);

            $table->foreign('season_id')->references('id')->on('season')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('league_news_category')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league_news');
    }
};
