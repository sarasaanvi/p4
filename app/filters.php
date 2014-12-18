<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('signin')->with('flash_message','You have to be logged in to do that.');;
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) {
	
		#Make user_name accessible throughout the application
			$user_name = Session::get('user_name');
			try{
				$user = User::getAccount($user_name);				
			}catch(Exception $e){					
				 return Redirect::action('UserController@getSignin')
					->with('flash_message', 'Log in failed; please try again.')
					->withInput();
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
	
	}

	//return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
