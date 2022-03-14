<?php
include("../adminsession.php");
$productid= addslashes($_REQUEST['productid']);
$unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$ret_date= $cmn->dateformatindia(trim(addslashes($_REQUEST['ret_date'])));
$purchaseid= trim(addslashes($_REQUEST['purchaseid']));



if($productid !='' && $qty !='')
{
$form_data = array('productid'=>$productid,'ret_qty'=>$qty,'ret_date'=>$ret_date,'purchaseid'=>$purchaseid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,"pur_return", $form_data);
			$action=1;
			$process = "insert";	
	
}
?>