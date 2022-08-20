<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name',30);
            $table->string('img',250);
            $table->string('description',250);
            $table->float('price',10,2);
            $table->unsignedInteger('version_id');
            $table->foreign('version_id')->references('id')->on('versions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
