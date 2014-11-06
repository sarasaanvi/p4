<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<!-- Stylesheets -->
		<link href=<?php public_path();?>"/style/bootstrap.css" rel="stylesheet">
		<link  href=<?php public_path();?>"/style/style.css" rel="stylesheet">
		<title>		
			@yield('title',"Report 360")
		</title>
	
	</head>
	<body>
			
		<div class="outer">
		<div class="container">
			<div class="row">
				<!-- Logo image and title -->
				<img src="img/Logo_Image.png" alt=""/>
				@yield('layout')
			</div>
		</div>
		</div>
	
	</body>
</html>
