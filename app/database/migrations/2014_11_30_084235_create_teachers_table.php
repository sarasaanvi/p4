<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Creating login table
		Schema::create('teachers',function($table){
			$table->increments('id'); # Use to identify a teacher uniquely in school aka Employee ID
			$table->string('first_name');
			$table->string('middle_name');
			$table->string('last_name');
			$table->date('dob');
			$table->string('email');
			$table->integer('phone');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->integer('zip');
			$table->string('photo_path');
			$table->string('user_name')->unique();
			# Define foreign keys...
			#$table->foreign('user_id')->references('id')->on('users'); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teachers');
	}

}
