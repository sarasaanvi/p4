@extends('_masterAdmin')
@section('main_content')	
		<h3><span>Admin's Page</span></h3>
		<p>
			<form action="/searchStudent">
					<span>Search Student</span>
					<input type="text" onClick="this.value='';" onFocus="this.select()" onBlur="this.value=!this.value?'Enter Student Name':this.value;" value="Student Name">
					<input type="submit" id="submit" value="submit">
			</form>
			<form action="/searchClass">
					<span>Search Class</span>
					<input type="text" onClick="this.value='';" onFocus="this.select()" onBlur="this.value=!this.value?'Enter class Name':this.value;" value="Class">
					<input type="submit" id="submit" value="submit">
			</form>
		</p>
@stop