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
        Schema::create('assign_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('fees_discount_id')->constrained();
            $table->foreignId('session_id')->constrained();
            $table->foreignId('class_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->foreignId('shift_id')->nullable()->constrained();
            $table->timestamps();
        });
    }
   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_students');
    }
};
