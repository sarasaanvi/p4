@extends('_base')
@section('main_content')
	<h3><span>Sign-up to Report360</span></h3>
	
	{{ Form::open(array( 'url' => '/user/signup' ,'class' => 'form-inline')) }}
		
		<br>			
		<br>
			
			{{ Form::label( 'username', 'User Name  ',array('class' => 'form-control-wrap-label')) }}				
			{{ Form::text( 'usrname' ) }}
			<br>
			<br>
			{{ Form::label( 'password', 'Password ',array('class' => 'form-control-wrap-label')) }}
			{{ Form::password( 'pwd1' ) }}
			<br>
			<br>
			{{ Form::label( 'password', 'Retype Password') }}
			{{ Form::password( 'pwd2' ) }}
			<br>	
			<br>
			{{ Form::submit( 'Sign-up','',array('class' => 'form-control-wrap-button')) }}
			<br>
			
		{{ Form::close() }}

@stop