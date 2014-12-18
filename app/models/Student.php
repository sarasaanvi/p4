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
	
	public function marks() {
        # Student has many Marks
        # Define a one-to-many relationship.
        return $this->hasMany('Mark');
    }
	
	public function attendances() {
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
	public static function getStudentData($user_name) {
		$student = Student::where('user_name', '=', $user_name)
				->first();
		
		return $student;
	}
	#fetch whole record for student with student id
	public static function getStudentRecord($id) {
		$student = Student::find($id);
		if($student) {
			// echo $student->first_name;
			// echo "<br>";
			
			// foreach($student->marks as $mark) {
				// echo $mark;
				// echo "<br>";
			// }
			// foreach($student->attendances as $attendance) {
				// echo $attendance;
				// echo "<br>";
			// }
			return $student;
		}else{
			return "Not Found";
		}
	}
	
	public static function getAcademicForGrade($grade){
		$students =Student::where('grade_id','=',$grade)
			->get(array('id', 'first_name','grade_id','last_name'));
		//$academics = array();	
		if($students->isEmpty() != TRUE) {
			$exams = array();	
			$unknownSubject =0;
			$total =0;
			$exam_list = Exam::getExamList();			
			foreach($exam_list as $key => $value){
				$subject = array("total" => 0,"data" => array(0,0,0,0,0));
				$total =0;
				foreach($students as $student){
					$StudentRecord = Student::getStudentRecord($student->id);
					foreach($student->marks as $mark) {						
						if ($mark->exam_id == $key ){
							if ($mark->subject == "Subject1" ){
								$subject["data"][0] = $subject["data"][0] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject2" ){
								$subject["data"][1] = $subject["data"][1] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject3" ){
								$subject["data"][2] = $subject["data"][2] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject4" ){
								$subject["data"][3] = $subject["data"][3] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject5" ){
								$subject["data"][4] = $subject["data"][4] + $mark->mark_obtained;
							}else{
								$unknownSubject = $unknownSubject + $mark->mark_obtained;
							}							
							$subject["total"] = $subject["total"] + $mark->mark_obtained;
						}	
					}
					
				}
				//$academics[$student->id] = $exams;
				$exams[$key] = $subject;
				#print_r($exams);
				//echo "<br>";
			}
			return $exams;	
		}
	}
	
	
	#Calculate the total marks for all the stidents in a Grade
	public static function getAcademicForStudent($grade){
		$students =Student::where('grade_id','=',$grade)
			->get(array('id', 'first_name','grade_id','last_name'));
		$academics = array();	
		if($students->isEmpty() != TRUE) {			
			foreach($students as $student){
				$StudentRecord = Student::getStudentRecord($student->id);
				//echo "student name : ". $student->first_name;
				//echo "<br>";				
				$exams = array();	
				$unknownSubject =0;
				$total =0;
				$exam_list = Exam::getExamList();
				foreach($exam_list as $key => $value){
					$subject = array("total" => 0,"data" => array(0,0,0,0,0));
					$total =0;
					foreach($student->marks as $mark) {						
						if ($mark->exam_id == $key ){
							if ($mark->subject == "Subject1" ){
								$subject["data"][0] = $subject["data"][0] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject2" ){
								$subject["data"][1] = $subject["data"][1] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject3" ){
								$subject["data"][2] = $subject["data"][2] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject4" ){
								$subject["data"][3] = $subject["data"] + $mark->mark_obtained;
							}elseif ($mark->subject == "Subject5" ){
								$subject["data"] = $subject["data"] + $mark->mark_obtained;
							}else{
								$unknownSubject = $unknownSubject + $mark->mark_obtained;
							}							
							$subject["total"] = $subject["total"] + $mark->mark_obtained;
						}	
					}
					$exams[$key] = $subject;
				}
				$academics[$student->id] = $exams;
				#print_r($exams);
				//echo "<br>";
			}
			return $academics;	
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
	
	public static function getStudentList($grade_id) {
		#Fetching all the students from students table and showing 
		$students =Student::where('grade_id','=',$grade_id)
			->get(array('id', 'first_name','grade_id','last_name'));
		$StudentList = array();
		$StudentList[]= "Select";
		if($students->isEmpty() != TRUE) {
			foreach($students as $student) {
				 $StudentList[$student->id] = $student->last_name . "," .$student->first_name;
			}
		}
		return $StudentList;
		 
		
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
