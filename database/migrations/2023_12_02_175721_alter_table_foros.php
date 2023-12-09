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
        Schema::table('foros', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dropColumn('name');
            $table->dropColumn('descripcion');
            $table->string('description')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
