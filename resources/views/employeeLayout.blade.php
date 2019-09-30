<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/custom-css/employee.css') }}" rel="stylesheet">
    
    <script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>

    <title>@yield('title', 'USeP-HRIS')</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <img src="/images/usep_logo.png"  id="icon_usepLogo" alt="University of Southeastern Philippines">
                <img src="images/user.png" id="icon_user">
                <img src="images/inbox.png" id="icon_inbox">
                <img src="images/notification.png" id="icon_notification">
            </div>
        </div>
    </div>

    <div class="row no-gutters" style="height:100vh;">
        <div class="col">
            <div class="heading" id="heading_container"> 
				<h1 id="heading_oneUsep"> ONE<span style="color:#555555">USeP</span></h1>
				<p id="text_hrs"> HUMAN RESOURCE SYSTEM </p>
            </div>
            <div class="list-group list-group-flush">
				<ul class="list-group">
                    <li class="list-group-item list-group-item-action"><a href="#"> Dashboard </a> </li>
                    <li class="list-group-item list-group-item-action"><a href="#"> PDS </a> </li>
                    <li class="list-group-item list-group-item-action"><a href="#"> Payroll </a> </li>
                    <li class="list-group-item list-group-item-action"><a href="#"> Research & Extension </a> </li>
					<li class="list-group-item list-group-item-action"><a href="#"> IPCPR </a> </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-8"  style="border-left: solid 1px #d6d6c2; border-right: solid 1px #d6d6c2;" >
            @yield('content')
        </div>

        <div class="col">
            <div class="heading">
                <p id="text_recent"> RECENT ACTIVITIES </p>
            </div>
            
        </div>

        <div>
            @yield('submitModal')
        </div>
</body>
</html>