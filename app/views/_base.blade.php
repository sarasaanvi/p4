<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<!-- Stylesheets -->
		<link href="<?php public_path();?>/style/bootstrap.css" rel="stylesheet">
		<link  href="<?php public_path();?>/style/style.css" rel="stylesheet">
		@yield('stylesheet')		
		<title>		
			@yield('title',"Report 360")
		</title>
	
	</head>
	<body @yield('body')>
		<!-- Logo image, side bar and main content-->
		@yield('base')
	</body>
</html>
