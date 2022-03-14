<?php
include("../adminsession.php");
$productid= addslashes($_REQUEST['productid']);
$unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$rate= addslashes($_REQUEST['rate']);
$tax_id= addslashes($_REQUEST['tax_id']);
$disc= addslashes($_REQUEST['disc']);
$purdetail_id= addslashes($_REQUEST['purdetail_id']);
$ret_date= $cmn->dateformatindia(trim(addslashes($_REQUEST['ret_date'])));
$purchaseid= trim(addslashes($_REQUEST['purchaseid']));

 $tax_cat_id= $cmn->getvalfield($connection,"m_tax","tax_cat_id","tax_id='$tax_id'");
 $tax= $cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");


if($tax_cat_id==4)
{
	$cgst=$tax/2;
	$sgst=$tax/2;
	$igst=0;
}
else if($tax_cat_id==3)
{
	$cgst=0;
	$sgst=0;
	$igst=$tax;
}


 	$pretentry_id=0;


if($productid !='' && $qty !='')
{
$form_data = array('productid'=>$productid,'pretentry_id'=>$pretentry_id,'purdetail_id'=>$purdetail_id,'ret_qty'=>$qty,'rate'=>$rate,'tax_id'=>$tax_id,'disc'=>$disc,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,"pur_return", $form_data);
			$action=1;
			$process = "insert";	
	
}
?>