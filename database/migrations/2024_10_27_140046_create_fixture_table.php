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
        Schema::create('fixture', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('code')->default(0);
            $table->integer('fixture_id')->default(0)->index(); // id
            $table->unsignedBigInteger('gameweek_id'); // event
            $table->dateTime('kickoff_time');
            $table->smallInteger('minutes')->default(0);
            
            $table->enum('started', ['true', 'false'])->default('false');
            $table->enum('finished', ['true', 'false'])->default('false');
            $table->enum('finished_provisional', ['true', 'false'])->default('false');
            $table->enum('provisional_start_time', ['true', 'false'])->default('false');
            
            $table->unsignedBigInteger('team_a');
            $table->smallInteger('team_a_score')->nullable()->default(null);
            $table->smallInteger('team_a_difficulty')->default(0);
            $table->unsignedBigInteger('team_h');
            $table->smallInteger('team_h_score')->nullable()->default(null);
            $table->smallInteger('team_h_difficulty')->default(0);

            $table->foreign('gameweek_id')->references('id')->on('gameweek')->onDelete('cascade');
            $table->foreign('team_a')->references('id')->on('team')->onDelete('cascade');
            $table->foreign('team_h')->references('id')->on('team')->onDelete('cascade');

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
        Schema::dropIfExists('fixture');
    }
};
