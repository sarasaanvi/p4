<?php

class Student extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'students';
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	
	public function mark() {
        # Student has many Marks
        # Define a one-to-many relationship.
        return $this->hasMany('Mark');
    }
	
	public function attendance() {
        # Student has many Marks
        # Define a one-to-many relationship.
        return $this->hasMany('Attendance');
    }
	
	public static function genrateRoll($grade_id){
		#Fetching max roll no for in students table 
		$student =Student::where('grade_id','=',$grade_id)->count();
		if ($student){
			$roll = $student + 1;
		} else {
			$roll = 1;
		}
		return $roll;
	}
	public static function getStudentRecord($user_name) {
		$student = Student::where('user_name', '=', $user_name)->first();
		 # If we found the user, then return it's account type
		if($student) {
			#echo $user;
			return $student;
		} 
		else{
			return "Not Found";
		}
	}
	public static function getStudents() {
		#Fetching all the students from students table and showing 
		$students =Student::all();
		$studentList = Array();
		foreach($students as $student){
			$studentList[$student->id] = $student->last_name . $student->first_name;
		}
		#Removing an duplicate entry
		$studentList = array_unique($gradeList);
		return $studentList;
	}
	

	public static function getClass($grade_id) {
		#Fetching all the students from students table and showing 
		$students =Student::where('grade_id','=',$grade_id)
			->get(array('id', 'first_name','grade_id','last_name'));
		 if($students->isEmpty() != TRUE) {
			return $students;
		} 
	}
	
	
	
	#Get today's Attendance summary
	public static function getTodayAttendance($grade_id){
		#Today summary for specific grade 
		$students =Student::where('grade_id','=',$grade_id)
			->with('attendance')
			->whereHas('attendance', function($query)
			{
				$query->where('attendance_date', '=', 'CURDATE()');

			})
			->get(array('id', 'first_name','last_name'));		
			

		if($Attendances->isEmpty() != TRUE) {	
			return $Attendances;
		}
		// return $roll;
		// $student =Attendance::where('grade_id','=',$grade_id)->count();
	}

	
	
	#Get today's Attendance summary
	public static function getTodayAttendance1($grade_id){
		#Today summary for specific grade 
		$students =Student::with('attendance')
					->where('attendance.attendance_date', '=', 'CURDATE()')
					->get(array('id', 'first_name','last_name'));		
			

		if($students->isEmpty() != TRUE) {	
			foreach ($students as $student) {
				echo $student->id;
				echo $student->first_name;
				echo $student->attendance;
				
				echo "<br>";
			}
			
		}
	}
}
