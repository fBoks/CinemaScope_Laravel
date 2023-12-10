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
        Schema::create('cinema_workers_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('cinema_w_id')->constrained('cinema_workers')->cascadeOnDelete();
            $table->foreignId('cinema_i_role_id')->constrained('cinema_industry_roles')->cascadeOnDelete();

            $table->unique(['cinema_w_id','cinema_i_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_workers_roles');
    }
};
