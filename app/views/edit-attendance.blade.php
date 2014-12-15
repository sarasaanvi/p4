@extends('_masterTeacher')
@section('content')
	{{ Form::open(array('action' => 'TeacherController@postEditAttendance','class' => 'form-inline')) }}			
		{{ Form::label( 'grade', 'Edit Attendance for Grade : '. $grade_id ) }}
		<!--$gradeList is passed from Controller funtion -->
			
	</br>
	</br>
	<table>
		<tr>
			<th>Roll No </th>
			<th>Name </th>		
			<th>Attendance  </th>
		</tr>
	@foreach ($Attendances as $Attendance)
		<tr>
			<td>{{ $Attendance['student_id'] }}</td>			 
			<td>{{ $Attendance->student->last_name . ", " . $Attendance->student->first_name }}</td>		
			@if ($Attendance['attended'])
				<td>{{ Form::checkbox( $Attendance['student_id'], 'True' ,'checked' ) }}</td>
			@else
				<td>{{ Form::checkbox( $Attendance['student_id'], 'True' ) }}</td>
			@endif
		</tr>	
	@endforeach
	</table>
	</br>
	</br>
	{{ Form::submit( 'Edit Attendance','',array('class' => 'form-control-wrap-button')) }}
	{{ Form::close() }}
@stop

