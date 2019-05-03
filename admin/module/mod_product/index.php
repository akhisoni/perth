<?php
$obj = new Product();
$currentpagenames=isset($_GET['itfpage'])?$_GET['itfpage']:'';
$pagetitle="Products";

$actions=isset($_REQUEST['actions'])?$_REQUEST['actions']:'list';
	switch($actions)
	{
		case 'add':
			include(ITFModulePath.'view/add.php');
			break;
	
		case 'edit':
			include(ITFModulePath.'view/add.php');
			break;

        case 'import':
            include(ITFModulePath.'view/import.php');
            break;

        case 'importtest':
            include(ITFModulePath.'view/importtest.php');
            break;
	
		case 'delete':
			include(ITFModulePath.'view/list.php');
			break;
	
	
	
	       case 'product_paid':
			include(ITFModulePath.'view/list_paid.php');
			break;
	
	
	case 'edit_paid':
			include(ITFModulePath.'view/add_paid.php');
			break;

		default:
			include(ITFModulePath.'view/list.php');
	}
?>