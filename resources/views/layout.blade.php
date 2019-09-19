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


	<div class="row">
		<div class="col-sm-12">
		<div class="page-header">
			<img src="/images/usep_logo.png"  id="icon_usepLogo" alt="University of Southeastern Philippines">
			<img src="/images/user.png" id="icon_user" alt="User">
			<img src="/images/inbox.png" id="icon_message" alt="Message">
			<img src="/images/notification.png" id="icon_notification" alt="Notification">
		</div>
		</div>
	</div>

	<div class="d-flex" id="sidebarSection">
		<div id="sidebar">
			<div class="heading"> 
				<h1 id="heading_oneUsep"> ONEUSeP </h1>
				<p id="text_hrs"> HUMAN RESOURCE SYSTEM </p>
			</div>
			<div class="list-group list-group-flush">
			<ul class="list-group" id="list_menuSection">
				<li class="list-group-item list-group-item-action">Dashboard</li>
				<li class="list-group-item list-group-item-action">PDS</li>
				<li class="list-group-item list-group-item-action" id="dropdown1">Section
					<?php foreach($resultCount as $sectionCount) 
						{
					?>
						<span class="badge badge-dark"> 
						<?php echo $sectionCount['AllSection']; ?> </span>
					<?php
						} 
					?>
				<img src="/images/dropdown.png" id="icon_dropdown"></a></li>
			</ul>

			<div id="sectionDropdown">
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
    </div>
	
	  
	<div id="content">
		<div class="card">
			<div class="card-header">
				<div id="menu-toggle">
					<img src="images/menu.png" height="30px" width="30px">
				</div>
					@yield('card-header')
			</div>

			<div class="card-body">
				@yield('card-body')
			</div>
			
			@yield('sectionContent')
			<!-- <div class="card">
				
			</div> -->

			@yield('modal') 
		</div>
	</div>
	
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

	$("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#sidebarSection").toggleClass("toggled");
    });
</script>