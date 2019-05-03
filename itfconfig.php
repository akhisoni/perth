<?php error_reporting(1);
define('MAXLENCE','Developement Company');
date_default_timezone_set("Asia/Calcutta");
global $ITF_JSFILES,$ITF_CSSFILE;
$ITF_JSFILES=array();
$ITF_CSSFILE=array();

if(!@session_start())
session_start();
$BASEPATHS = dirname(__FILE__);
$iLocal = 0;

if($iLocal=="0")
{
	define('BASEPATHS',$BASEPATHS);
	define('ITFPATH','/crease/');
	define('MYSQLDB_HOST' , 'localhost');
	define('MYSQLDB_USER' , 'root');
	define('MYSQLDB_PASS' , '');
	define('MYSQLDB_DATABASE', 'perth_tango');
	define('MYSQLDB_PORT' , 3306);
	define('SITEURL','http://localhost:8081/perth_tango/');
    define('FCK_PATH','F:/xampp/htdocs/perth_tango/fck_files/');
}


else
{
	define('BASEPATHS',$BASEPATHS);
	define('ITFPATH','/');
	define('MYSQLDB_HOST' , 'localhost');
	define('MYSQLDB_USER' , 'maxlence');
	define('MYSQLDB_PASS' , 'maxlences#');
	define('MYSQLDB_DATABASE', 'maxlence');
	define('MYSQLDB_PORT' , 3306);
	define('SITEURL','http://www.maxlence.com.au');
    define('FCK_PATH','/home4/maxlence/public_html/fck_files/');

}


	define('SITEPATH',BASEPATHS);
	define('CSSPATH',ITFPATH.'css/');
	define('ITF_JSPATH',ITFPATH.'js/');
	define('IMAGEPATH',ITFPATH.'images/');
	define('PUBLICFILE',BASEPATHS.'/itf_public/');
	define('PUBLICPATH',SITEURL.'/itf_public/');
	define('COMPONENTPATH',SITEPATH."/site/component/com_");
	
	
//==============================PLEASE DO NOT CHANGE BELOW CODE. IT MIGHT COUSE PROBLEM============================================


define('DBOF_SHOW_NO_ERRORS'    , 0);
define('DBOF_SHOW_ALL_ERRORS'   , 1);
define('DBOF_RETURN_ALL_ERRORS' , 2);
define('MYSQLAPPNAME' , 'MySQL_class');
define('DB_ERRORMODE', DBOF_SHOW_ALL_ERRORS);
define('MYSQLDB_ADMINEMAIL' , 'akhilesh.soni@maxlence.com.au');
define('MYSQLDB_SENTMAILONERROR', 0);
define('MYSQLDB_USE_PCONNECT', 0);
define('MYSQLDB_CHARACTERSET'   , 'utf8');
define('DBOF_DEBUGOFF'    , (1 << 0));
define('DBOF_DEBUGSCREEN' , (1 << 1));
define('DBOF_DEBUGFILE'   , (1 << 2));
define('ADMINEMAILID' , 'akhilesh.soni@maxlence.com.au');

require_once(BASEPATHS.'/includes/classinformation.php');
global $itfmysql,$itftemplate;
$itfmysql = new Mysql();
$itfmysql->Connect();
Template::setTemplate("default");

$userobjs = new User();
$uploadimg = new ITFImageResize();
$objsite = new Site();
$stieinfo = $objsite->CheckSite("1");
