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
        Schema::create('departs',function (Blueprint $table){

            $table->id();// seria mi depart_no
            $table->string('dnombre');// dnombre
            $table->string('loc');
            $table->timestamps();
        });

        Schema::create('departs2',function(Blueprint $table){

            $table->integer('depart_no')->primary();
            $table->string('dnombre');// dnombre
            $table->string('loc');
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('departs');
        Schema::dropIfExists('departs2');
    }
};
