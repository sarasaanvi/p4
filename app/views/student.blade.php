@extends('_masterstudent')
@section('profile_image')
	<img  src="<?php app_path();?>{{ $photo_path }}" alt="" class= "profile-image">
@stop
@section('main_content')	
		<h3><span>Hello, {{ $first_name }}</span></h3>
		<p>
			
		</p>
@stop