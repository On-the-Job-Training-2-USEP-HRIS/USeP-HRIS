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
	@section('title', 'Menu')
	@section('card-header')
		<div class="container">
			<input type="button"  class="btn btn-success" id="addsection" name="addSection" value="New Section">

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
				<li class="breadcrumb-item" aria-current="PDSmenu"><b>Section</b></li>
				<!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
			</ol>
		</nav>
			<hr>
			<input type="checkbox" id="selectAll" name="selectAll">
			<label id="label_sectionName"> <span class="badge badge-light"> Section Name </span> </label>
			<label id="label_numFields"> <span class="badge badge-light">  Number of fields </span> </label>
			<label id="label_sequence"> <span class="badge badge-light"> Sequence </span> </label>
		</div>
	@endsection

	@section('sectionContent')
		<div class="container" id="sectionCon">
			<?php
				foreach($result2 as $value)
				{	
			?>
				<table class="table table-hover">
					<tr>
						<td> <input type="checkbox" id="select" name="select"> </td>
						<td style="width:410px;"> <a href="/PDSField?id=<?php echo $value['id']; ?>&name=<?php echo $value['Section Name']; ?>" style="text-decoration:none;"><?php echo $value['Section Name'] ?></a> </td>
						<td style="width:360px;"> <span class="badge badge-light"> <?php echo $value['Number of Fields'] ?> </span> </td>
						<td style="width:200px;"> <span class="badge badge-light"> <?php echo $value['Sequence'] ?> </span> </td>
						<td colspan="2"> <img src="images/edit.png" width="23px" height="23px" onClick="editModal(<?php echo $value['id']; ?>)" id="editsection<?php echo $value['id']; ?>"> </td>
						<td> <img src="images/delete.png" width="22px" height="22px" onClick="deleteModal(<?php echo $value['id']; ?>)" id="deletesection<?php echo $value['id']; ?>"> </td>
					</tr>
				</table>
			<?php
				}	
			?>
		</div>
		
	@endsection

	@section('modal')
		
		<!-- Add Section Modal -->
		<div id="showAddSection">
			<div class="container" id="addSectionModal_a">
				 <img src="{{asset('images/exit.png')}}" id="icon_exit" width="20" height="20">
				 	<div class="card" id="addSectionModal_b">
						<form action="/PDSmenu" method="post">
							{{csrf_field() }}
							<div class="container-fluid" id="addSecForm">
								<center>
									<input type="text" class="form-control" id="input_section_name" name="section_name">
									<label style="position:relative;">Enter Section Name</label>
								</center>
							</div>
							<div class="container-fluid" id="addSecForm_a">
								<center>
									<input type="text" class="form-control" id="input_sequence" name="sequence">
									<label style="position:relative;">Enter Sequence</label>
								</center>
							</div>
							<button type="submit" class="btn" id="input_add"> Submit</button>
						</form>
				 		
				 	</div> 
			</div>
		</div>

		<!-- Edit Section Modal -->
		<div id="showEditSection">
			<div class="container"  id="showEditSection_a">
				 <img src="{{asset('images/exit.png')}}" width="20" height="20" id="closeEditSection">
				 	<div class="card" id="showEditSection_b">
				 	
				 			<form action="/PDSmenu" method="post">
				 				{{csrf_field() }}
				 				<div class="container-fluid" id="editSecForm">
				 					<center>
							 			<input type="text" class="form-control" name="section_name" id="input_section_name">
							 			<label style="position:relative;">Enter Section Name</label>
						 			</center>
					 			</div>
					 			<div class="container-fluid" id="editSecForm_a">
				 					<center>
							 			<input type="text" class="form-control" name="sequence" id="input_sequence">
							 			<label style="position:relative;">Enter Sequence</label>
						 			</center>
					 			</div>
					 			<button type="submit" id="input_edit" class="btn" name="update"> Update </button>
				 			</form>
				 	</div> 
			</div>
		</div>

		<!-- Delete Section Modal -->
		<div id="showDeleteSection">
			<div class="container"  id="showDeleteSection_a">
				 	<div class="card"  id="showDeleteSection_b">
						<p id="text_que"> Are you sure you want to delete this section? </p>						
						<button type="submit" id="input_confirm" class="btn"> Confirm </button>
					 	<button type="submit" id="input_cancel" class="btn"> Cancel </button>	 
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