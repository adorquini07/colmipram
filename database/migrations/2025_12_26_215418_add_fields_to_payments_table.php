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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('student_id')->after('id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['matricula', 'mensualidad'])->after('student_id');
            $table->decimal('amount', 10, 2)->after('type');
            $table->unsignedTinyInteger('month')->after('amount'); // 1-12
            $table->unsignedSmallInteger('year')->after('month');
            $table->date('payment_date')->after('year');
            $table->text('notes')->nullable()->after('payment_date');
            
            // Índice para búsquedas rápidas
            $table->index(['student_id', 'month', 'year', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['student_id', 'month', 'year', 'type']);
            $table->dropForeign(['student_id']);
            $table->dropColumn(['student_id', 'type', 'amount', 'month', 'year', 'payment_date', 'notes']);
        });
    }
};
