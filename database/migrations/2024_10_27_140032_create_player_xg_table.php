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
        Schema::create('player_xg', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('gameweek_id');

            $table->decimal('expected_goals', total: 8, places: 2)->default(0.00);
            $table->decimal('expected_assists', total: 8, places: 2)->default(0.00);
            $table->decimal('expected_goal_involvements', total: 8, places: 2)->default(0.00);
            $table->decimal('expected_goals_conceded', total: 8, places: 2)->default(0.00);
            $table->decimal('expected_goals_per_90', total: 8, places: 2)->default(0.00)->index();
            $table->decimal('saves_per_90', total: 8, places: 2)->default(0.00);
            $table->decimal('expected_assists_per_90', total: 8, places: 2)->default(0.00)->index();
            $table->decimal('expected_goal_involvements_per_90', total: 8, places: 2)->default(0.00);
            $table->decimal('expected_goals_conceded_per_90', total: 8, places: 2)->default(0.00);
            $table->decimal('goals_conceded_per_90', total: 8, places: 2)->default(0.00);
            $table->decimal('starts_per_90', total: 8, places: 2)->default(0.00)->index();
            $table->decimal('clean_sheets_per_90', total: 8, places: 2)->default(0.00);

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
        Schema::dropIfExists('player_xg');
    }
};
