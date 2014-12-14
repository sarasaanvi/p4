@extends('_base')
@section('main_header')
	@yield('profile_image')
	<span  class ="Auth">
		@if(Auth::check())
			<a href='/user/signout'>Log out</a>
		@else 
			<a href='/user/signup'>Sign up</a> or <a href='/user/signin'>Sign in</a>
		@endif
	</span>
	
@stop
