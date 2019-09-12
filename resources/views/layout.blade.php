<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body style="background-color:#f5f5f5;">
<div class="page-header" style="position:relative;height:50px;background-color:#680000;">
</div>
<div class="card" style="width:230px;height:595px;position:relative;">
	<ul class="list-group" style="position:relative;top:130px;">
		<li class="list-group-item">Dashboard</li>
		<li class="list-group-item">PDS</li>
		<li class="list-group-item" id="dropdown1"><a href="/PDSmenu">Section</a></li>
	</ul>
	<div class="container-fluid" style="width:240px;height:100px;position:relative;top:130px;left:3px;display:none;" id="show1">
		<ul class="list-group list-group-flush" style="font-size:12px;">

			<?php
				foreach ($result as $value) {
			?>
				<a href="#" style="text-decoration:none;"> <li class="list-group-item"> <?php 	echo $value['Section Name']; ?> </li> </a>
			<?php
				}
			?>
		</ul>
	</div>
</div>
<div class="card" style="position:absolute;top:50px;left:230px;width:1136px;box-shadow: 1px 2px 4px rgba(0,0,0,.2);">
	<div class="card-header">
		@yield('card-header')
	</div>
	<div class="card-body">
		@yield('card-body')
	</div>
</div>
<div class="container" style="width:100px;height:100px;position:absolute;top:252px;left:230px;width:1100px;border-color:grey;">
	@yield('sectionContent')
</div>
@yield('modal') 
</body>
</html>
<script>
   $(document).ready(function(){
     	$('#dropdown1').click(function(){
     		$('#show1').toggle();
     	}) 
   });
</script>