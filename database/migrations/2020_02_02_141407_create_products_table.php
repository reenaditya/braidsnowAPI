<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->default(null)->nullable();
            $table->bigInteger('category_id')->unsigned()->default(null)->nullable();
            $table->string('name')->default(null)->nullable();
            $table->string('hsn_code')->default(null)->nullable();
            $table->string('product_code')->default(null)->nullable();
            $table->integer('gst_rate')->unsigned()->default(null)->nullable();
            $table->string('product_volume')->default(null)->nullable();
            $table->string('part_no')->default(null)->nullable();
            $table->boolean('is_maschine_part')->default(null)->nullable();
            $table->string('image')->default(null)->nullable();
            $table->boolean('is_active')->default(null)->nullable();
            $table->decimal('minimum_selling_price', 10,2)->unsigned()->default(null)->nullable();
            $table->decimal('selling_price', 10,2)->unsigned()->default(null)->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
