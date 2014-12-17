@extends('_base')
@section('sidebar_content')
	<ul>
		<li class="selected">
			<a href="/student/">Home</a>
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
			<a href="/student/view-class">View Class Performance</a>
		</li>
		<li>
			<a href="\teacherProfile">View my Profile </a>
		</li>
	</ul>
@stop
@section('main_header')	
	<span  class ="Auth">
		
		@if (isset($first_name))
			<span>Hello, {{ $first_name  }} &nbsp;&nbsp;&nbsp;</span>
		@else
			<span>Hello, User &nbsp;&nbsp;&nbsp;</span>
		@endif
		@if(Auth::check())
			<a href='/user/signout'>Log out</a>
		@else 
			<a href='/user/signup'>Sign up</a> or <a href='/user/signin'>Sign in</a>
		@endif
	</span>
		<img  src="<?php app_path();?>{{ $photo_path }}" alt="" class= "profile-image">
	
	
@stop

@section('main_content')	
	@if (isset($first_name))
		<h3><span></span></h3>
	@else
		<h3><span></span></h3>
	@endif
		@yield('content')
@stop
