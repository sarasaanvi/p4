@extends('_base')
@section('sidebar_content')
	<ul>	
		<li>
			<a href='/teacher/'>Home</a>	
		</li>
		<li>
			<a href='/teacher/param-marks'>Add Marks</a>	
		</li>
		<li >
			<div id="attendance" style='display: none;'>
				<form action='\teacher\add-attendance\' method='GET'>
					<input name ="grade_id" type="text" value="Select Grade" onClick= "this.value='';" onFocus= "this.select()" onBlur = "this.value=!this.value?'Select Grade':this.value;" style= "background-color : #99FFCC; width: 100px;">
					<input type="submit" value="OK" style= "background-color : #99FFCC; width: 50px;">
				</form>
			</div>

			<script>
			function attendFunction() {
				var x = document.getElementById("attendance");
				var y = document.getElementById("attendanceLink");
				  
				if (x.style.display == 'block') {
						x.style.display = 'none';
						this.style.innerHTML = 'Add Attendance';
				} else {
					x.style.display = 'block';
					this.style.innerHTML = 'Cancel Attendance';
				}
				           
				//x.style.color = "red"; 
			}
			</script>
			<!--<a href='/teacher/add-achievement'>Add Achievements</a>-->
			<a onclick="attendFunction()" id= "attendanceLink"  >Add attendance</a>			
		</li>
		<li>
			<div id="demo" style='display: none;'>
				<form action="add-achievement">
					<input type="text" value="Select Grade" onClick= "this.value='';" onFocus= "this.select()" onBlur = "this.value=!this.value?'Select Grade':this.value;" style= "background-color : #99FFCC; width: 100px;">
					<input type="submit" value="OK" style= "background-color : #99FFCC; width: 50px;">
				</form>
			</div>

			<script>
			function myFunction() {
				var x = document.getElementById("demo");
				var y = document.getElementById("link1");
				  
				if (x.style.display == 'block') {
						x.style.display = 'none';
						this.style.innerHTML = 'Add Achievements';
				} else {
					x.style.display = 'block';
					this.style.innerHTML = 'Cancel Achievements';
				}
				           
				//x.style.color = "red"; 
			}
			</script>


		
			<!--<a href='/teacher/add-achievement'>Add Achievements</a>-->
			<a onclick="myFunction()" id= "link1"  >Add Achievements</a>
			
		</li>
		<li>
			<a href="/teacher/teacher-profile">View Profile </a>
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