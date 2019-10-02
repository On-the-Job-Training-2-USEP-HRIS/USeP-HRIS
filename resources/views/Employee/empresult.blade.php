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

<button id="showdataview">DATAVIEW</button>
<button  id="showformview">FORMVIEW</button>

<script>
$("#showdataview").click(function(event) {
  $("#formview").hide();
  $("#dataview").show();
});

$("#showformview").click(function(event) {
  $("#formview").show();
  $("#dataview").hide();
});
</script>

            <div id="dataview">
				<hr>
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

			<div id="formview" style="display: none;">
				<?php

                    $section = "";
					$field = "";
					// dd($);
                    // print_r($emp_dataresult);
                    
                    echo"<div>";

                    foreach($emp_dashdataresult as $value){

						
                        if($section != $value['Section Name']){
                            $section = $value['Section Name'];
                            echo "<hr><div class='card' style='background-color: gray; color: white; padding-left: 10px;'><h1>" . $section . "</h1></div>";
						}

						
						
                        
                        if($field != $value['Field Name']){
							$field = $value['Field Name'];

							if($field != NULL){ 
								if($field != $value['Subfield Name']){
									echo "<br><br><h5>" . $field . ":</h5>" . $value['Subfield Name'] . " ";
								} else if ($field == $value['Subfield Name']){
									echo "<br><br>" . $field . ": ";
								}
							}
                            
                            if($value['InputType Name'] != NULL && $value['InputType Name'] != "PDF"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								if($value['DataString'] == 'on') {
									echo "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "' checked>  ";
								} else {
									echo "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'>  ";
								}
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='file' name='". $value['FieldSubfield Id'] .  "[]' value='". $value['DataString'] . "'>  ";
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "Image"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='file' name='". $value['FieldSubfield Id'] .  "[]' value='". $value['DataString'] . "'>  ";
							}
							  
                        } else {
                            
                            if($value['Subfield Name'] != NULL){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								if($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF"){
									echo $value['Subfield Name'] . " " . "<input type='file' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'> ";
								} if($value['InputType Name'] != NULL && $value['InputType Name'] == "Image"){
									echo $value['Subfield Name'] . " " . "<input type='file' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'>  ";
								} else {
									if($value['DataString'] == 'on') {
                                        echo $value['Subfield Name'] . " " . "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "' checked>  ";
                                    } else {
                                        echo $value['Subfield Name'] . " " . "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'>  ";
                                    }
								}
                                
							}
						}                       
                    }
                    echo"</div>";
                ?>
			</div>
		</div>
	@endsection

</body>
</html>



