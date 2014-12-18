@extends('_base')
@section('main_content')
	<h3><span>Sign-in to Report360</span></h3>	
		{{ Form::open(array( 'action' => 'UserController@postSignin' ,'class' => 'form-inline')) }}
			<br>
			{{ Form::label( 'user', 'User Name ',array('class' => 'form-control-wrap-label')) }}
			{{ Form::text( 'user_name' ) }} 
						
			<br>
			<br>
			{{ Form::label( 'password', 'Password ',array('class' => 'form-control-wrap-label')) }}
			{{ Form::password( 'password' ) }}
			<br>			
			<br>
			{{ Form::submit( 'Sign in' ) }}
		{{ Form::close() }}
			<br>
			<br>
			<a href ="/user/signup">First time user activate account</a>
			<br>
			<br>
			<!--<a href ="/email">Forget Password</a> -->
		
	</div>
@stop