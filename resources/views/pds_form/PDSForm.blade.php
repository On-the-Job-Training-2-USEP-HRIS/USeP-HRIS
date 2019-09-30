@extends('layout')
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link href="{{ asset('libraries/custom-css/pds_menu.css') }}" rel="stylesheet">

	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body style="overflow-y: scroll;">
	@section('title', 'PDS Form')
	@section('card-header')
		<div class="container">
			<input type="button"  class="btn btn-success" id="addsection" name="addSection" value="Refresh Form">

			<form class="form-inline" style="float:right;">
				<input type="search" class="form-control" placeholder="Search">
				<div class="form-input-group-append">
					<span class="input-group-text">
						<i aria-hidden="true"><img src="/images/search.png" height="20" width="20"></i>
					</span>
				</div>
			</form>
		</div>
	@endsection

	@section('card-body')
		<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item" aria-current="PDSmenu"><b>PERSONAL DATA SHEET FORM</b></li>
			</ol>
			<!-- <div class="container">
				<div class="row p-2">
					<div class="col"><b><em style="display: inline">By pressing the "Submit Data" button, I hereby declare that the details furnished below are true and correct 
					to the best of my knowledge and belief and I undertake to inform you of any changes therein, immediately.</em></b></div>
					<div class="col pt-2"><form><input type="submit" class="btn btn-danger" form="pdsform" style="display: inline-block;" value="Submit Data"></form></div>
				<div/>
			</div> -->
		</nav>
		</div>
	@endsection

	@section('sectionContent')
		<div class="container-fluid" id="sectionCon" style="height: auto; width: 1200px; margin-bottom: 30px;">
			<form id="pdsform" name="pdsform" action="/PDSForm" method="POST" style="height: auto;">
			@csrf
                <?php
                    $section = "";
                    $field = "";

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

<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>