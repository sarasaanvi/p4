<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Creating students table containing the personal data for all the student of all the class
		Schema::create('students',function($table){
			$table->increments('id'); //unique number to identify student in the table aka enroll no
			$table->integer('roll')->unique; //unique number to identify student in the class
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
			$table->string('user_name')->unique(); //user_name is generated for each student s_id
			$table->integer('grade_id')->unsigned();
			# Define foreign keys...
			$table->foreign('grade_id')->references('id')->on('grades'); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
	}

}
