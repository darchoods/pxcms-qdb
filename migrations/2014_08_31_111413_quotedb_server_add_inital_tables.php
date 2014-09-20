<?php

use Illuminate\Database\Migrations\Migration;

class QuoteDbServerAddInitalTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_channels', function ($table) {
            $table->engine='InnoDB';

            $table->increments('id')->unsigned();
            $table->string('channel');
            $table->integer('quote_count')->default(0);
        });

        Schema::create('quote_content', function ($table) {
            $table->engine='InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('channel_id')->unsigned();
            $table->integer('quote_id')->unsigned()->unique();
            $table->string('author_id');
            $table->text('content');
            $table->integer('view_count')->default(0);
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('quote_votes', function ($table) {
            $table->engine='InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->integer('quote_id')->unsigned();
            $table->integer('vote')->default(0);

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
        Schema::drop('quote_votes');
        Schema::drop('quote_content');
        Schema::drop('quote_channels');
    }
}
