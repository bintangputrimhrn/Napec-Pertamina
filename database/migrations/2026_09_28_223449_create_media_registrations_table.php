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
        Schema::create('media_registrations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('media_name');

            $table->string('media_type', 50);

            $table->string('job_title');

            $table->string('email');

            $table->string('contact_number', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_registrations');
    }
};