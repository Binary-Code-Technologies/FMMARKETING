<?php
include("../adminsession.php");
$tblname = "m_product";
$tblpkey = "productid";
$supparty_name = test_input(trim($_REQUEST['supparty_name'])); 

if($supparty_name !='')
{
	
	$getsqlchk = mysqli_query($connection,"select * from m_supplier_party where supparty_name = '$supparty_name' ");
	$cntchk = mysqli_num_rows($getsqlchk);	
	echo $cntchk;
}
else
echo "";
?>