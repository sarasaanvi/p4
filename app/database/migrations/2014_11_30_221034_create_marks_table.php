<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
	{
		//Creating login table
		Schema::create('marks',function($table){
			$table->increments('id');			
			$table->string('subject1');	
			$table->string('subject2');	
			$table->string('subject3');	
			$table->string('subject4');	
			$table->string('subject5');				
			$table->date('exam_date');
			$table->integer('exam_id')->unsigned();
			$table->integer('student_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('exam_id')->references('id')->on('exams');
			$table->foreign('student_id')->references('id')->on('students');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('marks');
	}

}
	