@extends('layout')
<!DOCTYPE html>
<html>
<head>
	<!-- <title>{{$id['name']}}</title> -->
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<link href="{{ asset('libraries/custom-css/pds_field.css') }}" rel="stylesheet">

	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body>
	@section("title", "{$id['name']}")
	@section('card-header')
	<div class="container">
		<input type="button" id="addField" class='btn btn-success' name="addField" value="New Field">

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
				<li class="breadcrumb-item"><a href="/PDSmenu"><b>Section</b></a></li>
				<li class="breadcrumb-item active" aria-current="page">
					<b>
						{{$id['name']}}
					</b>
				</li>
			</ol>
		</nav>
				
		<hr>
		<input type="checkbox" id="selectAll" name="selectAll">
		<label> Field Name </label>
		<label id="label_numSubField"> Number of Subfields </label>
		<label id="label_sequenceSub"> Sequence </label>
	</div>
	@endsection

	@section('sectionContent')
		<div class="container-fluid" id="contentField">
			<?php
				foreach($result as $value)
				{	
			?>
				<table class="table table-hover">
					<tr>
						<td> <input type="checkbox" id="select" name="select"> </td>
						<td style="display:none;"><?php echo $value['id'] ?></td>
						<td style="width:410px;"> <a href="/PDSSubfield?id=<?php echo $value['id']; ?>&name=<?php echo $value['Field Name']; ?>&name2={{$id['name']}}&id2={{$id['id']}}"><?php echo $value['Field Name'] ?></a> </td>
						<td style="width:360px;"> <?php echo $value['Number of Subfields'] ?> </td>
						<td style="width:200px;"> <?php echo $value['Sequence'] ?> </td>
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
		<div id="showFieldModal">
			<div class="container" id="showFieldModal_a">
				<img src="{{asset('images/exit.png')}}" width="20" height="20" id="close">
				<div class="card" id="showFieldModal_b">
				
					<form action="/PDSField?id={{$id['id']}}&name={{$id['name']}}" method="post">
						{{csrf_field() }}
						<div class="container-fluid" id="addFieldForm">
							<center>
								<input type="text" id="input_field" class="form-control" name="field_name">
								<label style="position:relative;">Enter field name</label>
							</center>
						</div>
						<div class="container-fluid" id="addFieldForm_a">
							<center>
								<input type="text" id="input_sequenceField" class="form-control" name="sequence">
								<label style="position:relative;">Enter Sequence</label>
							</center>
						</div>
						<button type="submit" id="input_addField" class="btn"> Submit</button>
					</form>
				</div> 
			</div>
		</div>
	@endsection

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
			
</body>
</html>

<script>
   $(document).ready(function(){
     	$('#addField').click(function(){
     		$('#showFieldModal').fadeIn();
     	}) 
     	$('#close').click(function(){	
     		$('#showFieldModal').fadeOut();
     	}) 
   });

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