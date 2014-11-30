<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/test', function()
{
	return View::make('test');
	
});
Route::get('/', function()
{
	return View::make('home');
	//return "Home Page";
	
});
Route::post('/', function()
{
	return View::make('home');
	
});


Route::get('/signup' ,array(
		'before' => 'guest',
		function(){
			return View::make('signup');
	
		}
	)
);

Route::post('/signup', array(
		'before' => 'csrf',
		function(){
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
			return Redirect::to('/home')->with('flash_message', 'Welcome to Report360!');
		}
	)
);
Route::get('/signin', array(
	'before' => 'guest',
	function(){
		return View::make('signin');	
	}
));

Route::post('/signin', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('user_name', 'password','account_type');
			
            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/signin')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('/signin');
        }
    )
);

Route::get('/signout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});
Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    #echo Pre::render($results);
	print_r($results);

});
