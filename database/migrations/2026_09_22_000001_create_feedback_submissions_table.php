<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('language', 2)->index();
            $table->string('name');
            $table->string('company_name');
            $table->string('email')->index();
            $table->string('job_title');
            $table->string('heard_from', 40);
            $table->string('heard_from_other')->nullable();
            $table->unsignedTinyInteger('booth_rating');
            $table->string('booth_design', 20);
            $table->string('attention_aspect', 40);
            $table->string('attention_aspect_other')->nullable();
            $table->string('representative_rating', 50);
            $table->string('learned_something', 10);
            $table->text('improvements');
            $table->text('interested_products');
            $table->text('presentation_feedback');
            $table->string('overall_satisfaction', 30);
            $table->string('recommendation', 20);
            $table->text('additional_comments')->nullable();
            $table->timestamps();

            $table->index(['language', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback_submissions');
    }
};
