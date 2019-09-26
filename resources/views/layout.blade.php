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
</head>

<body>
	<div class="row" style="position: sticky; top: 0; z-index: 1;">
		<div class="col-sm-12">
		<div class="page-header">
			<img src="/images/usep_logo.png"  id="icon_usepLogo" alt="University of Southeastern Philippines">
			<img src="/images/user.png" id="icon_user" alt="User">
			<img src="/images/inbox.png" id="icon_message" alt="Message">
			<img src="/images/notification.png" id="icon_notification" alt="Notification">
		</div>
		</div>
	</div>

	<div class="d-inline-flex" id="sidebarSection">
		<div id="sidebar">
			<div class="heading"> 
				<h1 id="heading_oneUsep"> ONE<span style="color:#555555">USeP</span></h1>
				<p id="text_hrs"> HUMAN RESOURCE SYSTEM </p>
			</div>
			<div class="list-group list-group-flush">
			@guest
				<ul class="list-group">
					<!-- <li class="list-group-item list-group-item-action"><h5><a style="display: inline-block; padding: 5px 58px 5px 0px; color: black; text-decoration: none;" href="#"><img src="images/dashboard.png" id="icon_dashboard">Dashboard</a></h5></li> -->
					<!-- <li class="list-group-item list-group-item-action"><h5><a style="display: inline-block; padding: 5px 58px 5px 0px; color: black; text-decoration: none;" href="/Employment"><img src="images/employment.png" id="icon_pds">Employment</a></h5></li> -->
					<li class="list-group-item list-group-item-action"><h5><a style="display: inline-block; padding: 5px 120px 5px 0px; color: black; text-decoration: none;" href="/PDSForm"><img src="images/file.png" id="icon_pds">PDS</a></h5></li>
					</div>
				</ul>

			@else
				<ul class="list-group">
					<li class="list-group-item list-group-item-action"><h5><a style="display: inline-block; padding: 5px 58px 5px 0px; color: black; text-decoration: none;" href="#"><img src="images/dashboard.png" id="icon_dashboard">Dashboard</a></h5></li>
					<li class="list-group-item list-group-item-action"><h5><a style="display: inline-block; padding: 5px 58px 5px 0px; color: black; text-decoration: none;" href="/Employment"><img src="images/employment.png" id="icon_pds">Employment</a></h5></li>
					<li class="list-group-item list-group-item-action"><h5><a style="display: inline-block; padding: 5px 120px -1px 0px; color: black; text-decoration: none;" href="/PDSForm"><img src="images/file.png" id="icon_pds">PDS Template</a></h5></li>
					<li class="list-group-item list-group-item-action" id="dropdown1"><h5><a style=" margin-right: 10px; color: black; padding: 5px 50px 5px 0px; text-decoration: none; width: 100px;" href="/PDSmenu">Section
						<?php foreach($resultCount as $sectionCount) {
							?>
							<span class="badge badge-dark"> <?php echo $sectionCount['AllSection']; ?> </span>
						<?php
							} 
						?>
						</a><img src="/images/dropdown.png" id="icon_dropdown"></h5></li></div>
				</ul>
			@endguest
				
				<div id="sectionDropdown">
					<ul class="list-group list-group-flush" style="font-size:12px; height: 355px; overflow: auto">
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

			<div id="sideContent">
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
					@yield('modal') 
				</div>
			</div>
      </div>
    </div>	
</body>
</html>

<script>
   $(document).ready(function(){
     	$('#icon_dropdown').click(function(){
     		$('#sectionDropdown').toggle();
     	}) 
   });

	$("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#sidebarSection").toggleClass("toggled");
    });
</script>