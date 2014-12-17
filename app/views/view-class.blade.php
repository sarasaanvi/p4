@extends('_masterstudent')
@section('javascript')
			<script src="<?php public_path();?>/js/jquery.min.js" type="text/javascript"></script>
			<script src="<?php public_path();?>/js/highcharts.js"></script>
			<script src="<?php public_path();?>/js/exporting.js"></script>	
@stop
@section('content')			
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

