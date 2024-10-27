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
        Schema::create('player_role', function (Blueprint $table) {
            $table->id();
            
            $table->string('plural_name', 64);
            $table->string('plural_name_short', 3);
            $table->string('singular_name', 64);
            $table->string('singular_name_short', 3);

            $table->tinyInteger('squad_select')->default(0);
            $table->tinyInteger('squad_min_select')->nullable()->default(null);
            $table->tinyInteger('squad_max_select')->nullable()->default(null);
            $table->tinyInteger('squad_min_play')->default(0);
            $table->tinyInteger('squad_max_play')->default(0);

            $table->smallInteger('player_count')->default(0);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_role');
    }
};
