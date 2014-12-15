@extends('_masterTeacher')
@section('javascript')
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>	
@stop
@section('content')			
	@if (isset($msg))
		<h2>{{ $msg }}</h2>
	@endif	
	<div id="container" class="graphs" </div>
	<script type="text/javascript">
			$(function() {
			  $('#container').highcharts(
				{{json_encode($chartArray)}}
			  )
			});
	</script>	
@stop


		
