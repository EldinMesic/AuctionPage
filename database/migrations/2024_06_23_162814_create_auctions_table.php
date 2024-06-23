<?php

use App\Models\User;
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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'creator_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('end_time');
            $table->decimal('starting_price');
            $table->decimal('buyout_price')->nullable();
            $table->string('item_name');
            $table->string('item_description')->nullable();
            $table->enum('status', ['ACTIVE', 'FINISHED', 'CANCELED'])->default('ACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
