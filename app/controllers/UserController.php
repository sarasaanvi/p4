<?php

class UserController extends BaseController {
	
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
        $this->beforeFilter('guest',array('only' => array('getSignin','getSignup')));
        
    } 
	
	 # GET: http://localhost/user
    public function getIndex() {

    }

    # GET: http://localhost/user/signup
    public function getSignup() {
		return View::make('signup');
    }

    # POST: http://localhost/user/signup
    public function postSignup() {
			$user = new User;
			#validate student from student grade and roll no. Give error if student not found and if found
			$user->user_name = Input::get('username');
			$user->password = Hash::make(Input::get('pwd'));
			$user->account_type = Input::get('account_type');
			#saving user in databases			
			try{
				$user->save();
			}
			catch(Exception $e){
				
				return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
			}
			
			#Log the user in
			Auth::login($user);
			if ($user->account_type == "Student"){
				return Redirect::to('/homeStudent')->with('flash_message', 'Welcome to Report360!');
			}elseif ($user->account_type == "Teacher"){
				return Redirect::to('/homeTeacher')->with('flash_message', 'Welcome to Report360!');
			}else{
				return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
			}
	}


    # GET: http://localhost/user/signin
    public function getSignin() {
		return View::make('signin');
    }

    # POST: http://localhost/user/signin
    public function postSignin() {
		$credentials = Input::only('user_name', 'password');
		$user_name = Input::get('user_name');	
		#Make user_name accessible throughout the application
		Session::put('user_name', $user_name);
		if (Auth::attempt($credentials, $remember = true)) {
			#create home page based on the account Type
			$AccType = User::getAccountType($user_name);
			if ($AccType == "Student"){
				#Fetch Student data
				$student = Student::getStudentRecord($user_name);
				if ($student != "Not Found") {
					if ($student->photo_path){
						$photo_path = $student->photo_path;
					} else{
						$photo_path = "/imgData/defaltImage.jpg";
					}						
					return View::make('/student')
						->with('flash_message', 'Welcome to Report360!')
						->with('photo_path', $photo_path)
						->with('first_name', $student->first_name);
						#->with('class', $class);
				}else {
					return "Student Record for user name  " . $user_id . " was not found. Please contact Administrator ";
				}
				#return Redirect::to('/student')->with('flash_message', 'Welcome to Report360!');
			}elseif ($AccType  == "Teacher"){
				#Fetch Teacher's Home page
				return Redirect::action('TeacherController@getIndex');
				//$teacher = Teacher::getTeacherRecord($user_name);
				// if ($teacher != "Not Found") {
					// if ($teacher->photo_path){
						// $photo_path = $teacher->photo_path;
					// } else{
						// $photo_path = "/imgData/defaltImage.jpg";
					// }						
					// return View::make('/teacher')
						// ->with('flash_message', 'Welcome to Report360!')
						// ->with('photo_path', $photo_path)
						// ->with('first_name', $teacher->first_name);
						// #->with('class', $class);
				// }else {
					// return "Teacher Record for user name  " . $user_id . " was not found. Please contact Administrator ";
				// }
			}elseif ($AccType == "Admin"){
				return Redirect::to('/admin')->with('flash_message', 'Welcome to Report360!');
			}else{
				return Redirect::to('/user/signin')->with('flash_message', 'Unknown Account; please try again.');
			}
		}else{
			return Redirect::to('/user/signin')->with('flash_message', 'Log in failed; please try again.');
		}
	}

    # ANY: http://localhost/user/signout
    public function anySignout() {
		# Log out
		Auth::logout();

		# Send them to the homepage
		return Redirect::to('/');
    }

    # GET: http://localhost/user/generate-new-password
    public function getGenerateNewPassword() {

    }

}