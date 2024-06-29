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
        Schema::table('auctions', function (Blueprint $table) {
            $table->enum('status', ['ACTIVE', 'FINISHED', 'CANCELLED'])->default('ACTIVE')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->enum('status', ['ACTIVE', 'FINISHED', 'CANCELED'])->default('ACTIVE')->change();
        });
    }
};
