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
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->index();
            $table->string('short_name', 3)->index();
            $table->string('team_division')->nullable()->default(null);

            $table->smallInteger('win')->default(0);
            $table->smallInteger('draw')->default(0);
            $table->smallInteger('loss')->default(0);
            $table->smallInteger('played')->default(0);

            $table->smallInteger('position')->default(0)->index();
            $table->integer('points')->default(0)->index();

            $table->decimal('form', total: 8, places: 2)->nullable()->default(null);
            $table->smallInteger('strength')->default(0);
            $table->smallInteger('code')->default(0)->index();
            $table->smallInteger('pulse_id')->default(0);
            $table->enum('unavailable', ['true', 'false'])->default('false');

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
        Schema::dropIfExists('team');
    }
};
