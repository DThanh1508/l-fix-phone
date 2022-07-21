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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table-> string('cusname',50);
            $table-> string('cusphonenumber',50);
            $table->date('repairday');
            $table->date('receivedday');
            $table-> string('phonename',30);
            $table-> string('phoneemei',15);
            $table-> string('model',30);
            $table-> string('note',250);
            $table-> integer('productid')->unsigned();
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
        Schema::dropIfExists('customers');
    }
};
