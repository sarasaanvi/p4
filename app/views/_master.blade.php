@extends('_base')

@section('stylesheet')
	<link href="<?php public_path();?>/style/bootstrap.css" rel="stylesheet">
	<link  href="<?php public_path();?>/style/style.css" rel="stylesheet">
@stop
@section('base')			
		<div class="outer">
		<div class="container">
			<div class="row">
				<!-- Logo image and title -->
				<img src="img/Logo_Image.png" alt=""/>
				@yield('layout')
			</div>
		</div>
		</div>
@stop
	

