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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('login')->unique;
            $table->dateTime('registered_at');
            $table->boolean('active')->default(true);
            $table->string('email')->unique;
            $table->string('password');

            $table->string('role_id');
            $table->foreign('role_id')->references('id')->on('users_roles')->cascadeOnDelete();

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
