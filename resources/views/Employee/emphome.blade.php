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
				<li class="breadcrumb-item" aria-current="PERSONAL DATA SHEET"><b>PERSONAL DATA SHEET</b></li>
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
			<div class="container"  style="width: 750px;">
				<div class="row p-2">
				<div class="col-10"><b><em style="display: inline">By pressing the "Save Data" button, I hereby declare that the details furnished below are true and correct 
					to the best of my knowledge and belief and I undertake to inform the department in charge of any changes therein, immediately.</em></b></div>
					<div class="col pt-2"><form><input type="submit" class="btn btn-danger" form="emphome" style="display: inline-block;" value="Save Data"></form></div>	
				<div/>
			</div>
		</nav>
		</div>
@endsection

@section('content')
<div class="container-fluid" id="sectionCon" style="height: auto; margin-bottom: 30px;">
			<form id="emphome" name="emphome" action="/emphome" method="POST" style="height: auto;">
			@csrf
                <?php
                    $section = "";
					$field = "";
					// dd($emp_dataresult);
					// print_r($emp_dataresult);

                    foreach($result as $value){

						
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
								echo "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] .  "[]' >  ";
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='file' name='". $value['FieldSubfield Id'] .  "[]' >  ";
							} if ($value['InputType Name'] != NULL && $value['InputType Name'] == "Image"){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								echo "<input type='file' name='". $value['FieldSubfield Id'] .  "[]' >  ";
							}
							  
                        } else {
                            if($value['Subfield Name'] != NULL){
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['InputGroup Id'] . "' type='hidden'>  ";
								echo "<input name='". $value['FieldSubfield Id'] .  "[]' value='" . $value['FieldSubfield Id'] . "' type='hidden'>  ";
								if($value['InputType Name'] != NULL && $value['InputType Name'] == "PDF"){
									echo $value['Subfield Name'] . " " . "<input type='file' name='". $value['FieldSubfield Id'] . "[]' >  ";
								} if($value['InputType Name'] != NULL && $value['InputType Name'] == "Image"){
									echo $value['Subfield Name'] . " " . "<input type='file' name='". $value['FieldSubfield Id'] . "[]' >  ";
								} else {
									echo $value['Subfield Name'] . " " . "<input type='" . $value['InputType Name'] . "' name='". $value['FieldSubfield Id'] . "[]' >  ";
								}
                                
							}
						}                       
                    }
                ?>
			</form>	
		</div>
	@endsection

</body>
</html>

