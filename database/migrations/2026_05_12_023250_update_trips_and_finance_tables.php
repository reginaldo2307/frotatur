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
        Schema::table('trips', function (Blueprint $table) {
            $table->integer('passenger_count')->default(0)->after('customer_id');
            $table->decimal('total_expenses', 10, 2)->default(0)->after('price');
        });

        Schema::table('financial_transactions', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('date');
            $table->date('paid_at')->nullable()->after('due_date');
            $table->string('status')->default('paid')->after('amount'); // pending, paid
        });

        Schema::create('trip_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->string('type'); // departure, return
            $table->json('items'); // Itens conferidos
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trip_checklists');
        
        Schema::table('financial_transactions', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'paid_at', 'status']);
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn(['passenger_count', 'total_expenses']);
        });
    }
};
