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
		<h1 id="heading_oneUsep"> ONE<span style="color:#555555">USeP</span></h1>
		<p id="text_hrs"> HUMAN RESOURCE SYSTEM </p>
		<ul class="list-group" id="list_menuSection">
			<li class="list-group-item list-group-item-action"><img src="images/dashboard.png" id="icon_dashboard"><a href="#">Dashboard</a></li>
			<li class="list-group-item list-group-item-action"><img src="images/file.png" id="icon_pds"><a href="/PDSForm">PDS</a></li>
			<li class="list-group-item list-group-item-action" id="dropdown1"><a href="/PDSmenu">Section
			<?php foreach($resultCount as $sectionCount) {
				?>
				<span class="badge badge-dark"> <?php echo $sectionCount['AllSection']; ?> </span>
			<?php
				} 
			?>
			<img src="/images/dropdown.png" id="icon_dropdown"></a></li>
		</ul>
		
		<div class="container-fluid" id="sectionDropdown">
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