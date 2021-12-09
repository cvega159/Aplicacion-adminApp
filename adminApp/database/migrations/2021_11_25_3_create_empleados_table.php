<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id()->autoIncrement();
            
            $table->unsignedBigInteger('idpuesto');
            $table->string('name', 100);
            $table->string('apellidos', 100);
            $table->string('email', 200)->unique();
            $table->string('telefono',9)->unique();
            $table->date('fechacontrato')->useCurrent();
            $table->foreign('idpuesto')->references('id')->on('puesto')->onDelete('cascade');
            //$table->foreign('iddepartamento')->references('id')->on('departamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}


//nombre, apellidos, email, telefono, fechacontrato, idpuesto, iddepartamento