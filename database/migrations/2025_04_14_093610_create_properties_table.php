<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->string('type')->default('apartment');
            $table->text('description');
            $table->timestamps();
            $table->string('image')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};