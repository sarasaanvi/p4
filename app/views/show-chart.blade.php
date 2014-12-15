<!-- Load jQuery from Google's CDN if needed -->

 
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
		
        <div id="container" class="graphs"</div>
		<script type="text/javascript">
			$(function() {
			  $('#container').highcharts(
				{{json_encode($chartArray)}}
			  )
			});
		</script>		
    </body>
</html> 