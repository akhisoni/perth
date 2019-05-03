<?php
include('../itfconfig.php');
$filename = "All_Members_" . date('Y-m-d') . ".xls"; 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");
?>		
<table border="2" cellpadding="3" cellspacing="2">
<!--<tr><td colspan="32" align="left" bgcolor="#CC0000"><strong>All Orders</strong></td></tr>-->
<!--<tr><td colspan="32" align="left" bgcolor="#CC0000"><strong>Guest Orders</strong></td></tr>-->
<?php echo "<tr>"; ?>
<?php echo "<td><b>Member Id</b></td>"; ?>
<?php echo "<td><b>Member Username</b></td>"; ?>
<?php echo "<td><b>Member First Name</b></td>"; ?>
<?php echo "<td><b>Member Last Name</b></td>"; ?>
<?php echo "<td><b>Member Email Id</b></td>"; ?>
<?php echo "<td><b>Member Type </b></td>"; ?>
<?php echo "<td><b>Member Register Date</b></td>"; ?>
<?php echo "<td><b>Member Expire Date</b></td>"; ?>
<?php echo "<td><b>Member Profile Id</b></td>"; ?>
<?php echo "</tr>"; ?>
<?php


 
//echo "Select lo.id as 'Member Id', lo.name as 'Member First Name', lo.last_name as 'Member Last Name', lo.email as 'Member Email Id', mo.usertype as 'Member Type', lo.entrydate as 'Member Register Date', po.expiry_date as 'Member Expire Date' from itf_users lo, itf_usertype mo, itf_user_profile po where lo.usertype = mo.orders and lo.id = po.id and lo.profile_id!='0' order by lo.id ASC "; 
 $tab1  = mysql_query("Select lo.id as 'Member Id', lo.username as 'Member Username',lo.name as 'Member First Name', lo.last_name as 'Member Last Name', lo.email as 'Member Email Id', mo.usertype as 'Member Type', lo.entrydate as 'Member Register Date',lo.profile_id as 'Member Profile Id', po.expiry_date as 'Member Expire Date' from itf_users lo, itf_usertype mo, itf_user_profile po where lo.usertype = mo.orders and lo.profile_id = po.id and lo.profile_id!='0' order by lo.id ASC ");
 while( $single_result= mysql_fetch_array($tab1))
 {
 	
	
	  echo "<tr>"; ?>
	 <?php echo "<td>".$single_result['Member Id']."&nbsp;</td>"; ?>
            <?php echo "<td>".$single_result['Member Username']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Member First Name']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Member Last Name']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Member Email Id']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Member Type']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Member Register Date']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Member Expire Date']."&nbsp;</td>"; ?>
         <?php echo "<td>".$single_result['Member Profile Id']."&nbsp;</td>"; ?>
       
        <?php echo "</tr>";
	
	
	
 
 
?>
	 <?php } ?>        
        </table>
