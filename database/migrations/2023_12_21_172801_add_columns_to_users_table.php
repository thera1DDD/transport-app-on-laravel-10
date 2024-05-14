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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('route_role',['carrier','sender']);
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('city')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['route_role', 'surname', 'patronymic', 'city', 'phone_verified_at','phone_number']);
        });
    }
};
