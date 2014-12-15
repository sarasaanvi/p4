		<fieldset>
				<legend>Choose Password</legend>
					{{ Form::label( 'password', 'Password ',array('class' => 'form-control-wrap-label')) }}
					{{ Form::password( 'pwd1' ) }}
					
					{{ Form::label( 'password', 'Retype Password ',array('class' => 'form-control-wrap-label')) }}
					{{ Form::password( 'pwd2' ) }}
				
		</fieldset>