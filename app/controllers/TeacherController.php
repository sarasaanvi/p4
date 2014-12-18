<?php
use Ob\HighchartsBundle\Highcharts\Highchart;
class TeacherController extends BaseController {
	private $teacher_id = 0;
	private $today = "2014-01-12";
	
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();           
		
		$this->beforeFilter('auth');
		$user_name = Session::get('user_name');
		//$this->teacher_id = 0;
		$this->today = date('Y-m-d');
		$this->subject_list =array("Subject1","Subject2","Subject3","Subject4","Subject5");
		

    } 
	//private $teacher = Teacher::getTeacherRecord(Session::get('user_name'));
	
		
	private function customize(){
		$user_name = Session::get('user_name');
		//echo $user_name;
		$photo_path = "/imgData/defaltImage.jpg";
		$first_name = "User";
		$gradeList =array();
		if ($user_name) {
			$teacher = Teacher::getTeacherRecord($user_name);
			//$this->teacher_id = $teacher->id;
			#Getting List of Grade which belongs to this Teacher
			$gradeList = Teacher::getTeacherGrades($user_name);
			if ($teacher) {
				//print_r($teacher);
				$first_name = $teacher->first_name;
				if ($teacher->photo_path){
					$photo_path = $teacher->photo_path;
				} 					
				return array($photo_path ,$first_name,$gradeList,"") ;
							#->with('class', $class);
			}else {
				$msg = "Teacher Record for user name  " . $user_name . " was not found. Please contact Administrator ";
				return array($photo_path ,$first_name,$gradeList,$msg) ;
			}
		} else {
			$msg= "Error..Please contact your admin ";
			return array($photo_path ,$first_name,$gradeList,$msg) ;
		}
	
	}
	
	#Plot attendance chart
	public function showAttendanceChart($grade) {
		//$grade = Session::get('grade_id');
		$toDate  = date('Y-m-d');
		$m  = date('m');
		$y =date('Y');
		$fromDate = $y ."-" . $m ."-" . "01";
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		$error_msg = "";
		
		#Setting Chart properties
		$chartArray["chart"] = array("type" => "column"); 
		$chartArray["title"] = array("text" => "Attendance "); 
		$chartArray["credits"] = array("enabled" => true); 
		$chartArray["navigation"] = array("buttonOptions" => array("align" => "right")); 
		$chartArray["xAxis"] = array("title"  => array('text'  => "Students "));
		
		
		//$chartArray["yAxis"] = array("title" => $number = range(0,31));
		
		
		#Getting List of all the student in a grade
		$students = Student::getClass($grade);
		if($students) {				
			foreach ($students  as $student){			
				$categoryArray[] = $student->first_name;
				$present = 0;
				$absent = 0;
				$total =0;
				#Retrieving attendance data for this month for each student
				$attendances = Attendance::where('attendance_date', '>=', $fromDate)
								->where('attendance_date', '<', $toDate)
								->where('teacher_id', '=', $teacher_id)
								->where('grade_id', '=', $grade)
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
						$total = $total +1;
					
					}	
				}
				$attendanceArray[] = $present;
			}
		}else{
			$categoryArray[] = "No Student";
			$attendanceArray[] =0;
		}
		#$range = range(0,31);
		$chartArray["yAxis"] = array("title"  => array('text'  => "No of lecture "), "max" => $total);# , "labels" => $range );
		$chartArray["xAxis"] = array("categories" => $categoryArray);		
		$chartArray["series"][] = array("name" => "Out of Total ". $total . " Present is ", "data" => $attendanceArray); 
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
	
	# GET: http://localhost/teacher
    public function getIndex() {
		$_result = $this->customize();
		#if grade list found for Teacher
		if ($_result[2]) {
			$grade = array_values($_result[2])[0]; # Getting first element of the gradelist at Initial time
			#Setting Grade in session for other Controllers Method 
			Session::put('grade_id', $grade);
			#get the list of student for this class
			$student_list = Student::getStudentList($grade);
			if (sizeof($student_list) == 1){
				$msg = "No Student Enrolled for this class";
				return View::make('teacher-nodata') #Make view without any graph an charts
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('grade_list', $_result[2])
					->with('student_list', array()) #blank student list
					->with('msg', $msg);
					#->withInput();
			} else{
				$attendanceChart = $this->showAttendanceChart($grade);
				$marksChart = $this->showMarksChart($grade);
				$msg = "Over all Class performance for Grade " . $grade;
				return View::make('/teacher')
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('grade_list', $_result[2])
					->with('student_list', $student_list)
					->with('msg', $msg)
					->with('chartArray', $attendanceChart)
					->with('marksArray', $marksChart);				
			} 
		}
	}
	
	# POST: http://localhost/teacher
    public function postIndex() {
		$attendanceChart = array();
		$_result = $this->customize();		
		$grade = Input::get('grade_id'); 
		# User pressed "Search student" button on the home page
		if( Input::get('student_id')){
			#Make a Student view
			$id=  Input::get('student_id');
			$student = Student::getStudentRecord($id);
			$exam_list = Exam::getExamList();
			return View::make('/student-profile')
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('exam_list', $exam_list)
					->with('student', $student);
					#->with('student_list', $student_list)
					#->with('msg', $msg)
					#->with('chartArray', $attendanceChart)
					#->with('marksArray', $marksChart);	
		}else{		
			#User selected a different Grade on the Home page
			$grade = Input::get('grade_id');
			#Setting Grade in session for other Controllers Method 
			Session::put('grade_id', $grade);
			#get the list of student for this class
			$student_list = Student::getStudentList($grade);
			if (sizeof($student_list) == 1){
				$msg = "No Student Enrolled for this grade " . $grade;
				//print_r(Input::all());
				return View::make('teacher-nodata') #Make view without any graph an charts
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('grade_list', $_result[2])
					->with('student_list', array()) #blank student list
					->with('msg', $msg);
					#->withInput();
			}else{
				$attendanceChart = $this->showAttendanceChart($grade);
				$marksChart = $this->showMarksChart($grade);
				$msg = "Over all Class performance for Grade " . $grade;
				return View::make('/teacher')
					->with('flash_message', 'Welcome to Report360!')
					->with('photo_path', $_result[0])
					->with('first_name', $_result[1])
					->with('grade_list', $_result[2])
					->with('student_list', $student_list)
					->with('msg', $msg)
					->with('chartArray', $attendanceChart)
					->with('marksArray', $marksChart);				
			} 
		}
	}

    # GET: http://localhost/teacher/add-attendance
     public function getAddAttendance() {
		#Getting the list of grades from the grades table
		$_result = $this->customize();		
		if ($_result[2]) {
			$grade = array_values($_result[2])[0]; # Getting first element of the gradelist at Initial time #will take first value from the gradeList
		}
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
				->with('grade_list',$_result[2])
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
	
##############################################################################################
#Marks 
##############################################################################################
	
	# GET: http://localhost/teacher/param-marks
     public function getParamMarks() {
		#Getting the list of grades from the grades table
		$_result = $this->customize();	
		#Getting List of Exams
		$exam_list = Exam::getExamList();
		return View::make('param-marks')
				->with('photo_path', $_result[0])
				->with('first_name', $_result[1])
				->with('grade_list',$_result[2])
				->with('exam_list',$exam_list)
				->with('subject_list',$this->subject_list);
				
	} 
		
	# POST: http://localhost/teacher/param-marks
    public function postParamMarks() {
		$_result = $this->customize();	
		$grade =Input::get('grade_id');
		$exam_list = Exam::getExamList();
		$exam = $exam_list[Input::get('exam_id')];
		$subject =$this->subject_list[Input::get('subject_id')];
		$student_list = Student::getStudentList($grade);
		if (sizeof($student_list) == 1) {
			$msg = "No Student Enrolled for this class";
		}
		unset($student_list[0]);
		return View::make('add-marks')
				->with('photo_path', $_result[0])
				->with('first_name', $_result[1])
				->with('grade_id',$grade)
				->with('exam',$exam)
				->with('subject',$subject)
				->with('exam_date',Input::get('exam_date'))
				->with('student_list',$student_list);
	}
	
	# POST: http://localhost/teacher/add-marks
    public function postAddMarks() {
		$Inputs =Input::all();
		#Get Exam Key from the Exam 
		$exam_id = $exam = Exam::getIdForExam(Input::get('exam'));
		$teacher = Teacher::getTeacherRecord(Session::get('user_name'));
		$teacher_id = $teacher->id;
		foreach($Inputs as $key => $value){
			if (preg_match('/\d+/', $key)){				
					$mark = new Mark;
					$mark->student_id = $key;
					if ($value == 'Enter Marks'){ # Marks not Added
						$mark->mark_obtained = 0;
					}else{
						$mark->mark_obtained = (int)$value;
					}
					$mark->subject = Input::get('subject');
					$mark->exam_id = $exam_id;
					$mark->exam_date =Input::get('exam_date');
					$mark->teacher_id = $teacher_id;
					$mark->save();			
				}
		}
		return Redirect::action('TeacherController@getIndex')->with('flash_message', 'Marks Added ');
	}
	# GET: http://localhost/teacher/teacher-profile
     public function getTeacherProfile() {
		#Getting the list of grades from the grades table
		$_result = $this->customize();	
		$user_name = Session::get('user_name');
		$teacher = Teacher::getTeacherRecord($user_name);
		return View::make('teacher-profile')
				->with('photo_path', $_result[0])
				->with('first_name', $_result[1])
				->with('grade_list',$_result[2])
				#->with('exam_list',$exam_list)
				->with('teacher',$teacher);
				
	} 
	
}