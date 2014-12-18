@extends('_base')
@section('main_content')
	<h3><span>Activate Report360 Account</span></h3>
	
	
	{{ Form::open(array('action' => 'UserController@postSignup','class' => 'form-inline')) }}
		@foreach($errors->all() as $message) 
			{{ Form::label( 'label', $message,array('class' => 'msgerror')) }}
			<br>
		@endforeach
		
		<br>			
		<br>			
			{{ Form::label( 'username', 'User Name  ',array('class' => 'form-control-wrap-label')) }}			
			{{ Form::text( 'user_name' ) }}
			{{ Form::label( 'user_msg1', 'User Name is your Enrolment/Employee number',array('class' => 'msg')) }}
			<br>
			<br>
			{{ Form::label( 'password', 'Password ',array('class' => 'form-control-wrap-label')) }}
			{{ Form::password( 'password_1' ) }}
			{{ Form::label( 'user_msg2', 'Max of 6 characters',array('class' => 'msg')) }}
			<br>
			<br>
			{{ Form::label( 'password', 'Retype Password') }}
			{{ Form::password( 'password_2' ) }}
			{{ Form::label( 'user_msg3', 'Confirm your password',array('class' => 'msg')) }}
			<br>	
			<br>
			{{ Form::submit( 'Activate','',array('class' => 'form-control-wrap-button')) }}
			<br>
			
		{{ Form::close() }}

@stop