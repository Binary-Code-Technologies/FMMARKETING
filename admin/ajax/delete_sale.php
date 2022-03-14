<?php include("../../adminsession.php");
$saleid  = $_REQUEST['id'];

//echo "delete from saleentry_detail where saleid = '$saleid'";die;
$res =  mysqli_query($connection,"delete from saleentry where saleid = '$saleid' ");
$res1 = mysqli_query($connection,"delete from saleentry_detail where saleid = '$saleid'");



?>