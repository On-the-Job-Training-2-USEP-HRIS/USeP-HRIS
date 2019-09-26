<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('libraries/custom-css/employee.css') }}" rel="stylesheet">

    <title>@yield('title', 'USeP-HRIS')</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <img src="/images/usep_logo.png"  id="icon_usepLogo" alt="University of Southeastern Philippines">
                <h1 id="heading_oneusep">OneUSeP-HRIS</h1>
                <img src="/images/dropdown.png" id="dropdown_header">
                <h5 id="heading_useraccount">User Account</h5>
                <img src="images/user.png" id="icon_user">
                <img src="images/inbox.png" id="icon_inbox">
                <img src="images/notification.png" id="icon_notification">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="list-group list-group-flush">
                <ul class="list-group">
                    <li class="list-group-item" style="padding:10px;"> Dashboard </li>
                    <li class="list-group-item" style="padding:10px;"> Personal Information </li>
                    <li class="list-group-item" style="padding:10px;"> Payroll </li>
                    <li class="list-group-item" style="padding:10px;"> Research and Extension </li>
                </ul>
            </div>  
        </div>

        <div class="col-sm-8" style="background-color:white;">
            
        </div>
    </div>
    @yield('sectionContent')
</body>
</html>