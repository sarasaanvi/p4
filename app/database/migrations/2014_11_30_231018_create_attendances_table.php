<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	Schema::create('attendances',function($table){
			$table->increments('id');					
			$table->date('attendance_date');
			$table->boolean('attended');
			$table->integer('student_id')->unsigned();
			$table->integer('grade_id');
			$table->integer('teacher_id')->unsigned();
			
			# Define foreign keys...
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
		Schema::drop('attendances');
	}
}