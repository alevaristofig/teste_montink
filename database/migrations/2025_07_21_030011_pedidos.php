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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');            

            $table->integer('id_usuario'); 
            $table->string('produtos');
            $table->float('valor_total',10,2);
            $table->integer('quantidade'); 
            $table->integer('valor_frete');   
            $table->integer('desconto');   
            $table->string('status');      
                       
            $table->timestamps();      
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
