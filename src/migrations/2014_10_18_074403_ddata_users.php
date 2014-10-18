<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DdataUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	Schema::create('dd-user', function($table)
            {
                $table->engine = 'InnoDB';
                $table->bigIncrements('id');
                //$table->primary('id');

                $table->string('email', 150)->unique();
                $table->string('password',64);
                $table->string('salt', 10);
                $table->string('first_name', 40)->nullable();
                $table->string('last_name', 40)->nullable();
                $table->string('city', 100)->nullable();
                $table->string('country', 3)->nullable();
                $table->timestamp('last_modified');
                $table->dateTime('date_created');
                $table->string('device_os', 40)->nullable();
                $table->string('facebook_id', 100)->nullable();
                $table->string('hashname', 150);
                $table->string('identifier', 150);
                $table->boolean('is_active')->default(0);
                $table->dateTime('last_login')->nullable();
                $table->string('login_session')->nullable();
                $table->boolean('notify_newpost')->default(0);
                $table->boolean('notify_newuser')->default(0);
                $table->string('phone', 20)->nullable();
                $table->string('pin', 10)->nullable();
                $table->string('gender', 6)->nullable();
                $table->tinyInteger('status')->default(0);
                $table->tinyInteger('ug')->default(1);
                $table->tinyInteger('uid')->default(0);
                $table->rememberToken();
                $table->date('dob')->nullable();
            });	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::dropIfExists('dd-user');
	}


}
