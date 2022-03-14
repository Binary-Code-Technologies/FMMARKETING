<?php
include("../adminsession.php");
$productid = addslashes($_REQUEST['productid']);

if($productid !='')
{
	$sqlget = "select m_product.*, unit_name from m_product left join m_unit on m_unit.unitid = m_product.unitid where productid = '$productid'";
	$rowget = mysqli_fetch_array(mysqli_query($connection,$sqlget));
	$jsondata = json_encode($rowget);
	echo $jsondata;
}
else
echo "0";
?>