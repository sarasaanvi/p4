@extends('_masterAdmin')
@section('stylesheet')
	<link rel="stylesheet" href="<?php public_path();?>/css/htmlDatePicker.css" rel="stylesheet" />
	<script language="JavaScript" src="<?php public_path();?>/js/htmlDatePicker.js" type="text/javascript"></script>
@stop
@section('main_content')	
	<h3><span>Edit Student Record</span></h3>
	{{ Form::open(array('action' => 'AdminController@postCreatestudent','class' => 'form-inline')) }}	
		<br>
		<fieldset>
			<legend>Personal Information</legend>	
				<span class ="mainheader">
					<img src="<?php public_path();?>/images/image.jpg" alt="" class= "profile-image">
				</span>	
				{{ Form::label( 'first', 'First Name ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'first_name' ) }}
			
				{{ Form::label( 'middle', 'Middle Name ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'middle_name' ) }}
			
			<br>
			<br>
			
				{{ Form::label( 'last', 'Last Name ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'last_name'  ) }}
				{{ Form::label( 'dob', 'Date of Birth ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'dob' ,'Select Date', array( 'id' =>"SelectedDate" ,'onClick' =>"GetDate(this);")) }}
			
			<br>
			<br>	
				{{ Form::label( 'roll', 'Roll-No ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text('roll','', array('class' => 'form-control-wrap-label')) }}
				<!--$gradeList is passed from Controller funtion -->
				{{ Form::label( 'grade', 'Grade ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::select('grade_id', $gradeList, array('class' => 'form-control-wrap-label')) }}
			<br>
			<br>
							
				{{ Form::label( 'section', 'Section ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'section' ,'A',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label( 'Photo', 'Upload Photo ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::file( 'photo_path' ) }}
			
			<br>
			<br>
		</fieldset>
		
		<br>
		<fieldset>
			<legend>Contact Information</legend>	
				{{ Form::label( 'email', 'Email Address ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'email' ) }}				
				{{ Form::label( 'phone', 'Phone ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'phone' ) }}
			
			
			<br>
			<br>
				{{ Form::label( 'address', 'Address  ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'address' ) }}
				
				{{ Form::label( 'city', 'City ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'city' ) }}
				<br>
				<br>
				{{ Form::label( 'state', 'State ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'state' ) }}
				
				{{ Form::label( 'zip', 'Zip Code ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'zip' ) }}
			<br>
			<br>
		</fieldset>
		<br>
			{{ Form::submit( 'Register','',array('class' => 'form-control-wrap-button')) }}
		<br>
			<br>
			
		{{ Form::close() }}

@stop