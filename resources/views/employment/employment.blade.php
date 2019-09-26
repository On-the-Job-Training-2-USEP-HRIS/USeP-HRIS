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
	@section('title', 'Employment')
	@section('card-header')
		<div class="container">
			<input type="button"  class="btn btn-success" id="addsection" name="addSection" value="Add Employee">

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
				<li class="breadcrumb-item" aria-current="Employment"><b>EMPLOYMENT</b></li>
			</ol>
			<div class="container">
				<div class="row p-2">
					
				<div/>
			</div>
		</nav>
		</div>
	@endsection

	@section('sectionContent')
    <div class="container-fluid" id="sectionCon" style="height: auto; width: 1200px; margin-bottom: 30px;">
		
	</div>
	@endsection

    @section('modal')
		
		<!-- Add Section Modal -->
		<div id="showAddSection">
			<div class="container" id="addSectionModal_a">
				 <img src="{{asset('images/exit.png')}}" id="icon_exit" width="20" height="20">
				 	<div class="card" id="addSectionModal_b">
						<form action="/Employment " method="post">
							{{csrf_field() }}
							<div class="container-fluid" id="addEmployeeForm">
                                <center>
                                    <div class="form-group">
                                        <label style="position:relative;">Select Employee type</label>
                                        <select class="form-control" name="employee_type">
                                            <?php
                                                foreach($result1 as $value)
                                                {	
                                            ?>
                                                <option value="<?php echo $value['id']?>"><?php echo $value['Name']?></option>
                                            <?php
                                                }	
                                            ?>
                                        </select>
                                    </div>  
                                </center>
                            </div>
							<button type="submit" class="btn" id="input_add"> Submit</button>
						</form>
				 		
				 	</div> 
			</div>
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
</script>