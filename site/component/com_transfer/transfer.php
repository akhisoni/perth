<?php
if(isset($_SESSION["FRONTUSER"]["current"]))
{

	if($_SESSION["FRONTUSER"]["current"]=="2")
	{
		$_SESSION["FRONTUSER"]["current"]="3";
		$_SESSION["FRONTUSER"]["usertype"]="3";	
        //flashMsg("You have transferred to the Supplier Area.");
		redirectUrl(CreateLink(array("supplier")));		
	}
	else
	{
		$_SESSION["FRONTUSER"]["current"]="2";
		$_SESSION["FRONTUSER"]["usertype"]="2";
		//flashMsg("You have transferred to the Customer Area.");
		redirectUrl(CreateLink(array("customer")));
		
	}
	
	//redirectUrl(CreateLink(array("dashboard")));
}
?>
