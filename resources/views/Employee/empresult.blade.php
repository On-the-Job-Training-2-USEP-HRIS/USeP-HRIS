@extends('employeeLayout')

@section('title', 'Employee')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/custom-css/employee.css') }}" rel="stylesheet">
    
    <script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>

</head>

<body style="overflow-y: auto">

@section('card-body')
		<div class="container">
		<nav aria-label="breadcrumb">
        <div class="row">
            <div class="col-9">
			<ol class="breadcrumb">
				<li class="breadcrumb-item" aria-current="EMPLOYEE DATA RESULT"><b>EMPLOYEE DATA RESULT</b></li>
			</ol>
            </div>
            <div class="col">
				<form id="username_search" action="/emphome/searchUser" method="POST" class="form-inline pt-1">
                @csrf
				<input type="search" class="form-control" name="username_input" placeholder="Enter Username">
				<div class="form-input-group-append">
					<span class="input-group-text">
                    <a href="#" onclick="document.getElementById('username_search').submit();"><i aria-hidden="true"><img src="/images/search.png" height="20" width="20"></i></a>
					</span>
				</div>
			</form>
            </div>
        </div>
		</nav>
		</div>
@endsection

@section('content')
<div class="container-fluid" id="sectionCon" style="height: auto; margin-bottom: 30px;">
			@csrf
            
                <?php
                    $section = "";
					$field = "";
                    // dd($emp_dataresult);
                    echo "<div class='container-fluid' style='width: 500px; float: left; padding-left: 100px; position: absolute;'>";
                    // foreach($result as $value){
                    foreach($emp_dataresult as $data){
                        echo "<br><div class='row' style='background-color: white;'>
                        <div class='col'><h5><b>" . $data['SubfieldName'] . ":</b></h5></div>  
                        <div class='col'><p style='display:inline;'>" . $data['DataString'] . "</p></div>
                        </div>";
                    }   
                    echo "</div>";                   
                
                ?>
		</div>
	@endsection

</body>
</html>

