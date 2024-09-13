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
        Schema::create('departmentables', function (Blueprint $table) {
            $table->id();
            $table->morphs('departmentable');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade'); // Foreign key to departments table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departmentables');
    }
};
