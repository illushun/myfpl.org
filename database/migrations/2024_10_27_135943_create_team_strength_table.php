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
        Schema::create('team_strength', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id');

            $table->foreign('team_id')->references('id')->on('team');

            $table->integer('strength_overall_home')->default(0)->index();
            $table->integer('strength_overall_away')->default(0)->index();
            $table->integer('strength_attack_home')->default(0);
            $table->integer('strength_attack_away')->default(0);
            $table->integer('strength_defence_home')->default(0);
            $table->integer('strength_defence_away')->default(0);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_strength');
    }
};
