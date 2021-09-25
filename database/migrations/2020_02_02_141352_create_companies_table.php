<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->default(null)->nullable();
            $table->string('name')->default(null)->nullable();
            $table->string('address')->default(null)->nullable();
            $table->string('city')->default(null)->nullable();
            $table->integer('zipcode')->default(null)->nullable();
            $table->integer('phone')->unsigned()->default(null)->nullable();
            $table->string('logo')->default(null)->nullable();
            $table->boolean('is_active')->default(null)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
