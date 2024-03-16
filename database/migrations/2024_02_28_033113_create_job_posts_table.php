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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('job_title');
            $table->string('job_location');
            $table->text('job_description')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_category');
            $table->string('job_experience')->nullable();
            $table->double('job_salary');
            $table->string('job_deadline');
            $table->string('skills')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
