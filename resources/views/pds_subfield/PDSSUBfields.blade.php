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
			<input type="button" id="addSubField" class='btn btn-success' name="addSubField" value="New Subfields" style="width:120px;">
		</div>
@endsection

@section('card-body')
<div class="container">
			<b>{{$id['name']}}</b>
			<hr>
			<input type="checkbox" name="sectioname">
			<label>Subfield Name</label>
			<label style="position:absolute;left:400px;">Input Type</label>
			<label style="position:absolute;left:800px;">Sequence</label>
		</div>
@endsection

@section('sectionContent')
		<div class="container-fluid" style="background-color:white;overflow:auto;height:370px;">
			<?php
				foreach($result3 as $value)
				{	
			?>
				<table class="table">
					<tr>
						<td style="display:none;"><?php echo $value['id'] ?></td>
						<td style="width:410px;"> <?php echo $value['Subfield Name'] ?></td>
						<td style="width:360px;"> <?php echo $value['Input Type'] ?> </td>
						<td > <?php echo $value['Sequence'] ?> </td>
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
				 	
				 			<form action="/PDSSubfield?id={{$id['id']}}&name={{$id['name']}}" method="post">
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
	@endsection
</body>
</html>
<script>
   $(document).ready(function(){
     	$('#addSubField').click(function(){
     		$('#show').fadeIn();
     	}) 
     	$('#close').click(function(){
     		$('#show').fadeOut();
     	}) 
   });
</script>