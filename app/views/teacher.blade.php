@extends('_masterTeacher')
@section('javascript')
			<script src="<?php public_path();?>/js/jquery.min.js" type="text/javascript"></script>
			<script src="<?php public_path();?>/js/highcharts.js"></script>
			<script src="<?php public_path();?>/js/exporting.js"></script>	
@stop
@section('content')			
	<span class="search-container">
				{{ Form::open(array('action' => 'TeacherController@postIndex','class' => 'form-inline')) }}
					{{ Form::label( 'space', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ') }}
					{{ Form::label( 'student', 'Select Student  ',array('class' => 'form-control-wrap-button')) }}
					{{ Form::select('student_id', $student_list) }}		
					{{ Form::submit( 'Submit ','',array('class' => 'form-control-wrap-button')) }}
				{{ Form::close() }}
				{{ Form::open(array('action' => 'TeacherController@postIndex','class' => 'form-inline')) }}
				
					{{ Form::label( 'grade', 'Select Grade  ',array('class' => 'form-control-wrap-button')) }}
					
					{{ Form::select('grade_id', $grade_list, array( 'onchange' => 'TeacherController@postIndex')) }}		
					{{ Form::submit( 'Submit ','',array('class' => 'form-control-wrap-button')) }}
				{{ Form::close() }}
	</span>
	<br>
	<br>
	<br>
	@if (isset($msg))
		<h2>{{ $msg }}</h2>
	@endif
	<br>
	<br>
	<br>
	<span class="search-container">
			<p id="AttendanceBox" class="graphs" </p>
			<p id="MarkBox" class="graphs" </p>
	</span>
	

	<script type="text/javascript">
				$(function() {
				  $('#AttendanceBox').highcharts(
					{{json_encode($chartArray)}}
				  )
				});
		</script>	
		<script type="text/javascript">
				$(function() {
				  $('#MarkBox').highcharts(
					{{json_encode($marksArray)}}
				  )
				});
		</script>	
	
@stop


		
