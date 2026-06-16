<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->decimal('allowance', 10, 2);
            $table->integer('slots');
            $table->date('deadline');
            $table->enum('status', ['available', 'unavailable', 'full'])->default('available');

            // Which admin created this scholarship
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};