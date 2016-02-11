<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AfgTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('taxRates', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('rate');
            $table->timestamps();
        });

        Schema::create('tracking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('afg_id')->unsigned();
            $table->string('description');
            $table->string('cvs');
            $table->timestamps();

            $table->foreign('afg_id')
                ->references('id')
                ->on('afgs');
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tracking_id')->unsigned();
            $table->string('scope');
            $table->string('invoice');
            $table->double('fees', 12, 2);
            $table->boolean('holdback');
            $table->double('disbursements', 12, 2);
            $table->integer('taxRate_id')->unsigned();
            $table->timestamps();

            $table->foreign('tracking_id')
                ->references('id')
                ->on('tracking');

            $table->foreign('taxRate_id')
                ->references('id')
                ->on('taxrates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoices');
        Schema::drop('tracking');
        Schema::drop('taxRates');
    }
}
