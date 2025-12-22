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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del curso (ej: "1A", "2B")
            $table->string('grade'); // Grado: Párvulo, Primero, Segundo, Tercero, Cuarto, Quinto
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // Director de grupo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
