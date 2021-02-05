<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MstProduct', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->integer('category');
            $table->text('detail');
            $table->text('restrictions');
            $table->text('catalog');
            $table->text('bigram');
            $table->integer('company');
            $table->integer('display');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE MstProduct ADD FULLTEXT index content (`bigram`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MstProduct');
    }
}
