@extends('_base')
@section('sidebar_content')
	<ul>
		<li class="selected">
			<a href="\student">Home</a>
		</li>
		<li>
			<a href="\studentProfile">Edit Student Profile</a>
		</li>
		<li>
			<a href="\viewGrad">View Grades</a>	
		</li>
		<li>
			<a href="\viewattendance">View attendance</a>	
		</li>
		<li>
			<a href="\viewachievements">View Achievements</a>
		</li>
		<li>
			<a href="\attendanceAdd">View Class Performance</a>
		</li>
		<li>
			<a href="\teacherProfile">View my Profile </a>
		</li>
	</ul>
@stop
@section('main_header')	
	<span  class ="Auth">
		@if(Auth::check())
			<a href='/user/signout'>Log out</a>
		@else 
			<a href='/user/signup'>Sign up</a> or <a href='/user/signin'>Sign in</a>
		@endif
		@if (isset($first_name))
			<span>Hello, {{ $first_name }}</span>
		@else
			<span>Hello, User </span>
		@endif
		<img  src="<?php app_path();?>{{ $photo_path }}" alt="" class= "profile-image">
	</span>
	
@stop

	
@section('main_content')	
	@yield('content')
@stop
