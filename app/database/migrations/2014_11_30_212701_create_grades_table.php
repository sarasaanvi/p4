<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Creating login table
		Schema::create('grades',function($table){
			$table->increments('id');
			$table->integer('grade');
			$table->string('section'); 
			#$table->integer('teacher_id')->unsigned(); //Class teacher for a grade
			# Define foreign keys...
			#$table->foreign('teacher_id')->references('id')->on('teachers'); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grades');
	}

}
