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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('status')->default('pending');
            $table->string('email');
            $table->string('assignfrom')->nullable();
            $table->string('assignto')->nullable();
            $table->integer('assignid')->nullable();
            $table->string('file')->nullable();
            $table->string('comments')->nullable();
            $table->string('commentsby')->nullable();
            $table->string('commentstime')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
