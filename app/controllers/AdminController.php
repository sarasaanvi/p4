<?php

class AdminController extends BaseController {
	
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
                
    } 
	
	 # GET: http://localhost/admin
    public function getIndex() {
		return View::make('admin');
    }

    # GET: http://localhost/admin/createstudent
    public function getCreatestudent() {
		#Getting the list of grades from the grades table
		$gradeList=Grade::getGrades();
		#print_r($gradeList);
		return View::make('student-create')->with('gradeList',$gradeList);
    }

    # POST: http://localhost/admin/createstudent
    public function postCreatestudent() {
			$student = new Student;		
			$input = Input::all();
			#print_r($input);
			#Generating a new roll number for new student 
			$grade_id = Input::get('grade_id');
			$roll = Student::genrateRoll($grade_id);
			//$student->fill(Input::all());
			$student->roll = $roll; //unique number to identify student in the class
			$student->first_name =Input::get('first_name'); 
			$student->middle_name=Input::get('middle_name'); 
			$student->last_name=Input::get('last_name'); 
			$student->dob=Input::get('dob'); 
			$student->email=Input::get('email'); 
			$student->phone=Input::get('phone'); 
			$student->address=Input::get('address'); 
			$student->city=Input::get('city'); 
			$student->state=Input::get('state'); 
			$student->zip=Input::get('zip'); 
			$student->photo_path=Input::get('photo_path'); 
			$student->grade_id=Input::get('grade_id'); 
			
			#saving student in databases			
			try{
				$student->save();
				echo "saved";
			}
			catch(Exception $e){
				return Redirect::action('AdminController@getCreatestudent')->with('flash_message', 'Adding new student failed')->withInput();
			}
			
			return Redirect::action('AdminController@getIndex')->with('flash_message', 'New Student Added');
			
	}


    # GET: http://localhost/admin/editstudent
    public function getEditstudent() {
		return View::make('student-edit');
    }

    # POST: http://localhost/admin/editstudent
    public function postEditstudent() {
		$credentials = Input::only('user_name', 'password','account_type');
		$AccType = Input::get('account_type');
        if (Auth::attempt($credentials, $remember = true)) {
				#return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
				if ($AccType == "Student"){
					return Redirect::to('/')->with('flash_message', 'Welcome to Report360!');
				}elseif ($AccType == "Teacher"){
					#return Redirect::to('/homeTeacher')->with('flash_message', 'Welcome to Report360!');
					return Redirect::to('/')->with('flash_message', 'Welcome to Report360!');
				}else{
					return Redirect::to('/admin/signin')->with('flash_message', 'Log in failed; please try again.');
					}
        }else{
            return Redirect::to('/admin/signin')->with('flash_message', 'Log in failed; please try again.');
        }

        return Redirect::to('/admin/signin');
    }

    # ANY: http://localhost/admin/logout
    public function anyLogout() {

    }

    # GET: http://localhost/admin/generate-new-password
    public function getGenerateNewPassword() {

    }

}