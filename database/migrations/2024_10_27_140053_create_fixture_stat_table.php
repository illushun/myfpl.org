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
        Schema::create('fixture_stat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fixture_id');
            $table->string('identifier')->index();
            $table->string('team_type', 1)->index();
            $table->smallInteger('value');
            $table->unsignedBigInteger('player_id');

            $table->foreign('fixture_id')->references('id')->on('fixture')->onDelete('cascade');
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
        Schema::dropIfExists('fixture_stat');
    }
};
