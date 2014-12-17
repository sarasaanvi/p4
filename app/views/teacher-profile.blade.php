@extends('_masterTeacher')
@section('content')			
	<span class="search-container">
	{{ Form::open(array('action' => 'TeacherController@getIndex','class' => 'form-inline')) }}				
					{{ Form::label( 'grade', 'Select Grade  ',array('class' => 'form-control-wrap-button')) }}					
					{{ Form::select('grade_id', $grade_list, array( 'onchange' => 'TeacherController@postIndex')) }}		
					{{ Form::submit( 'Submit ','',array('class' => 'form-control-wrap-button')) }}
				{{ Form::close() }}
	</span>
	{{ Form::open(array('url' => '/teacher', 'method' => 'GET' ,'class' => 'form-inline')) }}			
		<br>
		<fieldset>			
			<legend>Personal Information</legend>	
				{{ Form::label( 'first', 'First Name :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label( 'first_name', $teacher->first_name, array('class' => 'form-control-wrap-label')) }}
			
				{{ Form::label( 'middle', 'Middle Name :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'middle_name',' ',array('class' => 'form-control-wrap-label' )) }}
				
			
			<br>
			<br>
			
				{{ Form::label( 'last', 'Last Name :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'last_name' , $teacher->last_name ,array('class' => 'form-control-wrap-label' )) }}
				{{ Form::label( 'dob', 'Date of Birth :', array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'dob' , $teacher->dob ,array('class' => 'form-control-wrap-label' )) }}
			
			<br>
			<br>
				{{ Form::label( 'emp_no', 'Employee No :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'emp_no', $teacher->id,array('class' => 'form-control-wrap-label' )) }}
				{{ Form::label( 'grade', 'Grade :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::select(  'grade'  , array(9,10),array('class' => 'form-control-wrap-label' )) }}
			<br>
			<br>	
			
				{{ Form::label( 'section', 'Section :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'section' ,'A' ,array('class' => 'form-control-wrap-label' )) }}
				<br>
				<br>
			
		</fieldset>
		<br>
		<fieldset>
			<legend>Contact Information</legend>	
				{{ Form::label( 'email', 'Email:',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'email' , $teacher->email ,array('class' => 'form-control-wrap-label' )) }}
			<br>
			<br>	
				{{ Form::label( 'phone', 'Phone :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'phone', $teacher->phone,array('class' => 'form-control-wrap-label' )) }}
			
			<br>
			<br>
			
				{{ Form::label( 'address', 'Address  :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'address' , $teacher->address ) }}
			<br>
			<br>	
				{{ Form::label( 'city', 'City :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'city' , $teacher->city) }}
				<br>
				<br>
				{{ Form::label( 'state', 'State :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'state' , $teacher->state ,array('class' => 'form-control-wrap-label' )) }}
				
				{{ Form::label( 'zip', 'Zip Code :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'zip' , $teacher->zip,array('class' => 'form-control-wrap-label' )) }}
			<br>
			<br>
		</fieldset>
				
		</fieldset>	
			<br>
			<br>
			{{ Form::submit( 'OK','') }}
			
			
			
			<br>
			
		{{ Form::close() }}

@stop