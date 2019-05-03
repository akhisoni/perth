<?php
$validate_fields = array('Member Id'=>'','Member Username'=>'','Member First Name'=>'','Member Last Name'=>'','Member Email Id'=>'','Member Type'=>'','Member Register Date'=>'','Member Expire Date'=>'','Member Profile Id'=>'');
	if(!empty($_FILES['file']['name']))
	{
        $filename = $userobj->excelUpload();

        $excel = new ITFExcelReader();
        $excel->read(PUBLICFILE."/products/".$filename);
        $allres = $excel->GetDataInfo($excel);
    // echo "<pre>"; print_r($allres); die;
        if($allres){
            $datas = array();
            $success = 0;
            $error = 0;
            $update = 0;
            $catdata = array();
            $catAdded = 0;


            //echo "<pre>"; print_r($allres); die;
          
            foreach($allres as $result){
$datas = array('Member Id'=>$result['Member Id'],'Member Username'=>$result['Member Username'],'Member First Name'=>$result['Member First Name'],'Member Last Name'=>$result['Member Last Name'],'Member Email Id'=>$result['Member Email Id'],'Member Type'=>$result['Member Type'],'Member Register Date'=>$result['Member Register Date'],'Member Expire Date'=>$result['Member Expire Date'],'Member Profile Id'=>$result['Member Profile Id']);


//echo "<pre>"; print_r($result['Member Id']); 

                $valid = array_diff_key($result);
				//echo "<pre>"; print_r($valid); die;
                $invalidFields = implode(", ", array_keys($valid));

                if(!empty($valid)){
                    flash("Error: Field name not matched of ".$invalidFields." ",'2');
                    redirectUrl("itfmain.php?itfpage=".$currentpagenames."&actions=import");

                }

                $finalcategory = array();
           $id=$result['Member Id'];
                    if(!empty($result['Member Username'])){

                        $prodata = $userobj->CheckUser($id);
						//echo   $prodata; 
//die;
                        if(!empty($prodata)){
							echo "aas";
                            $datas['id'] = $prodata['Member Id'];
                            $userobj->user_updateexcel($datas);
                            $update += 1;

                        }  else {
                        //    $userobj->freeRegisterexcel($datas);
                          //  $success += 1;
						  
                        }
                    } else {
                        $error += 1;
                    }

                

            }

        }
        flash("Success: <span class='red'>".$success."</span> new users are inserted and <span class='red'>".$update."</span> users are updated and <span class='red'>".$error."</span> users are not inserted !");
        redirectUrl("itfmain.php?itfpage=".$currentpagenames);

	}

?>
<script type="text/javascript">

$(document).ready(function() {

    var Validator = jQuery('#itffrminput').validate({
        rules: {
            file: {required:true, accept:"xls"}

        },
        messages: {


        }
    });
});
</script>
<div class="full_w">
	<!-- Page Heading -->
    <div class="h_title"><?php echo "Import". $pagetitle;?></div>
    <!-- Page Heading -->
					
<form action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />

    <div class="element">
        <label><span class="blue">Notice: File header must be named as <?php echo implode(", ",array_keys($validate_fields)); ?> </span></label>


    </div>

    <div class="element">
        <label>Select Excel File<span class="red">(required)</span> </label>
        <input class="text" name="file" type="file"  id="file" size="35" />
    </div>


<!-- Form Buttons -->
    <div class="entry">
        <button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
    </div>
<!-- End Form Buttons -->
</form>
    <!-- End Form -->
</div>