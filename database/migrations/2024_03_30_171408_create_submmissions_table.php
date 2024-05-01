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
        Schema::create('submmissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->text('description');
            $table->string('status', 10);
            $table->integer('approve')->default(0);
            $table->datetime('approve_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submmissions');
    }
};
