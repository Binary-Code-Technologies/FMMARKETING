<?php
include("../adminsession.php");
$productid= addslashes($_REQUEST['productid']);
$unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$return_amt= addslashes($_REQUEST['return_amt']);
$sale_retdate= $cmn->dateformatindia(trim(addslashes($_REQUEST['sale_retdate'])));
$saleid= trim(addslashes($_REQUEST['saleid']));

if($productid !='' && $qty !='')
{
$form_data = array('productid'=>$productid,'ret_qty'=>$qty,'return_amt'=>$return_amt,'sale_retdate'=>$sale_retdate,'saleid'=>$saleid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,"salereturn", $form_data);
			$action=1;
			$process = "insert";	
}
?>