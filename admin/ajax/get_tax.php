<?php 
include("../../adminsession.php");
$tax_id=trim(addslashes($_REQUEST['tax_id']));
$productid=trim(addslashes($_REQUEST['productid']));

mysqli_query($connection,"update m_product set tax_id='$tax_id' where productid='$productid");

$tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");


echo $tax;
?>