@extends('layout')
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body>
	@section('card-header')
		<div class="container">
			<input type="button" id="addsection" class='btn btn-success' name="addSection" value="New Section" style="width:120px;">

			<form class="form-inline" style="float:right;">
			<input type="search" class="form-control" placeholder="Search">
				<div class="form-input-group-append">
					<span class="input-group-text"><i aria-hidden="true"><img src="/images/search.png" style="height:15px;width:15px;"></i></span>
				</div>
			</form>
		</div>
	@endsection

	@section('card-body')
		<div class="container">
			<b>SECTIONS</b>
			<hr>
			<input type="checkbox" name="sectioname">
			<label>Section Name</label>
			<label style="position:absolute;left:400px;">Number of fields</label>
			<label style="position:absolute;left:800px;">Sequence</label>
		</div>
	@endsection

	@section('sectionContent')
		<div class="container-fluid" style="background-color:white;overflow:auto;height:370px;">
			<?php
				foreach($result2 as $value)
				{	
			?>
				<table class="table table-hover">
					<tr>
						<td style="width:410px;"> <a href="/PDSField?id=<?php echo $value['id']; ?>&name=<?php echo $value['Section Name']; ?>"><?php echo $value['Section Name'] ?></a> </td>
						<td style="width:360px;"> <?php echo $value['Number of Fields'] ?> </td>
						<td style="width:200px;"> <?php echo $value['Sequence'] ?> </td>
						<td colspan="2"> <i class="fa fa-edit" onClick="editModal(<?php echo $value['id']; ?>)" id="editsection<?php echo $value['id']; ?>" style="font-size:20px"></i> </td>
						<td> <i class="fa fa-trash" onClick="deleteModal(<?php echo $value['id']; ?>)" id="deletesection<?php echo $value['id']; ?>" style="font-size:20px"></i> </a></td>
					</tr>
				</table>
			<?php
				}	
			?>
		</div>
		
	@endsection

	@section('modal')
		
		<!-- Add Section Modal -->
		<div style="position:fixed;top:1px;display:none;position: fixed;z-index:1;padding-top:190px;left:0;top:0;width:100%;height:100%;
        overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4);" id="show">
			<div class="container" style="position:relative;background-color:white;width:500px;height:200px;">
				 <img src="{{asset('libraries/Delete.png')}}" style="position:absolute;left:475px;top:5px;" width="20" height="20" id="close">
				 	<div class="card" style="width:470px;height:150px;position:absolute;top:40px;padding:10px;">
				 	
				 			<form action="/PDSmenu" method="post">
				 				{{csrf_field() }}
				 				<div class="container-fluid" style="position:absolute;width:230px;">
				 					<center>
							 			<input type="text" class="form-control" name="section_name" style="position:relative;width:200px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter section name</label>
						 			</center>
					 			</div>
					 			<div class="container-fluid" style="position:absolute;width:180px;left:230px;">
				 					<center>
							 			<input type="text" class="form-control" name="sequence" style="position:relative;width:70px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter Sequence</label>
						 			</center>
					 			</div>
					 			
					 			<button type="submit" class="btn" style="position:absolute;top:90px;left:200px;background-color:#680000;color:white;"> Submit</button>
					
				 			</form>
				 		
				 	</div> 
			</div>
		</div>

		<!-- Edit Section Modal -->
		<div style="position:fixed;top:1px;display:none;position: fixed;z-index:1;padding-top:190px;left:0;top:0;width:100%;height:100%;
        overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4);" id="showEditSection">
			<div class="container" style="position:relative;background-color:white;width:500px;height:200px;">
				 <img src="{{asset('libraries/Delete.png')}}" style="position:absolute;left:475px;top:5px;" width="20" height="20" id="closeEditSection">
				 	<div class="card" style="width:470px;height:150px;position:absolute;top:40px;padding:10px;">
				 	
				 			<form action="/PDSmenu" method="post">
				 				{{csrf_field() }}
				 				<div class="container-fluid" style="position:absolute;width:230px;">
				 					<center>
							 			<input type="text" class="form-control" name="section_name" style="position:relative;width:200px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter section name</label>
						 			</center>
					 			</div>
					 			<div class="container-fluid" style="position:absolute;width:180px;left:230px;">
				 					<center>
							 			<input type="text" class="form-control" name="sequence" style="position:relative;width:70px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter Sequence</label>
						 			</center>
					 			</div>
					 			
					 			<button type="submit" class="btn" style="position:absolute;top:90px;left:200px;background-color:#680000;color:white;"> Update </button>
					
				 			</form>
				 		
				 	</div> 
			</div>
		</div>

		<!-- Delete Section Modal -->
		<div style="position:fixed;top:1px;display:none;position: fixed;z-index:1;padding-top:190px;left:0;top:0;width:100%;height:100%;
        overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4);" id="showDeleteSection">
			<div class="container" style="position:relative;background-color:white;width:500px;height:200px;">
				 	<div class="card" style="width:470px;height:150px;position:absolute;top:40px;padding:10px;">
						<p style="position:absolute;top:28px;left:73px;"> Are you sure you want to delete this section? </p>						
						<button type="submit" class="btn" style="position:absolute;top:70px;left:150px;background-color:#680000;color:white;"> Confirm </button>
					 	<button type="submit" id="closeDeleteSection" class="btn" style="position:absolute;top:70px;left:240px;background-color:#680000;color:white;"> Cancel </button>	 
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
     		$('#show').fadeIn();
     	}) 
     	$('#close').click(function(){
     		$('#show').fadeOut();
     	}) 
   });

	//Edit Section
//     $(document).ready(function (){
// 		var editID = document.getElementByID('sectionID').value;
// 		alert(editID);
//      	$('#editsection1').click(function(){
//      		$('#showEditSection').fadeIn();
//      	}) 
//      	$('#closeEditSection').click(function(){
//      		$('#showEditSection').fadeOut();
//      	}) 
//    });

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
		$('#closeDeleteSection').click(function(){
			$('#showDeleteSection').fadeOut();
		}) 
   }

//    //Delete Section
//    $(document).ready(function(){
//      	$('#deletesection').click(function(){
//      		$('#showDeleteSection').fadeIn();
//      	}) 
//      	$('#closeDeleteSection').click(function(){
//      		$('#showDeleteSection').fadeOut();
//      	}) 
//    });
</script>