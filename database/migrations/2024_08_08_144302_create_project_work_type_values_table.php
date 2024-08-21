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
        Schema::create('project_work_type_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_department_id')->constrained('project_departments')->onDelete('cascade');
            $table->foreignId('work_type_id')->constrained('work_types')->onDelete('cascade');
            $table->foreignId('option_id')->nullable()->constrained('work_type_options')->onDelete('set null');
            $table->text('value')->nullable();
            $table->enum('type', ['option', 'value'])->default('option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_work_type_values');
    }
};
