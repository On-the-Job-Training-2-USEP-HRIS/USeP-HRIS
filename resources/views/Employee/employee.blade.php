@extends('employeeLayout')

@section('title', 'Employee')

@section('content')
    <div class="container-fluid" id="sectionCon" style="height: 410px;">
        <form id="pdsform" name="pdsform" action="/redirecttestpage" method="POST">
            <?php
                $section = "";
                $field = "";
                $subfield = "";

                foreach($result as $value){
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
        </form>	
    </div>
@endsection