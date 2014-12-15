<?php

class Teacher extends Eloquent {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'teachers';
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	
	public static function getTeacherRecord($user_name) {
		$teacher = Teacher::where('user_name', '=', $user_name)
			->first();
		# If we found the user, then return it's account type
		#if($teacher->isEmpty() != TRUE) {
			return $teacher;
	}
	

}
