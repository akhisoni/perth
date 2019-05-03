<?php
$objReport = new Package();
$currentpagenames=isset($_GET['itfpage'])?$_GET['itfpage']:'';
$pagetitle="Reports";

$actions=isset($_REQUEST['actions'])?$_REQUEST['actions']:'list';
	switch($actions)
	{
        case 'order':
            include(ITFModulePath.'view/order.php');
            break;

        case 'transaction':
            include(ITFModulePath.'view/transaction.php');
            break;


        case 'view':
            include(ITFModulePath.'view/detail.php');
            break;



        case 'view_detail':
            include(ITFModulePath.'view/event_order_detail.php');
            break;


 case 'view_product_detail':
            include(ITFModulePath.'view/product_order_detail.php');
            break;

        case 'export':
            include(ITFModulePath.'view/export.php');
            break;

		case 'delete':
			include(ITFModulePath.'view/list.php');
			break;
			
			
        case 'product_order':
            include(ITFModulePath.'view/product_order.php');
            break;

	
		default:
			include(ITFModulePath.'view/list.php');
	}
?>