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
        Schema::table('routings', function (Blueprint $table) {
            $table->integer('load_width')->nullable();
            $table->integer('load_length')->nullable();
            $table->integer('load_height')->nullable();
        });
    }

    /**
     *
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routings', function (Blueprint $table) {
            $table->dropColumn(['load_width', 'load_length', 'load_height']);
        });
    }
};
