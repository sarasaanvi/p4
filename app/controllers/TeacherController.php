<?php

class TeacherController extends BaseController {
	
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();              
    } 
	
	private function customize(){
		$user_name = Session::get('user_name');
		//echo $user_name;
		$photo_path = "/imgData/defaltImage.jpg";
		$first_name = "User";
		if ($user_name) {
			$teacher = Teacher::getTeacherRecord($user_name);			
			if ($teacher) {
				//print_r($teacher);
				 $first_name = $teacher->first_name;
				if ($teacher->photo_path){
					$photo_path = $teacher->photo_path;
				} 					
				return array($photo_path ,$first_name,"") ;
							#->with('class', $class);
			}else {
				$msg = "Teacher Record for user name  " . $user_name . " was not found. Please contact Administrator ";
				return array($photo_path ,$first_name,$msg) ;
			}
		} else {
			$msg= "Error..Please contact your admin ";
			return array($photo_path ,$first_name,$msg) ;
		}
	
	}
	
	# GET: http://localhost/teacher
    public function getIndex() {
		$_result = $this->customize();
		return View::make('/teacher')
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('msg', $_result[2]);
		
	}

    # GET: http://localhost/teacher/add-attendance
    public function getAddAttendance() {
		#Getting the list of grades from the grades table
		$_result = $this->customize();		
		$gradeList=Grade::getGrades();
		$grade = 9; #will take first value from the gradeList
		Session::put('grade_id', $grade);
		$students =Student::getClass($grade);
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		$today = date('Y-m-d');
		#Check if Attendance is already marked ??
		$_Attendanceresult = Attendance::getClassAttendance($grade,$today,$teacher_id );	
		if ($_Attendanceresult == "Not Found") {
			return View::make('add-attendance')
				->with('photo_path', $_result[0])
				->with('first_name', $_result[1])
				->with('gradeList',$gradeList)
				->with('studentList',$students);
		} else {
			return Redirect::action('TeacherController@getShowAttendance');
		}
    }
	# POST: http://localhost/teacher/add-attendance
    public function postAddAttendance() {
		$_result = $this->customize();	
		$grade =Input::get('grade_id');
		$Inputs =Input::all();
		$studentList =Student::getClass($grade);
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		unset($Inputs['grade_id']);
		unset($Inputs['_token']);
		// #print_r($Inputs);
		$today = date('Y-m-d');
		$student_id = array_keys($Inputs);
		
		if ($studentList) {
			foreach($studentList as $student) {
				$attendance = new Attendance;
				$attendance->student_id = $student->id;
				if (in_array($student->id, $student_id)){
					$attendance->attended = 1;
				}else{
					$attendance->attended = 0;
				}
				$attendance->attendance_date = $today;
				$attendance->grade_id = $grade;
				$attendance->teacher_id = $teacher_id;
				$attendance->save();			
			}
		}
		return Redirect::action('TeacherController@getShowAttendance');
	}
	
	# GET: http://localhost/teacher/show-attendance
	public function getShowAttendance() {
		$grade = Session::get('grade_id');
		$today = date('Y-m-d');
		$_result = $this->customize();
		#Getting attendance summary
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		$_Attendanceresult = Attendance::getClassAttendance($grade,$today,$teacher_id );	
		//echo $grade;
		//print_r($_Attendanceresult);
		if ($_Attendanceresult != "Not Found") {
			$msg = "<p><h2> Today's Attendance has been marked ..!!! . </h2><br>" .
					"Attendance Summary for  Grade " . $grade . " is :" . "<br>" .
					"Total Students : " . $_Attendanceresult[0] . "<br>" .
					"Present : " . $_Attendanceresult[1] . "<br>" .
					"Absent : " . $_Attendanceresult[2] . "<br> </p>";
			
			return View::make('show-attendance')
				->with('photo_path', $_result[0])
				->with('first_name', $_result[1])
				->with('msg',$msg);
		} else {
			return View::make('show-attendance')
				->with('photo_path', $_result[0])
				->with('first_name', $_result[1])
				->with('msg',"Attendance is not found");
		}
		
	}
	
	# GET : http://localhost/teacher/edit-attendance
    public function getEditAttendance() {
		$grade = Session::get('grade_id');
		#Getting the list of grades from the grades table
		$_result = $this->customize();		
		#Check if Attendance is already marked ??
		$today = date('Y-m-d');
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		$Attendances = Attendance::getAttendanceList($grade,$today,$teacher_id );	
		return View::make('edit-attendance')
			->with('photo_path', $_result[0])
			->with('first_name', $_result[1])
			->with('grade_id',$grade)
			->with('Attendances',$Attendances);				
    }
	# POST : http://localhost/teacher/edit-attendance
    public function postEditAttendance() {
		$grade = Session::get('grade_id');
		#Check if Attendance is already marked ??
		$today = date('Y-m-d');
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		$Inputs =Input::all();
		unset($Inputs['_token']);
		print_r($Inputs);
		$error_msg = "";
		$studentList =Student::getClass($grade);
		// #print_r($Inputs);
		$student_id = array_keys($Inputs);
		if ($studentList) {
			foreach($studentList as $student) {
				$attendance = Attendance::where('student_id', '=', $student->id)
						->where('attendance_date', '=', $today)
						->where('teacher_id', '=', $teacher_id)
						->first();
				# If we found the attendance, update it
				if($attendance) {
					if (in_array($student->id, $student_id)){
						$attendance->attended = 1;
					}else{
						$attendance->attended = 0;
					}
					# Save the changes
					$attendance->save();				
				}else {
					$error_msg = $error_msg . "Attendance for student ID ". $attendance->student_id . " is not updated <br>";					
				}				
			}
			if ($error_msg){
					return Redirect::action('TeacherController@getIndex')
						->with('flash_message', $error_msg);
				}
		}
		return Redirect::action('TeacherController@getIndex')
					->with('flash_message', "Attendance Edited...!!! ");
	}
	
	# POST : http://localhost/teacher/delete-attendance
    public function postDeleteAttendance() {
		$grade = Session::get('grade_id');
		#Get the Attendance
		$today = date('Y-m-d');
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		$error_msg = "";
		$attendances = Attendance::where('attendance_date', '=', $today)
						->where('teacher_id', '=', $teacher_id)
						->where('grade_id', '=', $grade)
						->get();
		// #print_r($Inputs);
		foreach($attendances as $attendance){
			$attendance->delete();
		}
		return Redirect::action('TeacherController@getIndex')
					->with('flash_message', "Attendance Deleted...!!! ");
	}
	
}