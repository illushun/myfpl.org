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
        Schema::create('player', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fpl_id');
            $table->unsignedBigInteger('season_id');

            $table->string('first_name', 128)->index();
            $table->string('second_name', 128)->index();
            $table->string('web_name')->index();
            $table->unsignedBigInteger('type');

            $table->foreign('type')->references('id')->on('player_type')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('season')->onDelete('cascade');

            $table->string('hash')->nullable()->default(null);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player');
    }
};
