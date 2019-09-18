@extends('layout')
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link href="{{ asset('libraries/custom-css/pds_menu.css') }}" rel="stylesheet">

	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body>
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
				<!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
			</ol>
		</nav>
		</div>
	@endsection

	@section('sectionContent')
		<div class="container" id="sectionCon" style="height: 410px;">

        <!-- <div class="container-fluid" style="overflow:auto; border: 1px solid #D3D3D3; border-radius: 5px; width: 530px;"> -->
			
                <?php
                    $section = "";
                    $field = "";
                    $subfield = "";

                    foreach($result as $value){
                        if($section != $value['Section Name']){
                            $section = $value['Section Name'];
                            echo "<hr><h1>" . $section . "</h1>";
                        } 
                        
                        if($field != $value['Field Name']){
                            $field = $value['Field Name'];
                            // echo "<br>";
                            if($field != NULL){
                                echo "<br><br><h5>" . $field . ":</h5>" . $value['Subfield Name'] . " ";
                            }
                            
                            if($value['InputType Name'] != NULL){
                                echo "<input type='" . $value['InputType Name'] . "' name='". $value['Field Name'] . "'>  ";
                            }    
                        } else {
                            if($value['Subfield Name'] != NULL){
                                echo $value['Subfield Name'] . " " . "<input type='" . $value['InputType Name'] . "' name='". $value['Field Name'] . "'>  ";

                            }
                                                    }

                        
                    }
                ?>
			
		<!-- </div>   -->
			
		</div>
		
	@endsection

</body>
</html>

<script>

	//Add Section
   $(document).ready(function(){
     	$('#addsection').click(function(){
     		$('#showAddSection').fadeIn();
     	}) 
     	$('#icon_exit').click(function(){
     		$('#showAddSection').fadeOut();
     	}) 
   })
   
   function editModal (id)
   {
		$('#editsection'+id).click(function(){
			$('#showEditSection').fadeIn();
		}) 
		$('#closeEditSection').click(function(){
			$('#showEditSection').fadeOut();
		}) 
   }

   function deleteModal (id)
   {
		$('#deletesection'+id).click(function(){
			$('#showDeleteSection').fadeIn();
		}) 
		$('#input_cancel').click(function(){
			$('#showDeleteSection').fadeOut();
		}) 
   }

   $(document).ready(function(){
		$('#selectAll').click(function(){
			$(':checkbox').attr({checked: 'true'});
		});
   });
</script>