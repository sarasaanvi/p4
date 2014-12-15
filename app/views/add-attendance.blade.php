@extends('_masterTeacher')
@section('content')
	{{ Form::open(array('action' => 'TeacherController@postAddAttendance','class' => 'form-inline')) }}			
		{{ Form::label( 'grade', 'Select Grade for Attendance  ') }}
		<!--$gradeList is passed from Controller funtion -->
		{{ Form::select('grade_id', $gradeList) }}		
	</br>
	</br>
	<table>
		<tr>
			<th>Roll No </th>
			<th>Name </th>		
			<th>Attendance  </th>
		</tr>
	@foreach ($studentList as $student)
	<tr>
		<td>{{ $student['id'] }}</td>
		<td>{{ $student['last_name'] }}, {{ $student['first_name'] }}</td>		
		<!--<input name={{ $student['id'] }} type="hidden" value={{ $student['id'] }}>-->
		<td>{{ Form::checkbox( $student['id'],'True') }}</td>
		
	</tr>
	@endforeach
	</table>
	</br>
	</br>
	{{ Form::submit( 'Mark Attendance','',array('class' => 'form-control-wrap-button')) }}
	{{ Form::close() }}
@stop

