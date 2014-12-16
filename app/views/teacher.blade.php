@extends('_masterTeacher')

@section('content')			
	@if (isset($msg))
		<h2>{{ $msg }}</h2>
	@endif	
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
				
	</span>
	<br>
	@if (isset($chartArray))
		@section('javascript')
			<script src="<?php public_path();?>/js/jquery.min.js" type="text/javascript"></script>
			<script src="<?php public_path();?>/js/highcharts.js"></script>
			<script src="<?php public_path();?>/js/exporting.js"></script>	
		@stop
		<p id="container" class="graphs" </p>
		<script type="text/javascript">
				$(function() {
				  $('#container').highcharts(
					{{json_encode($chartArray)}}
				  )
				});
		</script>	
	@endif
@stop


		
