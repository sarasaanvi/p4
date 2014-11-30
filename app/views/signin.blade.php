@extends('_base')
@section('stylesheet')
	<link href="<?php public_path();?>/style/bootstrap.css" rel="stylesheet">
	<link  href="<?php public_path();?>/style/style.css" rel="stylesheet">
	<link  href="<?php public_path();?>/style/authentication.css" rel="stylesheet">
@stop

@section('body')
	style="background-image: url('<?php public_path();?>/img/students_dull1.jpg');"
@stop

@section('base')	
	<div class= "authentication">
		<!-- Logo image and title -->
		<img src="img/Logo_Image.png" alt=""/>
		<h2>Sign In </h2>
		<br>
		{{ Form::open(array( 'url' => '/signin')) }}
			{{ Form::label( 'user', 'User Name ', array('id' => 'field')) }}
			{{ Form::text( 'username' ,'', array('id' => 'field')) }}
			<br>
			{{ Form::label('account_type', 'Account Type ') }}
				{{ Form::radio('account_type', 'Student', true) }} Student
				{{ Form::radio('account_type', 'Teacher') }} Teacher 
			<br>
			<br>
			{{ Form::label( 'password', 'Password ', array('id' => 'field')) }}
			{{ Form::password( 'pwd' ) }}
			<br>			
			{{ Form::submit( 'Sign in' ) }}
			<br>
			<a href ="">Forget Password</a>
			<br>
			<a href ="/Sign in">Sign Up</a>
		{{ Form::close() }}
	</div>
@stop