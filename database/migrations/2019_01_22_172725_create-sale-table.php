<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('sale', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->char('number', 20)->nullable();
        //     $table->datetime('date')->nullable();
        //     $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        //     $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        //     $table->string('company', 20)->nullable();
        //     $table->string('project', 20)->nullable();
        //     $table->string('part', 20)->nullable();
        //     $table->string('product', 10)->nullable();
        //     $table->double('weight', 20, 2)->nullable()->default(0);
        //     $table->string('car', 10)->nullable();
        //     $table->char('carindex', 3)->nullable();
        //     $table->string('tip', 20)->nullable();
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
