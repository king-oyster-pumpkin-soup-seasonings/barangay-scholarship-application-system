<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residence_verifications', function (Blueprint $table) {
            $table->id();

            // Which resident this verification belongs to
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Uploaded document file paths
            $table->string('valid_id_path');
            $table->string('proof_of_residency_path');
            $table->string('birth_certificate_path');

            // Review status
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();

            // Who reviewed it, and when
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residence_verifications');
    }
};