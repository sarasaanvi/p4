<?php

class UserController extends BaseController {
	
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
        $this->beforeFilter('guest',array('only' => array('getSignin','getSignup')));
	       
    } 
	
	 // # GET: http://localhost/user
    // public function getIndex() {
		// //return Redirect::action('UserController@getSignin');
    // }

    # GET: http://localhost/user/signup
    public function getSignup() {
		return View::make('signup');
    }

    # POST: http://localhost/user/signup
    public function postSignup() {			
			$user_name = Input::get('user_name');
			$password1 = Input::get('password_1');
			$password2 = Input::get('password_2');
			$rules = array(
				'user_name' => 'required', 
				'password_1' => 'required|min:3', 
				'password_2' => 'required|same:password_1'
				
			); 
			$validator = Validator::make(Input::all(), $rules);

			if($validator->fails()) {

				return Redirect::action('UserController@getSignup')
					->with('flash_message', 'Activation failed; please fix the errors.')
					->withInput()
					->withErrors($validator);
			}
			#If everything is find get the Record from the user table for this user_name and add password and mark account as activated. 
			$user = User::getAccount($user_name);
			#if user account is already activated
			if ($user->acctivated == 1){
				#Fetch Student's Home page
				return Redirect::action('UserController@getSignin')
				->with('flash_message', 'User is already activated..Welcome to Report360!');				
			}
			#Edit user in databases			
			try{
				$user->password = Hash::make(Input::get('pwd'));
				$user->activated = 1;
				$user->save();
			}
			catch(Exception $e){					
				 return Redirect::action('UserController@getSignup')->with('flash_message', 'Account Activation failed; please try again.')->withInput();
			}
			
			#Log the user in
			Auth::login($user);
			#Make user_name accessible throughout the application
			Session::put('user_name', $user_name);
			if ($user->account_type == "Student"){
				#Fetch Student's Home page
				return Redirect::action('StudentController@getSignin')->with('flash_message', 'Welcome to Report360!');				
			}elseif ($user->account_type == "Teacher"){
				#Fetch Teacher's Home page
				return Redirect::action('TeacherController@getSignin')->with('flash_message', 'Welcome to Report360!');
			}elseif ($user->account_type == "Admin"){
				return Redirect::action('AdminController@getSignin')->with('flash_message', 'Welcome to Report360!');
			}else{
				return Redirect::action('UserController@getSignup')->with('flash_message', 'Unknown Account; please try again.');
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
		if (Auth::attempt($credentials)) {
			try{
				$user = User::getAccount($user_name);				
			}catch(Exception $e){					
				 return Redirect::action('UserController@getSignin')
					->with('flash_message', 'Log in failed; please try again.')
					->withInput();
			}
			#if user account is not activated
			
			if ($user->activated == 0){
				return Redirect::action('UserController@getSignup')
							->with('flash_message', "User's account is not activated.");				
			} 
			
			
			#create home page based on the account Type
			$AccType = $user->account_type;
			if ($AccType == "Student"){
				#Fetch Home's Home page
				return Redirect::action('StudentController@getIndex')
					->with('flash_message', 'Welcome to Report360!');				
			}elseif ($AccType  == "Teacher"){
				#Fetch Teacher's Home page
				return Redirect::action('TeacherController@getIndex')
					->with('flash_message', 'Welcome to Report360!');
			}elseif ($AccType == "Admin"){
				return Redirect::action('AdminController@getIndex')
					->with('flash_message', 'Welcome to Report360!');
			} else{
				return Redirect::action('UserController@getSignin')->with('flash_message', 'Log in failed; please try again.');
			}
						
		}else{
			return Redirect::action('UserController@getSignin')
				->with('flash_message', 'Log in failed; please try again.');
		}
	}

    # ANY: http://localhost/user/signout
    public function anySignout() {
		# Log out
		Auth::logout();

		# Send them to the homepage
		return Redirect::action('UserController@getSignin');
    }

    # GET: http://localhost/user/generate-new-password
    public function getGenerateNewPassword() {

    }

}