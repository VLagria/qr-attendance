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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->boolean('is_present')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->date('date');
            $table->string('time');
            $table->boolean('is_absent');
            $table->boolean('is_late')->nullable();
            $table->string('demerit')->nullable();
            $table->string('demerit_remarks')->nullable();
            $table->string('merit')->nullable();
            $table->string('merit_remarks')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
