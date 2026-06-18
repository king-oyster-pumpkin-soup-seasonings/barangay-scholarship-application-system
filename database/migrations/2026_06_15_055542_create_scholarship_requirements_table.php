<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_requirements', function (Blueprint $table) {
            $table->id();

            // Which scholarship this requirement belongs to
            $table->foreignId('scholarship_id')->constrained('scholarships')->cascadeOnDelete();

            // Which step of the application form this shows up in
            $table->enum('category', ['eligibility', 'general_document', 'specific_document', 'additional_field']);

            // What kind of input the user fills in
            $table->enum('field_type', ['file', 'text', 'textarea', 'number', 'select', 'checkbox', 'date']);

            // The question/document name shown to the user
            $table->string('label');

            // Choices for select/checkbox types (stored as JSON array)
            $table->json('options')->nullable();

            $table->boolean('is_required')->default(true);
            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_requirements');
    }
};
