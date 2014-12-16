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
			$table->string('subject');	
			$table->date('exam_date');
			$table->integer('mark_obtained');
			$table->integer('teacher_id')->unsigned(); #Marks are entered by this Teacher
			$table->integer('exam_id')->unsigned();
			$table->integer('student_id')->unsigned();
			
			
			# Define foreign keys...
			$table->foreign('exam_id')->references('id')->on('exams');
			$table->foreign('student_id')->references('id')->on('students');
			$table->foreign('teacher_id')->references('id')->on('teachers');
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
	