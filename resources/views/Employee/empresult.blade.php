@extends('employeeLayout')

@section('js')
<script>
	function clickEvent(param) {
		var checked = param.checked; // Get check status
		$('.' + $( param ).attr( "class" ) ).prop("checked", false); // Uncheck all
		if (checked){ $(param).prop('checked', true); }
	}
</script>
@endsection

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
<div class="container-fluid pl-4">
	<div class="row">
		<div class="col-5">
			<form><input type="submit" class="btn btn-success" form="emphome" value="Update Data" id="showsave" style="display:none"></form>
		</div>
		<div class="col-2">
			<button id="showdataview">DATAVIEW</button>
		</div>
		<div class="col-2">
			<button id="showformview">FORMVIEW</button>
		</div>
	</div>
</div>

<script>
$("#showdataview").click(function(event) {
  $("#formview").hide();
  $("#showsave").hide();
  $("#dataview").show();
});

$("#showformview").click(function(event) {
  $("#formview").show();
  $("#showsave").show();
  $("#dataview").hide();
});
</script>

            <div id="dataview">
				<hr>
                <?php
                    $section = "";
					$field = "";
                    // dd($emp_dataresult);
                    echo "<div class='container-fluid'>";
                    // foreach($result as $value){
                    foreach($emp_dataresult as $data){
                        echo "<br><div class='row' style='background-color: white;'>
                        <div class='col-4'><h5><b>" . $data['SubfieldName'] . ":</b></h5></div>  
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
                            
                            if($value['InputType Name'] != NULL && $value['InputType Name'] != "PDF" && $value['InputType Name'] != "Image" && $value['InputType Name'] != "Checkbox"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "' onclick='clickEvent(this)'>  ";
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='file' name='". $value['FieldSubfield Id'] .  "[]' value='". $value['DataString'] . "'>  ";
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "Image"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='file' name='". $value['FieldSubfield Id'] .  "[]' value='". $value['DataString'] . "'>  ";
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "Checkbox"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								if($value['DataString'] == 'on') {
									echo "<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "' checked onclick='clickEvent(this)'>  ";
								} else {
									echo "<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'onclick='clickEvent(this)'>  ";
								}
							}
							  
                        } else {
                            
                            if($value['Subfield Name'] != NULL){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								if($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF"){
									echo $value['Subfield Name'] . " " . "<input type='file' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'> ";
								} if($value['InputType Name'] != NULL && $value['InputType Name'] == "Image"){
									echo $value['Subfield Name'] . " " . "<input type='file' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'>  ";
								} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "Checkbox"){
									if($value['DataString'] == 'on') {
										echo $value['Subfield Name'] . " " ."<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "' checked onclick='clickEvent(this)'>  ";
									} else {
										echo $value['Subfield Name'] . " " ."<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'onclick='clickEvent(this)'>  ";
									}
								}else {
									echo $value['Subfield Name'] . " " . "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'>  ";
								}
                                
							}
						}                       
                    }
                ?>
			</div>
		</div>
	@endsection

</body>
</html>



