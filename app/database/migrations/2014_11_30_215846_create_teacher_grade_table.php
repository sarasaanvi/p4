<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherGradeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		# Create pivot table connecting `teachers` and `grade`
		Schema::create('teacher_grade', function($table) {

			# AI, PK
			# none needed

			# General data...
			$table->integer('teacher_id')->unsigned();
			$table->integer('grade_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('teacher_id')->references('id')->on('teachers');
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
		Schema::drop('teacher_grade');
	}

}
