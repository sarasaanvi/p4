@extends('_master')

@section('content')
<div class="span4">
	<div class="sidebar">
		<div class="inner">
			@yield('sidebar_content')
		</div>
	</div>
</div>
<div class="span8">
	<div class="main-padd">				
		<p>@yield('main_content')</p>
	</div>
</div>