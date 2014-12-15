<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtracurricularsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	Schema::create('extracurriculars',function($table){
			$table->increments('id');					
			$table->date('Activity_date');
			$table->string('Activity');
			$table->string('rank');			
			$table->integer('student_id')->unsigned();
			
			# Define foreign keys...
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
		Schema::drop('extracurriculars');
	}
}