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
		
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th> <input type="checkbox" id="selectAll" name="selectAll"> </th>
					<th style="width:410px;"> Subfield Name </span> </th>
					<th style="width:400px;">  Input Type </span></th>
					<th style="width:320px;"> Sequence </span> </th>
					<th colspan="2"></th>
					<th></th>
				</tr>
			</table>
		</div>
	</div>
	@endsection

@section('sectionContent')
		<div class="container" id="sectionConSF">
			<?php
				foreach($result3 as $value)
				{	
			?>
				<table class="table table-hover">
					<tr>
						<td> <input type="checkbox" name="checkAll" class="checkSingle"> </td>
						<td style="display:none;"><?php echo $value['id'] ?></td>
						<td style="width:410px;"> <?php echo $value['Subfield Name'] ?></td>
						<td style="width:360px;"> <span class="badge badge-light"> <?php echo $value['Input Type'] ?> </span> </td>
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
	<div id="showSubField">
		<div class="container" id="showSubField_a">
			<img src="{{asset('images/exit.png')}}"width="20" height="20" id="close">
			<div class="card" id="showSubField_b">
				<form action="/PDSSubfield?id={{$id['id']}}&name={{$id['name']}}&name2={{$id['name2']}}&id2={{$id['id2']}}" method="post">
					{{csrf_field() }}
					<div class="container-fluid" id="addSubFieldForm">
						<center>
							<input type="text" class="form-control" id="input_subFieldName" name="Subfield_name">
							<label style="position:relative;">Enter Subfield name</label>
						</center>
					</div>
					<div class="container-fluid" id="addSubFieldForm_a">
						<center>
							<input type="text" class="form-control" id="input_seqSubField" name="sequence">
							<label style="position:relative;">Enter Sequence</label>
						</center>
					</div>
					<div class="container-fluid" id="addSubFieldForm_b">
						<center>
							<div class="form-group">
								<select class="form-control" name="input_type">
									<?php
										foreach($result4 as $value)
										{	
									?>
										<option  value="<?php echo $value['id']?>"><?php echo $value['id'] ?></option>
									<?php
										}	
									?>
								</select>
							</div>
							<label style="position:relative;">Select input type</label>
						</center>
					</div>
					<button type="submit" class="btn" id="input_addSubField"> Submit</button>
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
			// $(':checkbox').attr({checked: 'true'});
			//alert("this");
		});
   });

   $(document).ready(function() {
    $("#selectAll").change(function() {
        if (this.checked) {
            $(".checkSingle").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkSingle").each(function() {
                this.checked=false;
            });
        }
    });

    $(".checkSingle").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".checkSingle").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#selectAll").prop("checked", true);
            }     
        }
        else {
            $("#selectAll").prop("checked", false);
        }
    });
});
</script>