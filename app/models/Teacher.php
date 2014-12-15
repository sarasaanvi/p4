<?php

class Teacher extends Eloquent {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	# The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at'); 
	
	 
	 
	protected $table = 'teachers';
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	
	public function grades() {
        # Grades belong to many Teachers
        return $this->belongsToMany('Grade');
    }
	
	public static function getTeacherRecord($user_name) {
		$teacher = Teacher::where('user_name', '=', $user_name)
				->first();
		# If we found the user, then return it's account type
		#if($teacher->isEmpty() != TRUE) {
		return $teacher;
	}
	
	#Return an array of id and Grade pair for all grade belongs to a particular teacher
	public static function getTeacherGrades($user_name) {
		$teacher = Teacher::where('user_name', '=', $user_name)
				->first();
		# If we found the user, then return it's account type
		if($teacher->isEmpty() != TRUE) {
			# Get the Grades from this Teacher using the "grades" dynamic property
			# The name "grades" corresponds to the the relationship method defined in the above in model
			$grades = $book->grades; 
			$teacherGrades = array();
			foreach($grades as $grade) {
				 $teacherGrades[$grade->id] = $grade->grade;
			}
		}
		return $teacherGrades;
	}
	
	
	
	
}
