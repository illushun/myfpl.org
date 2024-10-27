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
            $table->unsignedBigInteger('fpl_id')->unique();
            $table->integer('code')->default(0);

            $table->string('photo')->nullable()->default(null);
            $table->string('first_name', 128)->index();
            $table->string('second_name', 128)->index();
            $table->string('web_name')->index();

            $table->smallInteger('squad_number')->nullable()->default(null);
            $table->string('status', 32)->index();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('player_type');
            $table->enum('special', ['true', 'false'])->default('false');

            $table->foreign('team_id')->references('id')->on('team');
            $table->foreign('player_type')->references('id')->on('player_role');

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
