@extends('_master')

@section('image')
	<img src="img/image.jpg" alt="Student/Teacher image" class="form-image"/>
@stop
<!-- No side bar in page -->
@section('layout')
<div class="content">

	{{ Form::open(array( 'url' => '/' ,'class' => 'form-inline')) }}
		<fieldset>
			<legend>Personal Information</legend>
			<div class="form-control-wrap">			
				{{ Form::label( 'first', 'First Name ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'first_name' ) }}
			</div>
			<div class="form-control-wrap">	
				{{ Form::label( 'middle', 'Middle Name ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'middle_name' ) }}
			</div>
			<br>	
			<div class="form-control-wrap">	
				{{ Form::label( 'last', 'Last Name ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'last_name'  ) }}
			</div>
			<div class="form-control-wrap">		
				{{ Form::label( 'email', 'Email Address ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'email' ) }}
			</div>
			<br>
			
			<div class="form-control-wrap">	
				{{ Form::label( 'phone', 'Phone ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'phone' ) }}
			</div>
			<div class="form-control-wrap">	
				{{ Form::label( 'account_type', 'Account Type ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'account_type' ) }}	
			</div>
			<br>
			<div class="form-control-wrap">	
				{{ Form::label( 'address1', 'Address 1 ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'address1' ) }}
			</div>
			<div class="form-control-wrap">	
				{{ Form::label( 'address2', 'Address 2 ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'address2' ) }}
			</div>
			<br>		
			<div class="form-control-wrap">	
				{{ Form::label( 'Photo', 'Upload Photo ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::file( 'photo' ) }}
			</div>
		</fieldset>	
			<br>
			<fieldset>
				<legend>Choose Password</legend>
				<div class="form-control-wrap">	
					{{ Form::label( 'password', 'Password ',array('class' => 'form-control-wrap-label')) }}
					{{ Form::password( 'pwd1' ) }}
				</div>
				<div class="form-control-wrap">	
					{{ Form::label( 'password', 'Retype Password ',array('class' => 'form-control-wrap-label')) }}
					{{ Form::password( 'pwd2' ) }}
				</div>
			<fieldset>
			<br>
			<br>
			{{ Form::submit( 'Submit','',array('class' => 'form-control-wrap-button')) }}
			<br>
			
		{{ Form::close() }}
</div>
@stop