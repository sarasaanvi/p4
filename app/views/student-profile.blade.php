@extends('_masterTeacher')
@section('content')			
	{{ Form::open(array('url' => '/teacher', 'method' => 'GET' ,'class' => 'form-inline')) }}			
		<br>
		<fieldset>			
			<legend>Personal Information</legend>	
				{{ Form::label( 'first', 'First Name :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label( 'first_name', $student->first_name, array('class' => 'form-control-wrap-label')) }}
			
				{{ Form::label( 'middle', 'Middle Name :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'middle_name',' ',array('class' => 'form-control-wrap-label' )) }}
				
			
			<br>
			<br>
			
				{{ Form::label( 'last', 'Last Name :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'last_name' , $student->last_name ,array('class' => 'form-control-wrap-label' )) }}
				{{ Form::label( 'dob', 'Date of Birth :', array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'dob' , $student->dob ,array('class' => 'form-control-wrap-label' )) }}
			
			<br>
			<br>
				{{ Form::label( 'emp_no', 'Employee No :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'emp_no', $student->id,array('class' => 'form-control-wrap-label' )) }}
				{{ Form::label( 'grade', 'Grade :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'grade'  , $student->grade_id,array('class' => 'form-control-wrap-label' )) }}
			<br>
			<br>	
			
				{{ Form::label( 'section', 'Section :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'section' ,'A' ,array('class' => 'form-control-wrap-label' )) }}
				<br>
				<br>
			
		</fieldset>
		<br>
		<fieldset>
			<legend>Contact Information</legend>	
				{{ Form::label( 'email', 'Email:',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'email' , $student->email ,array('class' => 'form-control-wrap-label' )) }}
			<br>
			<br>	
				{{ Form::label( 'phone', 'Phone :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'phone', $student->phone,array('class' => 'form-control-wrap-label' )) }}
			
			<br>
			<br>
			
				{{ Form::label( 'address', 'Address  :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'address' , $student->address ) }}
			<br>
			<br>	
				{{ Form::label( 'city', 'City :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'city' , $student->city) }}
				<br>
				<br>
				{{ Form::label( 'state', 'State :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'state' , $student->state ,array('class' => 'form-control-wrap-label' )) }}
				
				{{ Form::label( 'zip', 'Zip Code :',array('class' => 'form-control-wrap-label')) }}
				{{ Form::label(  'zip' , $student->zip,array('class' => 'form-control-wrap-label' )) }}
			<br>
			<br>
		</fieldset>
		<fieldset>
			<legend>Academic Information</legend>	
				<table>
				<tr>
					<th>Exams </th>
					<th>Subject 1</th>		
					<th>Subject 2</th>
					<th>Subject 3</th>		
					<th>Subject 4</th>
					<th>Subject 5</th>						
				</tr>
			<tr>
			@foreach($exam_list as $exam_key => $exam_value)
				<tr>
					<td>{{ $exam_value }}</td>
					@foreach($student->marks as $mark) 						
						@if ($mark->exam_id == $exam_key )							
								@if ($mark->subject == "Subject1" )
									<td>{{ $mark->mark_obtained }}</td>
								@endif
								@if ($mark->subject == "Subject2" )
									<td>{{ $mark->mark_obtained }}</td>
								@endif
								@if ($mark->subject == "Subject3" )
									<td>{{ $mark->mark_obtained }}</td>
								@endif
								@if ($mark->subject == "Subject4" )
									<td>{{ $mark->mark_obtained }}</td>
								@endif
								@if ($mark->subject == "Subject5" )
									<td>{{ $mark->mark_obtained }}</td>
								@endif	
						@endif
					@endforeach
				<tr>
			@endforeach
			</tr>
			
			</table>
			</br>
			</br>
				
		</fieldset>	
			<br>
			<br>
			{{ Form::submit( 'OK','') }}
			
			
			
			<br>
			
		{{ Form::close() }}

@stop