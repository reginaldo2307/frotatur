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
        // Veículos
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('plate')->unique();
            $table->string('model');
            $table->string('brand');
            $table->integer('year');
            $table->string('color')->nullable();
            $table->string('renavam')->nullable();
            $table->string('chassis')->nullable();
            $table->integer('current_km')->default(0);
            $table->string('status')->default('available'); // available, maintenance, busy
            $table->date('insurance_expiry')->nullable();
            $table->date('doc_expiry')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Motoristas
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('license_number'); // CNH
            $table->string('license_category');
            $table->date('license_expiry');
            $table->string('phone')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Clientes
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('document')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Viagens
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->string('origin');
            $table->string('destination');
            $table->dateTime('departure_time');
            $table->dateTime('return_time')->nullable();
            $table->integer('start_km')->nullable();
            $table->integer('end_km')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('scheduled'); // scheduled, in_progress, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Manutenção
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained();
            $table->string('type'); // corrective, preventive
            $table->text('description');
            $table->date('date');
            $table->integer('km_at_maintenance')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->string('provider')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Financeiro
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('description');
            $table->enum('type', ['revenue', 'expense']);
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->string('category')->nullable();
            $table->foreignId('trip_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('maintenance_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
        Schema::dropIfExists('maintenances');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('vehicles');
    }
};
