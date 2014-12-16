@extends('_masterTeacher')
@section('content')

	{{ Form::open(array('action' => 'TeacherController@postAddMarks','class' => 'form-inline')) }}
		<br>
				
				{{ Form::label( 'grade', 'Grade : ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text('grade_id', $grade_id,array('class' => 'disabled')) }}	
			
				{{ Form::label( 'subject', 'Subject : ', array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'subject', $subject ,array('class' => 'disabled')) }}	
				<br>
				<br>
				
				{{ Form::label( 'exam', 'Exam : ',array('class' => 'form-control-wrap-label')) }}
				{{ Form::text( 'exam', $exam ,array('class' => 'disabled')) }}
				
				{{ Form::label( 'exam', 'Exam Date ') }}
				{{ Form::text( 'exam_date' ,$exam_date ,array('class' => 'disabled')) }}
				
							
			<br>
			<br>
				<table>
			<tr>
				<th>Roll No </th>
				<th>Name </th>		
				<th>Marks  </th>
			</tr>
		@foreach ($student_list as $key => $value)
		<tr>
			<td>{{ $key }}</td>
			<td>{{ $value . " &nbsp;&nbsp;&nbsp;&nbsp;"}}</td>		
			<td>{{ Form::text( $key, 'Enter Marks', array('onClick'=> "this.value='';" ,'onFocus'=> "this.select()", 'onBlur' => "this.value=!this.value?'Enter Marks':this.value;" )) }}</td>
					
			
		</tr>
		@endforeach
		</table>
		</br>
		</br>
	{{ Form::submit( 'Add Marks','',array('class' => 'form-control-wrap-button')) }}
	{{ Form::close() }}
@stop

