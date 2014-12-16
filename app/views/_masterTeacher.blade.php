@extends('_base')
@section('sidebar_content')
	<ul>		
		<li>
			<a href='/teacher/param-marks'>Add Marks</a>	
		</li>
		<li >
			<a href='/teacher/add-attendance'>Add attendance</a>	
		</li>
		<li>
			<a href='/teacher/add-achievements'>Add Achievements</a>
		</li>
		<li>
			<a href="/teacher/teacherProfile">View Profile </a>
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
		@if (isset($photo_path))
		<img  src="<?php app_path();?>{{ $photo_path }}" alt="" class= "profile-image">
		@else
			<img  src="<?php app_path();?>/imgData/defaltImage.jpg" alt="" class= "profile-image">
		@endif
	</span>
	
@stop

@section('main_content')	
	@if (isset($first_name))
		<h3><span>Hello, {{ $first_name }}</span></h3>
	@else
		<h3><span>Hello, User </span></h3>
	@endif
		@yield('content')
@stop