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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('fhname');
            $table->string('serial_no');
            $table->string('address');
            $table->integer('NOFHH');
            $table->integer('NOLHH');
            $table->string('insurance');
            $table->decimal('TFI' , 20, 2);
            $table->string('wall_materials');
            $table->string('roof_materials');
            $table->string('house_and_lot');
            $table->string('disaster_prone');
            $table->date('date_interviewed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};
