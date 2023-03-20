<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Esta migracion viene por defecto con los datos del email hasta el timestamps
        //pero como en este proyecto necesitamos mas los tenemos que agregar

        //IMPORTANTE: Para ejecutar esta migración y se cree la tabla en la BD se tiene que poner en la consola
        //el comando php artisan migrate y se creara la tabla
        //tambien en laragon tenemos que crear la BD netmex
        //y en el archivo .env cambiar los datos de conexion
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apPaterno');
            $table->string('apMaterno');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('imagen')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
