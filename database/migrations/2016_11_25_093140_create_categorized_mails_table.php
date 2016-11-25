<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorizedMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorized_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_group_id')->unsigned();
            $table->foreign('category_group_id')->references('id')->on('category_groups');
            $table->integer('inbox_id')->unsigned();
            $table->foreign('inbox_id')->references('id')->on('inboxes');
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
        Schema::dropIfExists('categorized_mails');
    }
}
