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
        Schema::create('player_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->integer('code')->default(0);
            $table->string('photo')->nullable()->default(null);

            $table->string('status', 32)->index();
            $table->unsignedBigInteger('team_id');

            $table->foreign('player_id')->references('id')->on('player')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('team')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_detail');
    }
};
