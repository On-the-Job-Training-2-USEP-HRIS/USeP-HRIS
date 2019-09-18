@extends('layout')
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<link href="{{ asset('libraries/custom-css/pds_subField.css') }}" rel="stylesheet">

	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body>
	@section('title', "{$id['name']}")
	@section('card-header')
	<div class="container">
		<input type="button" id="addsubField" class='btn btn-success' name="addSubField" value="New Subfield">

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
				<li class="breadcrumb-item active"> <a href="/PDSField?id={{$id['id2']}}&name={{$id['name']}}&name={{$id['name2']}}"> <b> {{$id['name2']}} </b></a></li>
				<li class="breadcrumb-item active" aria-current="page"> <b>{{$id['name']}}</b> </li>
			</ol>
		</nav>
			
			<hr>
			<input type="checkbox" id="selectAll" name="selectAll">
			<label> Subfield Name </label>
			<label id="label_inputType"> Input Type </label>
			<label id="label_seqSubField"> Sequence </label>
	</div>
	@endsection

@section('sectionContent')
		<div class="container-fluid" id="sectionConSF">
			<?php
				foreach($result3 as $value)
				{	
			?>
				<table class="table table-hover">
					<tr>
						<td> <input type="checkbox" id="select" name="select"> </td>
						<td style="display:none;"><?php echo $value['id'] ?></td>
						<td style="width:410px;"> <?php echo $value['Subfield Name'] ?></td>
						<td style="width:360px;"> <?php echo $value['Input Type'] ?> </td>
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
		<div style="position:fixed;top:1px;display:none;position: fixed;z-index:1;padding-top:170px;left:0;top:0;width:100%;height:100%;
        overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4);" id="show">
			<div class="container" style="position:relative;background-color:white;width:600px;height:260px;">
				 <img src="{{asset('libraries/Delete.png')}}" style="position:absolute;left:565px;top:7px;" width="20" height="20" id="close">
				 	<div class="card" style="width:570px;height:200px;position:absolute;top:40px;padding:10px;">
				 	
				 			<form action="/PDSSubfield?id={{$id['id']}}&name={{$id['name']}}&name2={{$id['name']}}&id2={{$id['id']}}" method="post">
				 				{{csrf_field() }}
				 				<div class="container-fluid" style="position:absolute;width:230px;left:2px;top:24px;">
				 					<center>
							 			<input type="text" class="form-control" name="Subfield_name" style="position:relative;width:200px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter Subfield name</label>
						 			</center>
					 			</div>
					 			<div class="container-fluid" style="position:absolute;width:180px;left:200px;top:24px;">
				 					<center>
							 			<input type="text" class="form-control" name="sequence" style="position:relative;width:70px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter Sequence</label>
						 			</center>
					 			</div>
					 			<div class="container-fluid" style="position:absolute;width:170px;left:380px;" >
					 				<center>
					 					<div class="form-group">
					 						<select class="form-control" name="input_type">
					 						<?php
													foreach($result4 as $value)
													{	
												?>
													
							 							<option><?php echo $value['Name'] ?></option>
							 						
												<?php
													}	
												?>
					 						</select>
					 					</div>
					 					<label style="position:relative;">Select input type</label>
					 				</center>
					 			</div>
					 			<button type="submit" class="btn" style="position:absolute;top:120px;left:250px;background-color:#680000;color:white;"> Submit</button>
					
				 			</form>
				 		
				 	</div> 
			</div>
		</div>
	</div>
	@endsection
</body>
</html>

<script>
   $(document).ready(function(){
     	$('#addsubField').click(function(){
     		$('#showSubField').fadeIn();
     	}) 
     	$('#close').click(function(){
     		$('#showSubField').fadeOut();
     	}) 
   });

   $(document).ready(function(){
		$('#selectAll').click(function(){
			$(':checkbox').attr({checked: 'true'});
		});
   });
</script>