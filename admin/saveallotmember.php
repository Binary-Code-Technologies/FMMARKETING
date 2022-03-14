<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$packdetail_id = trim($_REQUEST['packdetail_id']);
$teamtid = trim($_REQUEST['teamtid']);

echo "hi";
if($teamtid !='' && $packdetail_id !='')
{
	mysqli_query($connection,"update package_details set teamtid='$teamtid' where packdetail_id='$packdetail_id'");
	
	echo "update package_details set teamtid='$teamtid' where packdetail_id='$packdetail_id'";
}
?>