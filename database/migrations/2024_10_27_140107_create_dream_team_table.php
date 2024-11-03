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
        Schema::create('dream_team', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('gameweek_id');
            $table->unsignedBigInteger('player_id');
            $table->smallInteger('points')->default(0)->index();
            $table->smallInteger('position')->default(0)->index();

            $table->foreign('gameweek_id')->references('id')->on('gameweek')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('player')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dream_team');
    }
};
