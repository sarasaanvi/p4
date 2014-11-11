@extends('_base')
@section('stylesheet')
	<link href="<?php public_path();?>/style/bootstrap.css" rel="stylesheet">
	<link  href="<?php public_path();?>/style/style.css" rel="stylesheet">
	<link  href="<?php public_path();?>/style/signin.css" rel="stylesheet">
@stop

@section('body')
	style="background-image: url('<?php public_path();?>/img/students_dull1.jpg');"
@stop

@section('base')	
	<div class= "signin">
		<!-- Logo image and title -->
		<img src="img/Logo_Image.png" alt=""/>
		{{ Form::open(array( 'url' => '/')) }}
			{{ Form::label( 'email_address', 'Email Address ', array('id' => 'field')) }}
			{{ Form::text( 'email' ,'', array('id' => 'field')) }}
			<br>
			{{ Form::label( 'paaword', 'Password ', array('id' => 'field')) }}
			{{ Form::password( 'pwd' ) }}
			<br>			
			{{ Form::submit( 'Sign in' ) }}
			<br>
			<a href ="">Forget Password</a>
		{{ Form::close() }}
	</div>
@stop