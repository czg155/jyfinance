<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::create('buy-price', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('company')->nullable();
        //     $table->string('product')->nullable();
        //     $table->string('type')->nullable();
        //     $table->datetime('begin')->nullable();
        //     $table->datetime('end')->nullable();
        //     $table->double('price', 20, 2)->nullable()->default(0);
        //     $table->string('tip')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
