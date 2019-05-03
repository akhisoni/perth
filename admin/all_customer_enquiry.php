<?php
include('../itfconfig.php');
$filename = "All_Customer_Enquiry" . date('Y-m-d') . ".xls"; 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");
?>		
<table border="2" cellpadding="3" cellspacing="2">
<!--<tr><td colspan="32" align="left" bgcolor="#CC0000"><strong>All Orders</strong></td></tr>-->
<!--<tr><td colspan="32" align="left" bgcolor="#CC0000"><strong>Guest Orders</strong></td></tr>-->
<?php echo "<tr>"; ?>
<?php echo "<td><b>Id</b></td>"; ?>
<?php echo "<td><b>Name</b></td>"; ?>
<?php echo "<td><b>Email</b></td>"; ?>
<?php echo "<td><b>Phone</b></td>"; ?>
<?php echo "<td><b>Subject</b></td>"; ?>
<?php echo "<td><b>Message</b></td>"; ?>
<?php echo "<td><b>From Page</b></td>"; ?>
<?php echo "<td><b>Enquiry Date</b></td>"; ?>
<?php echo "</tr>"; ?>
<?php


 
 $tab1  = mysql_query("Select lo.id as 'Id', lo.name as 'Name',lo.email as 'Email', lo.phone as 'Phone', lo.subject as 'Subject', lo.message as 'Message', lo.from_page as 'From Page', lo.date_added as 'Enquiry Date'
 from itf_customer_enquiry lo order by lo.id ASC ");
 while( $single_result= mysql_fetch_array($tab1))
 {
 	
	
	  echo "<tr>"; ?>
	 <?php echo "<td>".$single_result['Id']."&nbsp;</td>"; ?>
            <?php echo "<td>".$single_result['Name']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Email']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Phone']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Subject']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Message']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['From Page']."&nbsp;</td>"; ?>
        <?php echo "<td>".$single_result['Enquiry Date']."&nbsp;</td>"; ?>

       
        <?php echo "</tr>";
	
	
	
 
 
?>
	 <?php } ?>        
        </table>
