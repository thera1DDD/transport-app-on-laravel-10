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
        Schema::create('routings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->bigInteger('price');
            $table->enum('route_type',['carrier','sender']);
            $table->enum('status',['accepted','waiting'])->default('waiting');
            $table->string('from_place');
            $table->string('to_place');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('load_type');
            $table->string('load_size');
            $table->foreignId('owners_id')
                ->nullable()
                ->index()
                ->constrained('users')->onDelete('cascade');
            $table->integer('sort')->default(500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routings');
    }
};
