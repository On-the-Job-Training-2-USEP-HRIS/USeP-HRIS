<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'USEP - HRIS')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('libraries/custom-css/layout.css') }}" rel="stylesheet">
	
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>

<body>

	<div class="page-header">
		<img src="/images/usep_logo.png"  id="icon_usepLogo" alt="University of Southeastern Philippines">
		<img src="/images/user.png" id="icon_user" alt="User">
		<img src="/images/inbox.png" id="icon_message" alt="Message">
		<img src="/images/notification.png" id="icon_notification" alt="Notification">
	</div>

	<div class="card" id="sideMenu">
		<h1 id="heading_oneUsep"> ONEUSeP </h1>
		<p id="text_hrs"> HUMAN RESOURCE SYSTEM </p>
		<ul class="list-group" id="list_menuSection">
			<li class="list-group-item list-group-item-action"><h5><a style="display: block; color: black; text-decoration: none;" href="#">Dashboard</a></h5></li>
			<li class="list-group-item list-group-item-action"><h5><a style="display: block; color: black; text-decoration: none;" href="/PDSForm">PDS</a></h5></li>
			<div><li class="list-group-item list-group-item-action" id="dropdown1"><h5><a style="display: inline-block; margin-right: 10px; color: black; text-decoration: none; width: 100px;" href="/PDSmenu">Section
			<?php foreach($resultCount as $sectionCount) {
				?>
				<span class="badge badge-dark"> <?php echo $sectionCount['AllSection']; ?> </span>
			<?php
				} 
			?>
			</a></h5></li></div>
			<!-- <img src="/images/dropdown.png" id="icon_dropdown" style="display: inline-block;"> //Dropdown image -->
		</ul>
		
		<div class="container-fluid" style="" id="sectionDropdown">
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

	<div class="card" id="mainContent">
		<div class="sidemenu-btn" onclick="toggleSideMenu()">
			<img src="images/menu.png" height="20px" width="20px">
		</div>
	
		<div class="card-header">
			@yield('card-header')
		</div>
		<div class="card-body">
			@yield('card-body')
		</div>
	</div>

	<div class="card" id="sectionContainer">
		@yield('sectionContent')
	</div>

	@yield('modal') 
</body>
</html>

<script>
   $(document).ready(function(){
     	$('#dropdown1').click(function(){
     		$('#sectionDropdown').toggle();
     	}) 
   });

   function toggleSideMenu(){
		document.getElementById("sideMenu").classList.toggle('active');
		document.getElementById("mainContent").classList.toggle('active');
		document.getElementById("sectionContainer").classList.toggle('active');
	}	
</script>