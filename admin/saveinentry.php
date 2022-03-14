<?php
include("../adminsession.php");
$productid= addslashes($_REQUEST['productid']);
$unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$inentry_no= trim(addslashes($_REQUEST['inentryno']));


if($productid !='' && $unitid !='' && $qty !='')
{
$form_data = array('productid'=>$productid,'unitid'=>$unitid,'qty'=>$qty,'inentry_no'=>$inentry_no,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,"in_entry_details", $form_data);
			$action=1;
			$process = "insert";	
	
}
?>