<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfgTableAndCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category',30);
            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region',30);
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location',30);
            $table->timestamps();
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client',30);
            $table->timestamps();
        });

        Schema::create('priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('priority',30);
            $table->timestamps();
        });

        Schema::create('afgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number',10)->unique();
            $table->integer('region_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->string('project_description');
            $table->integer('client_id')->unsigned();
            $table->string('priority_number');
            $table->integer('priority_id')->unsigned();
            $table->string('year',4);
            $table->double('estimate', 8, 2);
            $table->integer('manager_id')->unsigned();
            $table->timestamps();

            $table->foreign('region_id')
                ->references('id')
                ->on('regions');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations');

            $table->foreign('client_id')
                ->references('id')
                ->on('clients');

            $table->foreign('priority_id')
                ->references('id')
                ->on('priorities');

            $table->foreign('manager_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('afgs');
        Schema::drop('regions');
        Schema::drop('categories');
        Schema::drop('locations');
        Schema::drop('clients');
        Schema::drop('priorities');

    }
}
