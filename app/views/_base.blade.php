<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!--default stylesheet -->
	<link rel="stylesheet" href="<?php public_path();?>/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?php public_path();?>/css/report360.css" type="text/css">
	@yield('stylesheet')
	<title>		
			@yield('title',"Report 360")
	</title>
</head>
<body>
	 @if(Session::get('flash_message'))
			<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif
	<div class="border">
		<div id="bg">
			background
		</div>
		<div class="page">
			<div class="sidebar">
				<img  src="<?php public_path();?>/images/Logo_Image.png" alt="logo">
					@yield('sidebar_content')
				<div class="connect">
					<a href="https://www.facebook.com/hemadri.saxena" id="facebook">facebook</a> <a href="" id="twitter">twitter</a> <a href="https://plus.google.com/u/1/" id="googleplus">youtube</a>
				</div>
				<p>
					Copyright 2023
				</p>
				<p>
					Hemadri Saxena
					
				</p>
			</div>
			<div class="body">				
				<div>		
					<span class ="mainheader">
						<h1 class="mainheaderText">Welcome to Report360</h1>
						<br>
						<br>
						@yield('main_header')
					</span>
					
					<div>
						@yield('main_content')
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>