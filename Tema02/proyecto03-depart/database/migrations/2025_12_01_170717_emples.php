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
            $table->integer('dir');
            $table->date('fecha_alt');
            $table->double('salario');
            $table->double('comision');
            $table->integer('depart_no');
            $table->foreign('depart_no')->references('depart_no')->on('departs2')->onDelete('cascade');
            $table->foreign('dir')->references('emple_no')->on('emples')->onDelete('cascade');
            $table->timestamps();
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
