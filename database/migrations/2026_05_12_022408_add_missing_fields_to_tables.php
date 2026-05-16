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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->integer('capacity')->nullable()->after('year');
            $table->string('fuel_type')->nullable()->after('capacity');
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->string('cpf')->nullable()->after('name');
            $table->string('email')->nullable()->after('cpf');
            $table->string('address')->nullable()->after('phone');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('phone');
            $table->string('address')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['capacity', 'fuel_type']);
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['cpf', 'email', 'address']);
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['notes', 'address']);
        });
    }
};
