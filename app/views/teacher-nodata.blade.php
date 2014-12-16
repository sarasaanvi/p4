@extends('_masterTeacher')

@section('content')			
	<span class="search-container">
				{{ Form::open(array('action' => 'TeacherController@postIndex','class' => 'form-inline')) }}
					{{ Form::label( 'student', 'Select Student  ') }}
					{{ Form::select('student_id', $student_list) }}		
					{{ Form::submit( 'Submit ','',array('class' => 'form-control-wrap-button')) }}
				{{ Form::close() }}
				<span class="search-container">
				{{ Form::open(array('action' => 'TeacherController@postIndex','class' => 'form-inline')) }}
					{{ Form::label( 'grade', 'Select Grade  ') }}
					{{ Form::select('grade_id', $grade_list, array( 'onchange' => 'TeacherController@postIndex')) }}		
					{{ Form::submit( 'Submit ','',array('class' => 'form-control-wrap-button')) }}
				{{ Form::close() }}
	</span>
	<br>
	<br>
	@if (isset($msg))
		<h2>{{ $msg }}</h2>
	@endif	
@stop