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
        Schema::create('cinema_workers_films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('cinema_worker_role_id')->constrained('cinema_workers_roles')->cascadeOnDelete();
            $table->foreignId('film_id')->constrained('films')->cascadeOnDelete();

            $table->unique(['cinema_worker_role_id','film_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_workers_films');
    }
};
