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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('age')->nullable()->after('birthdate');
            $table->string('gender')->nullable()->after('sex');
            $table->string('pronouns')->nullable()->after('gender');
            $table->string('address_street')->nullable()->after('address');
            $table->string('address_city')->nullable()->after('address_street');
            $table->string('address_province_state')->nullable()->after('address_city');
            $table->string('address_postal_code', 20)->nullable()->after('address_province_state');
            $table->string('address_country', 2)->default('PH')->after('address_postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'age',
                'gender',
                'pronouns',
                'address_street',
                'address_city',
                'address_province_state',
                'address_postal_code',
                'address_country',
            ]);
        });
    }
};
