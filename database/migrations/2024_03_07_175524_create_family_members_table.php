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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id');
            $table->string('name');
            $table->integer('age');
            $table->string('sex');
            $table->string('occupation');
            $table->string('POF');
            $table->string('status');
            $table->text('remarks');
            $table->timestamps();

            $table->foreign('household_id')->references('id')->on('households');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
