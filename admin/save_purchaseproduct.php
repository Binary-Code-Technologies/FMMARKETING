<?php //error_reporting(0);
include("../adminsession.php");
$productid= addslashes($_REQUEST['productid']);
$unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$rate= trim(addslashes($_REQUEST['rate']));
$disc= trim(addslashes($_REQUEST['disc']));
$tax= trim(addslashes($_REQUEST['tax']));
$tax_id=trim(addslashes($_REQUEST['tax_id']));
$disc_per = trim(addslashes($_REQUEST['disc_per']));
$purdetail_id=trim(addslashes($_REQUEST['purdetail_id']));  
$purchaseid = trim(addslashes($_REQUEST['purchaseid']));
$tax_cat_id= $cmn->getvalfield($connection,"m_tax","tax_cat_id","tax_id='$tax_id'");
$tax= $cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
//$tax_type = trim(addslashes($_REQUEST['tax_type']));

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

if($productid !='' && $qty !='')
{
	
	$total=	$qty * $rate;
	
	if($disc_per)
	{
		$discamt= ($total * $disc_per)/100;
		$total= $total - $discamt;
	}
	
	
	if($tax)
	{
		$taxamt= ($total * $tax)/100;
		$total= $total + $taxamt;
	}
	
$totalval=$total;
	
	if($purdetail_id==0)
	{
	
	$form_data = array('productid'=>$productid,'unitid'=>$unitid,'qty'=>$qty,'disc_per'=>$disc_per,'rate'=>$rate,'disc'=>$disc,
			'tax_id'=>$tax_id,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'totalval'=>$totalval,
		   'purchaseid'=>$purchaseid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
	dbRowInsert($connection,"purchasentry_detail", $form_data);
	$action=1;
	$process = "insert";
	echo "1";
	}
	else
	{
		
	//$cgst = $cmn->get_cgst($tax_id);
	//$sgst = $cmn->get_sgst($tax_id);
	//$igst = $cmn->get_igst($tax_id);

	$form_data = array('productid'=>$productid,'unitid'=>$unitid,'qty'=>$qty,'disc_per'=>$disc_per,'rate'=>$rate,'disc'=>$disc,
			'tax_id'=>$tax_id,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'totalval'=>$totalval,
		   'purchaseid'=>$purchaseid,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
		dbRowUpdate($connection,"purchasentry_detail", $form_data,"WHERE purdetail_id = '$purdetail_id'");
		$action=2;
		$process = "update";
	}
	
}
?>