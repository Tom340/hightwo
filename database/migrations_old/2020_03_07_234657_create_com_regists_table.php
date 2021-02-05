<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComRegistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MstCom', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('postalcode', 7)->nullable();
            $table->text('address')->nullable();
            $table->string('company_tel', 11)->nullable();
            $table->string('president', 15)->nullable();
            $table->string('url',100)->nullable();
            $table->string('contact', 15)->nullable();
            $table->string('contact_tel', 11)->nullable();
            $table->string('contact_email', 100)->nullable();
            $table->string('send_postalcode', 7)->nullable();
            $table->text('send_address')->nullable();
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
        Schema::dropIfExists('MstCom');
    }
}
