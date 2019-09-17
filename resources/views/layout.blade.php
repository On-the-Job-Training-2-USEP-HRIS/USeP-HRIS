<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'USEP - HRIS')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color:#f5f5f5;">
<div class="page-header" style="position:relative;height:50px;background-color:#680000;">
	<img src="/images/usep_logo.png" alt="University of Southeastern Philippines" style="img:100%; width:50px; height:50px; float:left;">
	<!-- <h1 style="display:block; margin:auto; color:white; float:left">University of Southeastern Philippines</h1> -->
	<img src="/images/user.png" alt="User" style="img:100%; width:30px; height:30px; float:right; margin-right:20px; margin-top:10px ">
	<img src="/images/inbox.png" alt="Message" style="img:100%; width:30px; height:30px; float:right; margin-right:20px; margin-top:10px">
	<img src="/images/notification.png" alt="Notification" style="img:100%; width:30px; height:30px; float:right; margin-right:20px; margin-top:10px">
</div>
<div class="card" style="width:230px;height:595px;position:relative;">
	<h1 style="text-align: center; margin-top:30px">ONEUSeP</h1>
	<p style="font-family: verdana; font-size: 12px; text-align:center">HUMAN RESOURCE SYSTEM</p>
	<ul class="list-group" style="position:relative;top:30px;">
		<li class="list-group-item list-group-item-action">Dashboard</li>
		<li class="list-group-item list-group-item-action">PDS</li>
		<li class="list-group-item list-group-item-action" id="dropdown1">Section
		<?php foreach($resultCount as $sectionCount) {
			?>
			<span class="badge badge-dark"> <?php echo $sectionCount['AllSection']; ?> </span>
		<?php
			} 
		?>
		<img src="/images/dropdown.png" style="float:right;width:10px;height:10px;margin-top:7px;"></li>
	</ul>
	<div class="container-fluid" style="width:240px;height:100px;position:relative;top:30px;left:3px;display:none;" id="show1">
		<ul class="list-group list-group-flush" style="font-size:12px;">

			<?php
				foreach ($result2 as $value) {
			?>
				<a href="#" style="text-decoration:none;"> 
					<li class="list-group-item list-group-item-action"> 
						<?php 	echo $value['Section Name']; ?> 
					</li> 
				</a>
			<?php
				}
			?>
		</ul>
	</div>
</div>
<div class="card" style="position:absolute;top:50px;left:230px;width:1130px;box-shadow: 1px 2px 4px rgba(0,0,0,.2);">
	<div class="card-header">
		@yield('card-header')
	</div>
	<div class="card-body">
		@yield('card-body')
	</div>
</div>
<div class="container" style="width:100px;height:100px;position:absolute;top:270px;left:222px;width:1100px;border-color:grey;">
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