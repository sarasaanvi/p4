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
						
			{{ Form::label( 'first', 'First Name ') }}
			{{ Form::text( 'first_name' ) }}
			
			{{ Form::label( 'middle', 'Middle Name ') }}
			{{ Form::text( 'middle_name' ) }}
			<br>	
			{{ Form::label( 'last', 'Last Name ') }}
			{{ Form::text( 'last_name' ) }}
				
			{{ Form::label( 'email', 'Email Address ') }}
			{{ Form::text( 'email' ) }}
			<br>
			
			
			{{ Form::label( 'phone', 'Phone ') }}
			{{ Form::text( 'phone' ) }}
			
			{{ Form::label( 'account_type', 'Account Type ') }}
			{{ Form::text( 'account_type' ) }}	
			
			
			<br>
			{{ Form::label( 'address1', 'Address 1 ') }}
			{{ Form::text( 'address1' ) }}
			
			{{ Form::label( 'address2', 'Address 2 ') }}
			{{ Form::text( 'address2' ) }}
			<br>		
			{{ Form::label( 'Photo', 'Upload Photo ') }}
			{{ Form::text( 'last_name' ) }}
		</fieldset>	
			<br>
			<fieldset>
				<legend>Choose Password</legend>
				{{ Form::label( 'password', 'Password ', array('id' => 'field')) }}
				{{ Form::password( 'pwd1' ) }}
				{{ Form::label( 'password', 'Retype Password ', array('id' => 'field')) }}
				{{ Form::password( 'pwd2' ) }}
			<fieldset>
			<br>
			<br>
			{{ Form::submit( 'Sign Up' ) }}
			<br>
			
		{{ Form::close() }}
</div>
@stop