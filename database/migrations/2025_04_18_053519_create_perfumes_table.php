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
    Schema::create('perfumes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('marca');
        $table->decimal('precio', 8, 2);
        $table->string('genero');
        $table->string('volumen');
        $table->decimal('rating', 2, 1)->default(5);
        $table->boolean('envio_gratis')->default(false);
        $table->string('etiquetas')->nullable(); // Ej: "HOT,REGALO"
        $table->string('imagen')->nullable(); 
        $table->foreignId('id_categoria')->constrained('categorias');
        $table->timestamps(); // opcional
    });
}

  
    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};
