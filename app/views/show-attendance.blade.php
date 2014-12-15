@extends('_masterTeacher')
@section('content')		
		<span class="edit-container">
			@if (isset($msg))
				<h2>{{ $msg }}</h2>
			@endif
			{{ Form::open(array('url' => '/teacher', 'method' => 'GET' ,'class' => 'form-inline')) }}	
				{{ Form::submit( ' OK ') }}
				
			{{ Form::close() }}
			{{ Form::open(array('url' => '/teacher/edit-attendance', 'method' => 'GET' ,'class' => 'form-inline')) }}	
				{{ Form::label( 'space1', '&nbsp;&nbsp;&nbsp;&nbsp;') }}
				{{ Form::submit( ' EDIT ') }}
				
			{{ Form::close() }}
			{{ Form::open(array('url' => '/teacher/delete-attendance', 'method' => 'POST' ,'class' => 'form-inline')) }}	
				{{ Form::label( 'space2', '&nbsp;&nbsp;&nbsp;&nbsp;') }}
				{{ Form::submit( ' DELETE ') }}				
			{{ Form::close() 
		</span>
@stop

		
