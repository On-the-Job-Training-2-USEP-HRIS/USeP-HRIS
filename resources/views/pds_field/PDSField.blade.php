@extends('layout')
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel='stylesheet' type='text/css' href="{{asset('libraries/css/bootstrap.min.css')}}">
	<link rel='stylesheet'  href="{{asset('libraries/icons/css/font-awesome.min.css')}}">
	<script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>
</head>
<body>
@section('card-header')
<div class="container">
			<input type="button" id="addField" class='btn btn-success' name="addField" value="New Fields" style="width:120px;">
		</div>
@endsection

@section('card-body')
<div class="container">
			<b>
				{{$id['name']}}
			</b>
			<hr>
			<input type="checkbox" name="sectioname">
			<label>Field Name</label>
			<label style="position:absolute;left:400px;">Number of Subfields</label>
			<label style="position:absolute;left:800px;">Sequence</label>
		</div>
@endsection

@section('sectionContent')
		<div class="container-fluid" style="background-color:white;overflow:auto;height:370px;">
			<?php
				foreach($result as $value)
				{	
			?>
				<table class="table">
					<tr>
						<td style="display:none;"><?php echo $value['id'] ?></td>
						<td style="width:410px;"> <a href="/PDSSubfield?id=<?php echo $value['id']; ?>&name=<?php echo $value['Field Name']; ?>"><?php echo $value['Field Name'] ?></a> </td>
						<td style="width:360px;"> <?php echo $value['Number of Subfields'] ?> </td>
						<td > <?php echo $value['Sequence'] ?> </td>
					</tr>
				</table>
			<?php
				}	
			?>
		</div>
		
	@endsection

@section('modal')
		<div style="position:fixed;top:1px;display:none;position: fixed;z-index:1;padding-top:190px;left:0;top:0;width:100%;height:100%;
        overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4);" id="show">
			<div class="container" style="position:relative;background-color:white;width:500px;height:200px;">
				 <img src="{{asset('libraries/Delete.png')}}" style="position:absolute;left:475px;top:5px;" width="20" height="20" id="close">
				 	<div class="card" style="width:470px;height:150px;position:absolute;top:40px;padding:10px;">
				 	
				 			<form action="/PDSField?id={{$id['id']}}&name={{$id['name']}}" method="post">
				 				{{csrf_field() }}
				 				<div class="container-fluid" style="position:absolute;width:230px;">
				 					<center>
							 			<input type="text" class="form-control" name="field_name" style="position:relative;width:200px;border-top:0px;border-right:0px;border-left:0px;">
							 			<label style="position:relative;">Enter field name</label>
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
	@endsection
</body>
</html>
<script>
   $(document).ready(function(){
     	$('#addField').click(function(){
     		$('#show').fadeIn();
     	}) 
     	$('#close').click(function(){
     		$('#show').fadeOut();
     	}) 
   });
</script>