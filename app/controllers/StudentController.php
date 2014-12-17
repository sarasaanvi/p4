<?php

class StudentController extends BaseController {

	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();           
		
		$this->beforeFilter('auth');
		$user_name = Session::get('user_name');
		$teacher = Student::getStudentRecord($user_name);
		$this->student_id = $student->id;
		$this->today = date('Y-m-d');
		$this->subject_list =array("Subject1","Subject2","Subject3","Subject4","Subject5");
		

    } 
	//private $teacher = Teacher::getTeacherRecord(Session::get('user_name'));
	
		
	private function customize(){
		$user_name = Session::get('user_name');
		//echo $user_name;
		$photo_path = "/imgData/defaltImage.jpg";
		$first_name = "User";
		//$gradeList =array();
		if ($user_name) {
			$teacher = Teacher::getTeacherRecord($user_name);
			#$this->teacher_id = $teacher-id;
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
	
	# GET: http://localhost/student
	public function index()
	{
		return View::make('student-home');
		/* #Fetching all the students from students table and showing 
		$students =Student::all();
		#make sure we have result before we print the result
		if($books->isEmpty() !=True){
			
		} */
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	#http://localhost/student/create
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
