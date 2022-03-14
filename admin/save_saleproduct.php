<?php 
error_reporting(0);
include("../adminsession.php");
 $productid= addslashes($_REQUEST['productid']);
 $unitid= addslashes($_REQUEST['unitid']);
$qty= addslashes($_REQUEST['qty']);
$rate= trim(addslashes($_REQUEST['rate']));
 $tax= $_REQUEST['tax1'];

$saleid=trim(addslashes($_REQUEST['saleid']));
$disc_per = trim(addslashes($_REQUEST['disc_per']));
$saledetail_id = $_REQUEST['saledetail_id'];


		$total=	$qty * $rate;
		if($disc_per!=0){
			$discamt=	$total * $disc_per/100;
			$total=	$total - $discamt;
		}

		if($tax!=0){
			$taxamt=	$total * $tax/100;
			$total=	$total + $taxamt;
		}
	
	 $totalval=$total;


//if($productid !='' && $qty !='')
//{
	if($saledetail_id == 0)
	{
	
$form_data = array('productid'=>$productid,'unitid'=>$unitid,'qty'=>$qty,'disc_per'=>$disc_per,'rate'=>$rate,'tax'=>$tax,'totalval'=>$totalval,'saleid'=>$saleid,
				  'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,"saleentry_detail", $form_data);
			$action=1;
			$process = "insert";
	}
	else
	{
		$form_data = array('productid'=>$productid,'unitid'=>$unitid,'qty'=>$qty,'disc_per'=>$disc_per,'rate'=>$rate,'tax'=>$tax,'totalval'=>$totalval,'saleid'=>$saleid,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid,'saledetail_id'=>$saledetail_id);
			dbRowUpdate($connection,"saleentry_detail", $form_data,"WHERE saledetail_id = '$saledetail_id'");
			$action=2;
			$process = "update";
	}
	
//}
?>