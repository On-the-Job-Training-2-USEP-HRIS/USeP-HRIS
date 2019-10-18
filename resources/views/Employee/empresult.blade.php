@extends('employeeLayout')

@section('js')
<script>
	function clickEvent(param) {
		var checked = param.checked; // Get check status
		$('.' + $( param ).attr( "class" ) ).prop("checked", false); // Uncheck all
		if (checked){ $(param).prop('checked', true); }
	}
	function divClick(id) {
		var divs = document.getElementsByClassName('section');
		var tabs = document.getElementsByClassName('tabs');
		for(var i = 0; i < divs.length; i++) {
			divs[i].style.display = 'none';
			tabs[i].style.color = 'black';
			tabs[i].style.backgroundColor = 'white';

		}
		document.getElementById(id).style.display = 'block';
		document.getElementById(id+'tab').style.color = 'white';
		document.getElementById(id+'tab').style.backgroundColor = '#686868';
	}
	
	function inputRequire() {
		var requiredIDs = [
			1,2,3,5,6,14,15,16,46,47 // Specific IDs to add required tag on input attribute
		]; 
		for(var i = 0; i < requiredIDs.length; i++) {
			document.getElementById(requiredIDs[i]).required = true;
		}
	}

	function enableForm(){
		document.getElementById("pdsform").disabled = false;
		document.getElementById("updatebtn").disabled = false;
	}

	window.onload = function() {
		inputRequire(); // Require specific input with IDs on line 25
		divClick('Personal Information'); // Display Personal Information
	};
</script>
@endsection

@section('title', 'Employee Result')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/custom-css/employee.css') }}" rel="stylesheet">
    
    <script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
	<style> 
	.tabs:hover {
		background-color: #686868;
		color: white;
	}

	.tabs {
		border: 1px solid rgba(0, 0, 0, 0); 
		width: 105px; 
		text-align: center; 
		height: 25px; 
		overflow: hidden; 
		padding: 0px 10px; 
		margin: 5px 2px; 
		display: inline-block;
		border-radius: 5px;
		margin-top: -30px;
	}	

	#tab-group {
		margin: 0 auto;
		text-align: center;
	}	
	</style>
</head>

<body style="overflow-y: auto">

@section('card-body')
	<div class="container">
		<nav aria-label="breadcrumb">
			<div class="row">
				<div class="col-7">
				<ol class="breadcrumb">
					<li class="breadcrumb-item" aria-current="EMPLOYEE RESULT"><b>EMPLOYEE RESULT</b></li>
				</ol>
				</div>
				<div class="col-2 pt-1">
					<div class="row">
						<button class="btn btn-warning" onclick="enableForm()">Edit</button>
						<form><input id="updatebtn" type="submit" class="btn btn-success" form="emphome" value="Update Data" disabled></form>
					</div>
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
				<!-- <div class="container"  style="width: 750px;">
					<div class="row p-2">
					<div class="col-10"><b><em style="display: inline">By pressing the "Save Data" button, I hereby declare that the details furnished below are true and correct 
						to the best of my knowledge and belief and I undertake to inform the department in charge of any changes therein, immediately.</em></b></div>
						<div class="col pt-2"><form><input type="submit" class="btn btn-danger" form="emphome" style="display: inline-block;" value="Save Data"></form></div>	
					<div/>
				</div> -->
		</nav>
	</div>
@endsection

@section('content')
	<div class="container-fluid" id="sectionCon" style="height: auto; margin-bottom: 30px;">
		<form id="emphome" name="emphome" action="/empresult/update" method="POST" style="height: auto;">
			<fieldset id="pdsform" disabled>
				@csrf
					<?php
						$section = "";
						$field = "";

						echo "<input name='userID' value='" . $searchUserIDresult . "' type='hidden'>";

						echo "<br><br><div id='tab-group'>";
						foreach($emp_dashdataresult as $value) {
							if($section == '') {
								$section = $value['Section Name'];
								echo '<a class="tabs" id="' . $section . 'tab" href="#" onclick="divClick(' ."'". $section . "'" . ')"><div id="tabDiv" 
								>' . $value['Section Name'] . '</div></a>';
							} else if($section != $value['Section Name']) {
								$section = $value['Section Name'];
								echo '<a class="tabs" id="' . $section . 'tab" href="#" onclick="divClick(' ."'". $section . "'" . ')"><div id="tabDiv"
								>' . $value['Section Name'] . '</div></a>';							
							}
						}
						echo "</div>";

						$section = "";
						$field = "";
						
						foreach($emp_dashdataresult as $value){						
							if($section == '') {
								$section = $value['Section Name'];
								echo "<div class='section' id='" . $section . "' style=' display: none'>";
								echo "<hr><div class='card' style='background-color: gray; color: white; padding-left: 10px;'><h1>" . $section . "</h1></div>";
							} else if($section != $value['Section Name']) {
								echo '</div>';
								$section = $value['Section Name'];
								echo '<div class="section" id="' . $section . '" style=" display: none">';
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
								
								if($value['InputType Name'] != NULL){
									echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
									echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
									if ($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF" or $value['InputType Name'] == "Image"){
										echo "<input id='". $value['FieldSubfield Id'] .  "' type='file' name='". $value['FieldSubfield Id'] .  "[]' >  ";
									} else if($value['InputType Name'] != NULL && $value['InputType Name'] == "Checkbox"){
										if($value['DataString'] == 'on') {
											echo "<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' checked onclick='clickEvent(this)'>  ";
										} else {
											echo "<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' onclick='clickEvent(this)'>  ";
										}
									} else {
										echo "<input id='". $value['FieldSubfield Id'] .  "' type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] .  "[]' value='". $value['DataString'] . "'>  ";
									}
								}  
						
							} else {
								if($value['Subfield Name'] != NULL){
									echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
									echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
									if($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF" or $value['InputType Name'] == "Image"){
										echo "<input id='". $value['FieldSubfield Id'] .  "'  type='file' name='". $value['FieldSubfield Id'] . "[]' >  ";
									} else if($value['InputType Name'] != NULL && $value['InputType Name'] == "Checkbox"){
										if($value['DataString'] == 'on') {
											echo $value['Subfield Name'] . " " ."<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' checked onclick='clickEvent(this)'>  ";
										} else {
											echo $value['Subfield Name'] . " " ."<input class='". $value['Field Id'] ."' type='checkbox' name='". $value['FieldSubfield Id'] . "[]' onclick='clickEvent(this)'>  ";
										}
									} else {
										echo $value['Subfield Name'] . " " . "<input id='". $value['FieldSubfield Id'] .  "' type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' value='". $value['DataString'] . "'>  ";
									} 
									
								}
							}                       
						}
						echo '</div>';
					?>
			</fieldset>
		</form>	
	</div>
@endsection
</body>
</html>



