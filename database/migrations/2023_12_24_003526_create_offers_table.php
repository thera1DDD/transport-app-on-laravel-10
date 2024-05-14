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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routings_id')
                ->nullable()
                ->index()
                ->constrained('routings')->onDelete('cascade');
            $table->foreignId('requested_users_id')
                ->nullable()
                ->index()
                ->constrained('users')->onDelete('cascade');
            $table->enum('status',['accepted','rejected','waiting','completed'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
