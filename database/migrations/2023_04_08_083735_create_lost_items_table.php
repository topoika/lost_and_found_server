<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("note")->default("N/A");
            $table->longText("description")->default("N/A");
            $table->string("phone_number")->nullable();
            $table->string("date_time")->nullable();
            $table->boolean("returned")->default(false);
            $table->unsignedBigInteger("lost_by");
            $table->foreign('lost_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};