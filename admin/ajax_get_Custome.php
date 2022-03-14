<?php
include("../adminsession.php");

$partyid  = $_REQUEST['partyid']; 

$sqlgetcust=mysqli_query($connection,"select * from m_supplier_party where suppartyid='$partyid'");
$rowgetcust=mysqli_fetch_assoc($sqlgetcust);


	$tin_no=$rowgetcust['tinno'];

	$panno=$rowgetcust['panno'];


echo $rowgetcust['mobile'].'|'.$rowgetcust['address'].'|'.$rowgetcust['cust_type'].'|'.$tin_no.'|'.$panno;

?>