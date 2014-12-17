
<?php

class StudentController extends BaseController {

	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();           
		
		$this->beforeFilter('auth');

		$this->today = date('Y-m-d');
		$this->subject_list =array("Subject1","Subject2","Subject3","Subject4","Subject5");
		

    } 
		
	private function customize(){
		$user_name = Session::get('user_name');
		//echo $user_name;
		$photo_path = "/imgData/defaltImage.jpg";
		$first_name = "User";
		//$gradeList =array();
		if ($user_name) {
			$student = student::getStudentData($user_name);
			$student_id = $student->id;
			
		if ($student) {
				$first_name = $student->first_name;
				if ($student->photo_path){
					$photo_path = $student->photo_path;
				} 					
				return array($photo_path ,$first_name,"") ;
							
			}else {
				$msg = "student Record for user name  " . $user_name . " was not found. Please contact Administrator ";
				return array($photo_path ,$first_name,$msg) ;
			}
		} else {
			$msg= "Error..Please contact your admin ";
			return array($photo_path ,$first_name,$msg) ;
		}
	
	}
	
	#Plot attendance chart
	public function showAttendanceChart($grade) {
		
		$toDate  = date('Y-m-d');
		$m  = date('m');
		$y =date('Y');
		$fromDate = $y ."-" . $m ."-" . "01";
		// $teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		// $teacher_id = $teacher->id;
		$error_msg = "";		
		#Setting Chart properties
		$chartArray["chart"] = array("type" => "column"); 
		$chartArray["title"] = array("text" => "Attendance "); 
		$chartArray["credits"] = array("enabled" => true); 
		$chartArray["navigation"] = array("buttonOptions" => array("align" => "right")); 
		$chartArray["xAxis"] = array("title"  => array('text'  => "Student "));
		#$range = range(0,31);
		#$chartArray["yAxis"] = array("title"  => array('text'  => "No of lecture "));# , "labels" => $range );
		
		//$chartArray["yAxis"] = array("title" => $number = range(0,31));
		
		#Getting List of all the student in a grade
		$students = Student::getClass($grade);
		if($students) {				
			foreach ($students  as $student){
				$categoryArray[] = $student->first_name;
				$present = 0;
				$absent = 0;
				#Retrieving attendance data for this month for each student
				$attendances = Attendance::where('attendance_date', '>=', $fromDate)
								->where('attendance_date', '<', $toDate)
								#->where('teacher_id', '=', $teacher_id)
								->where('grade_id', '=', $student->grade_id)
								->where('student_id', '=', $student->id)
								->get();
								
			if($attendances->isEmpty() != TRUE) {						
					foreach($attendances as $attendance){
						//$categoris[] = $attendance->student->first_name;
						if ($attendance->attended == 1){
							$present = $present +1;
						}else{
							$absent = $absent +1;
						}	
					
					}	
				}
				$attendanceArray[] = $present;
			}
		}else{
			$categoryArray[] = "No Student";
			$attendanceArray[] =0;
		}
		$chartArray["xAxis"] = array("categories" => $categoryArray);		
		$chartArray["series"][] = array("name" => "No of class attended", "data" => $attendanceArray); 
		return $chartArray;
	}
	
	#Plot attendance chart
	#public function showMarksChart($grade,$exam_date,$subject,$exam) {
	public function showMarksChart($grade) {
		// #Setting Chart properties
		$chartArray["chart"] = array("type" => "spline"); 		
		$chartArray["title"] = array("text" => "Academic performance ");
		$chartArray["subtitle "] = array("text" => " Subject wise performance in each exam ");		
		//$chartArray["credits"] = array("enabled" => true); 
		$chartArray["navigation"] = array("buttonOptions" => array("align" => "right")); 
		$chartArray["xAxis"] = array("title"  => array('text'  => "Exams "));
		$chartArray["yAxis"] = array("title"  => array('text'  => "Marks Obtained "));
		#Getting List of Exams
		$exam_list = Exam::getExamList();
		$chartArray["xAxis"] = array("categories" => $this->subject_list);
		#Getting List of all the student in a grade
		$academics = Student::getAcademicForGrade($grade);	
		$series = array();	
		if($academics) {			
			foreach ($academics  as $key => $value){
				$dataseries = array();
				$dataseries["name"] = "' " . $exam_list[$key] .  "' ";
				$dataseries["data"] = $value["data"];
				$chartArray["series"][] = $dataseries;
			}
			return $chartArray;
		}else{
			$chartArray= array();
		}
		return $chartArray;
	}
	
	public function StudentAttendanceGraph(){
		$chartArray["chart"] = array("type" => "spline"); 		
		$chartArray["title"] = array("text" => "Attendance performance ");
		//$chartArray["subtitle "] = array("text" => " Subject wise performance in each exam ");		
		//$chartArray["credits"] = array("enabled" => true); 
		$chartArray["navigation"] = array("buttonOptions" => array("align" => "right")); 
		$chartArray["xAxis"] = array("title"  => array('text'  => "Exams "));
		$chartArray["yAxis"] = array("title"  => array('text'  => "Marks Obtained "));
		$user_name = Session::get('user_name');
		$student = student::getStudentData($user_name);	
		$studentData = Student::find($student->id);
		$dataseries = array();
		$dataseries["name"] = "' " . $student->first_name .  "' ";
		$attendancenew =array();
		foreach($studentData->attendances as $attendance) {
				#echo $attendance->attendance_date;
				//echo "<br>";
				$attendancenew[$attendance->attendance_date]  =  $attendance->attended;
				
			
		}
		$dataseries["data"] = $attendancenew;
		$chartArray["series"][] = $dataseries;
		return $chartArray;
	#Date.UTC(1970,  9, 27), 0 
	}
	
	# GET: http://localhost/student
	public function getIndex() {	
		$_result = $this->customize();
		$attendanceArray = $this->StudentAttendanceGraph();
		#print_r($attendanceArray);
		return View::make('student')
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('attendanceArray', $attendanceArray)
					->with('msg', $_result[2]);
		
	}
	
	# GET: http://localhost/student/view-class
	public function getViewClass() {	
		$_result = $this->customize();
		$user_name = Session::get('user_name');
		$student = student::getStudentData($user_name);		
		$attendanceChart = $this->showAttendanceChart($student->grade_id);
		$marksChart = $this->showMarksChart($student->grade_id);
		$msg = "Over all Class performance for Grade " . $student->grade_id;
		return View::make('view-class')
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('msg', $_result[2])
					->with('chartArray', $attendanceChart)
					->with('marksArray', $marksChart);	
		
	}


}
