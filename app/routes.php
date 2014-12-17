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

Route::get('/test', 'TeacherController@getTest');
 // Route::get('/test', function()
 // {
	// #Getting List of Grade which belongs to this Teacher
	// //Student::getStudentRecord(1);
	// echo "<br>";
	// #echo Student::getStudentRecord(2);
	// $data = Student::getAcademicForGrade(9);
	// foreach($data as $d){
		// print_r($d);
		// echo "<br>";
	// }
	
 // });


Route::get('/', 'UserController@getSignin');
Route::controller('user','UserController');
Route::controller('teacher','TeacherController');
Route::controller('admin','AdminController');
Route::resource('student', 'StudentController');
/*
Administrator is responsible to add/edit/delete  student and Teacher data. 
At the time of admission the school admin will add new student and send and email specifying the
per defined user name (enrolment number) to student. At the time of sign up student will set 
the password and login to the system.
*/


