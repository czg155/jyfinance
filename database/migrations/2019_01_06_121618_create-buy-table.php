<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('buy', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->char('number', 20)->nullable();
        //     $table->datetime('date')->nullable();
        //     $table->timestamps();
        //     $table->string('company', 20)->nullable();
        //     $table->string('product', 10)->nullable();
        //     $table->string('type', 10)->nullable();
        //     $table->string('car', 10)->nullable();
        //     $table->double('weight', 20, 2)->nullable()->default(0);
        //     $table->string('tip', 20)->nullable();
        //     $table->string('check1', 10)->nullable();
        //     $table->string('check2', 10)->nullable();
        //     $table->string('check3', 10)->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('buy', function (Blueprint $table) {
        //     $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->after('created_at');
        // });
    }
}
