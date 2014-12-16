@extends('_masterTeacher')
@section('stylesheet')
	<link rel="stylesheet" href="<?php public_path();?>/css/htmlDatePicker.css" rel="stylesheet" />
@stop
@section('javascript')
	<script language="JavaScript" src="<?php public_path();?>/js/htmlDatePicker.js" type="text/javascript"></script>
@stop
@section('content')

	{{ Form::open(array('action' => 'TeacherController@postParamMarks','class' => 'form-inline')) }}
		<br>
		
		{{ Form::label( 'grade', 'Select Grade  ',array('class' => 'form-control-wrap-label')) }}
		{{ Form::select('grade_id', $grade_list) }}	
		<br>
		<br>
		{{ Form::label( 'subject', 'Select Subjects ',array('class' => 'form-control-wrap-label')) }}
		{{ Form::select( 'subject_id', $subject_list ) }}	
		<br>
		<br>
		{{ Form::label( 'subject', 'Select Exam ',array('class' => 'form-control-wrap-label')) }}
		{{ Form::select( 'exam_id', $exam_list ) }}
		<br>		
		<br>
		{{ Form::label( 'exam', 'Select Exam date&nbsp;&nbsp;&nbsp; ') }}
		{{ Form::text( 'exam_date' ,'Select Date', array( 'id' =>"SelectedDate" ,'onClick' =>"GetDate(this);")) }}
		<br>		
		<br>
		{{ Form::submit( 'OK ','',array('class' => 'form-control-wrap-button')) }}
		<br>		
		<br>
	{{ Form::close() }}
@stop

