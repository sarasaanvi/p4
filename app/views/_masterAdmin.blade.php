@extends('_master')
@section('sidebar_content')
	<ul>
		<li class="selected">
			<a href="AdminController@getIndex">Home</a>
		</li>
		<li>
			<a href="/admin/createstudent">Add New Student</a>
		</li>
		<li>
			<a href="AdminController@getEditstudent">Edit Student Details</a>
		</li>
		<li>
			<a href="AdminController@getDeleteStudent">Delete Student</a>
		</li>
		<li>
			<a href="AdminController@getCreateteacher">Add New Teacher</a>
		</li>
		<li>
			<a href="AdminController@getEditTeacher">Edit Teacher Details</a>
		</li>
		<li>
			<a href="AdminController@getDeleteTeacher">Delete Teacher</a>
		</li>
		
	</ul>
@stop