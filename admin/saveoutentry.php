<?php
include("../adminsession.php");
$productid= addslashes($_REQUEST['productid']);
$unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$outentry_no= trim(addslashes($_REQUEST['outentry_no']));
$shop_id=trim(addslashes($_REQUEST['shop_id'])); 


if($productid !='' && $unitid !='' && $qty !='')
{
$form_data = array('productid'=>$productid,'unitid'=>$unitid,'qty'=>$qty,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid,'shop_id'=>$shop_id);
			dbRowInsert($connection,"out_entry_details", $form_data);
			$action=1;
			$process = "insert";	
	
}
?>