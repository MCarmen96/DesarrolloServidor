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
        //

        Schema::create('emples',function (Blueprint $table){
            $table->integer('emple_no')->primary();
            $table->string('apellido');
            $table->string('oficio');
            $table->integer('dir')->foreign('emple_no');
            $table->date('fecha_alt');
            $table->double('salario');
            $table->double('comision');
            $table->foreign('emple_no')->references('depart_no')->on('departs2')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('emples');
    }
};
