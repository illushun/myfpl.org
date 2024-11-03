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
        Schema::create('player_stat', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('gameweek_id');

            $table->smallInteger('now_cost')->default(0)->index();
            $table->decimal('points_per_game', total: 8, places: 2)->default(0.00)->index();
            $table->decimal('selected_by_percent', total: 8, places: 2)->default(0.00);
            $table->smallInteger('total_points')->default(0);
            $table->decimal('form', total: 8, places: 2)->default(0.00);
            $table->decimal('value_form', total: 8, places: 2)->default(0.00);
            $table->decimal('value_season', total: 8, places: 2)->default(0.00)->index();
            $table->integer('minutes')->default(0);
            $table->smallInteger('goals_scored')->default(0)->index();
            $table->smallInteger('assists')->default(0)->index();
            $table->smallInteger('clean_sheets')->default(0);
            $table->smallInteger('goals_conceded')->default(0);
            $table->smallInteger('own_goals')->default(0);
            $table->smallInteger('penalties_saved')->default(0);
            $table->smallInteger('penalties_missed')->default(0);
            $table->smallInteger('yellow_cards')->default(0);
            $table->smallInteger('red_cards')->default(0);
            $table->smallInteger('saves')->default(0);
            $table->smallInteger('bonus')->default(0);
            $table->integer('bps')->default(0);
            $table->decimal('influence', total: 8, places: 2)->default(0.00);
            $table->decimal('creativity', total: 8, places: 2)->default(0.00);
            $table->decimal('threat', total: 8, places: 2)->default(0.00);
            $table->smallInteger('starts')->default(0);

            $table->foreign('player_id')->references('id')->on('player')->onDelete('cascade');
            $table->foreign('gameweek_id')->references('id')->on('gameweek')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_stat');
    }
};
