<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Role: decides what the user can do (resident, admin, or superadmin)
            $table->enum('role', ['user', 'admin', 'superadmin'])->default('user')->after('password');

            // Basic profile info
            $table->string('phone')->nullable()->after('role');
            $table->date('birthdate')->nullable()->after('phone');
            $table->enum('sex', ['male', 'female'])->nullable()->after('birthdate');
            $table->string('address')->nullable()->after('sex');

            // Residency verification status
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending')->after('address');
            $table->text('verification_remarks')->nullable()->after('verification_status');

            // Who verified this user, and when
            $table->foreignId('verified_by')->nullable()->after('verification_remarks')
                ->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('verified_by');
            $table->dropColumn([
                'role',
                'phone',
                'birthdate',
                'sex',
                'address',
                'verification_status',
                'verification_remarks',
                'verified_at',
            ]);
        });
    }
};
