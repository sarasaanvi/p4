@extends('_base')

@section('stylesheet')
	<link href="<?php public_path();?>/style/report360.css" rel="stylesheet">
@stop
@section('base')			
		<div class="outer">
		<div class="container">
			<div class="row">
				<div class ="logo">
					<!-- Logo image and title -->
					<img src="img/Logo_Image.png" alt=""/>
					@yield('image')
				</div>
				<!-- layout will contain side bar content and main content -->
				@yield('layout')
				
			</div>
		</div>
		</div>
@stop
	

