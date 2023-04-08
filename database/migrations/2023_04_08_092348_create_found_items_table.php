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
        Schema::create('found_items', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("note")->default("N/A");
            $table->longText("description")->default("N/A");
            $table->string("phone_number")->nullable();
            $table->string("image")->nullable();
            $table->string("date_found")->nullable();
            $table->string("location_found")->nullable();
            $table->string("current_location")->nullable();
            $table->boolean("returned")->default(false);
            $table->unsignedBigInteger("found_by");
            $table->foreign('found_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_items');
    }
};