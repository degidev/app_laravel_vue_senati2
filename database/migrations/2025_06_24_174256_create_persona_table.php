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
        Schema::create('persona', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('nombre',150);
            $table->string('apellido',150);
            $table->unsignedBigInteger('id_tipo_documento');
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('id_tipo_documento')
                ->references('id_tipo_documento')
                ->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};
