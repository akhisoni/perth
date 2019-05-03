<?php 
$msgs="Login";
require('../itfconfig.php');


echo $sql = "select * from itf_category";
$result = mysql_query($sql);



$data = array(
	array('Name'=>'parvez', 'Empid'=>11, 'Salary'=>101),
	array('Name'=>'alam', 'Empid'=>1, 'Salary'=>102),
	array('Name'=>'phpflow', 'Empid'=>21, 'Salary'=>103)							
	);

$results = array(
			"sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
          "aaData"=>$data);


echo json_encode($results);
?>



