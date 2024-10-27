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
        Schema::create('gameweek', function (Blueprint $table) {
            $table->id();
            $table->string('name', 12)->nullable()->default(null);
            $table->unsignedBigInteger('deadline')->nullable()->default(null);
            $table->integer('deadline_offset')->default(0);
            $table->enum('is_previous', ['true', 'false'])->default('false')->index();
            $table->enum('is_current', ['true', 'false'])->default('false')->index();
            $table->enum('is_next', ['true', 'false'])->default('false')->index();            

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
        Schema::dropIfExists('gameweek');
    }
};
