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
			<input type="button" id="addsection" class='btn btn-success' name="addSection" value="New Section" style="width:120px;">
		</div>
	@endsection

	@section('card-body')
		<div class="container">
			<b>Section</b>
			<hr>
			<input type="checkbox" name="sectioname">
			<label>Section Name</label>
			<label style="position:absolute;left:400px;">Number of fields</label>
			<label style="position:absolute;left:800px;">Index</label>
		</div>
	@endsection

	@section('sectionContent')
		<div class="container-fluid" style="background-color:white;overflow:auto;height:370px;">
			@foreach ($getSection as $user)
			<table  class="table ">
				<tr>
					<td>{{ $user->Name }}</td>
				</tr>
			</table>
			@endforeach
		</ul>
		</div>
		
	@endsection

	@section('modal')
		<div style="position:fixed;top:1px;display:none;position: fixed;z-index:1;padding-top:190px;left:0;top:0;width:100%;height:100%;
        overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4);" id="show">
			<div class="container" style="position:relative;background-color:white;width:500px;height:200px;">
				 <img src="{{asset('libraries/Delete.png')}}" style="position:absolute;left:475px;top:5px;" width="20" height="20" id="close">
				 	<div class="card" style="width:470px;height:130px;position:absolute;top:50px;padding:10px;">
				 		<center>
				 			<form action="/PDSmenu" method="post">
				 				{{csrf_field() }}
					 			<input type="text" class="form-control" name="section_name" placeholder="Enter section name" style="width:200px;border-top:0px;border-right:0px;border-left:0px;">
					 			<br>
					 			<button type="submit" class="btn" style="background-color:#680000;color:white;"> Submit</button>
				 			</form>
				 		</center>
				 	</div> 
			</div>
		</div>
	@endsection
</body>
</html>
<script>
   $(document).ready(function(){
     	$('#addsection').click(function(){
     		$('#show').fadeIn();
     	}) 
     	$('#close').click(function(){
     		$('#show').fadeOut();
     	}) 
   });
</script>