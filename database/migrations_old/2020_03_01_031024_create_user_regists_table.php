<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRegistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MstUser', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('nick_name', 20);
           $table->string('email', 100)->nullable();
           $table->timestamp('birthday')->nullable();
           $table->string('postalcode', 7)->nullable();
           $table->text('address')->nullable();
           $table->text('job_kind')->nullable();
           $table->text('job_hist')->nullable();
           $table->smallInteger('offering')->nullable();
           $table->text('password')->nullable();
           $table->smallInteger('accept')->nullable();
           $table->text('token')->nullable();
           $table->timestamp('tokenlimit')->nullable();
           $table->timestamp('email_verified')->nullable();
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
        Schema::dropIfExists('MstUser');
    }
}
