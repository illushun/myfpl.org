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
        Schema::create('fixture_prediction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gameweek_id');
            $table->unsignedBigInteger('fixture_id');
            $table->unsignedBigInteger('team_id');
            $table->enum('outcome', ['win', 'draw', 'loss'])->index();

            $table->foreign('gameweek_id')->references('id')->on('gameweek');
            $table->foreign('fixture_id')->references('id')->on('fixture');
            $table->foreign('team_id')->references('id')->on('team');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixture_prediction');
    }
};
