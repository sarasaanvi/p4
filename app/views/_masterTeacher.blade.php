@extends('_base')
@section('sidebar_content')
	<ul>
		<li>
			<a href="\studentProfile">Edit Student Profile</a>
		</li>
		<li>
			<a href='/teacher/add-mark'>Add Marks</a>	
		</li>
		<li class="selected">
			<a href='/teacher/add-attendance'>Add attendance</a>	
		</li>
		<li>
			<a href="\achievementsAdd">Add Achievements</a>
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
	<span class="search-container">
				<form action="/searchStudent">
					<input type="text" onClick="this.value='';" onFocus="this.select()" onBlur="this.value=!this.value?'Enter Student Name':this.value;" value="Search Student">
					<input type="submit" id="submit" value="submit">
				</form>				
	</span>
	<br>
	<br>
	<br>
	@yield('content')
@stop