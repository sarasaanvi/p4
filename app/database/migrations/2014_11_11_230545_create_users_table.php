<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Creating login table
		Schema::create('users',function($table){
			$table->increments('id');
			$table->string('user_name')->unique(); # for student : s_id, for teacher t_id and for admin_id
			$table->string('remember_token',100); 
			$table->string('password');
			$table->string('account_type');
			$table->boolean('activated');
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
		Schema::drop('users');
	}

}
