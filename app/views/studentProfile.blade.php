@extends('_master')
@section('main-content')
	<h3><span>Edit Student Profile</span></h3>
	
	{{ Form::open(array( 'url' => '/' ,'class' => 'form-inline')) }}
		
		<br>
		<fieldset>
			
			<legend>Personal Information</legend>	
				<span class ="mainheader">
					<img src="images/image.jpg" alt="" class= "profile-image">
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
				{{ Form::text( 'dob' ) }}
			
			<br>
			<br>
				{{ Form::label( 'roll_number', 'Roll Number ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'roll_number' ) }}
				{{ Form::label( 'grade', 'Grade ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'grade'  ) }}
			<br>
			<br>	
			
				{{ Form::label( 'section', 'Section ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'section' ) }}
				<br>
				<br>
				{{ Form::label( 'Photo', 'Upload Photo ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::file( 'photo' ) }}
				
			
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
				{{ Form::label( 'address1', 'Address 1 ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'address1' ) }}
				
				{{ Form::label( 'address2', 'Address 2 ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'address2' ) }}
			<br>
			<br>
				
		</fieldset>	
			<br>
			<br>
			{{ Form::submit( 'Submit','',array('class' => 'form-control-wrap-button')) }}
			<br>
			
		{{ Form::close() }}

@stop