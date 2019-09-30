@extends('employeeLayout')

@section('title', 'Employee')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/custom-css/employee.css') }}" rel="stylesheet">
    
    <script type='text/javascript' src="{{asset('libraries/jquery.js')}}"></script>

</head>

<body>
@section('content')
    <form id="pdsform" name="pdsform" action="/Employee" method="POST">
        {{ csrf_field() }}
    <div class="container-fluid" id="addSubFieldForm_b">
                    <!-- <label> Employee ID: </label><br> -->
                    <label> Employee Type: </label>
                    <center>
                        <div>
                            <select class="form-control" name="emp_type">
                                <?php
                                    foreach($empType as $value)
                                    {	
                                ?>
                                    <option><?php echo $value['Name'] ?></option>
                                <?php
                                    }	
                                ?>
                            </select>
                            <input type="submit" id="submitM" class="btn btn-success" name="submit" value="Submit">
                            <!-- </form> -->
                        </div>
                    </center>
				</div>
    <div class="container-fluid" id="sectionCon" style="height: 410px;">
        
            <?php
                $section = "";
                $field = "";
                $subfield = "";
                $fieldsubid = array();
                // $fieldName = array();
                $count = 1;
                foreach($result as $value){ 
                    $fieldsubid[] = $value['FieldSubfield Id'];

                    $val = json_encode($fieldsubid);

                    echo "<input type='hidden' name='fieldSubID' value='" . $val . "'>"; 



                    // $fieldsubid = array(
                    //     "id" => $value['FieldSubfield Id'],
                    //     "Name" => $value['Subfield Name']
                    // );

                    
                  
                    //print_r($fieldsubid);
                    if($section != $value['Section Name']){
                        $section = $value['Section Name'];
                        echo "<hr><div class='card' style='background-color: gray; color: white; padding-left: 10px;'><h1>" . $section . "</h1></div>";
                    } 
                    
                    if($field != $value['Field Name']){
                        $field = $value['Field Name'];

                        if($field != NULL && $field != $value['Subfield Name']){
                            echo "<br><br><h5>" . $field . ":</h5>" . $value['Subfield Name'] . " ";
                        } else if ($field != NULL && $field == $value['Subfield Name']){
                            echo "<br><br>" . $field . ": ";
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
            <br><br>
            </form>	
    </div>
@endsection

</body>
</html>

<script>
    $(document).ready(function(){
     	$('#submitM').click(function(){
     		$('#submitmodal').fadeIn();
     	}) 
         $('#exit').click(function(){
     		$('#submitmodal').fadeOut();
     	}) 
   })
</script>

