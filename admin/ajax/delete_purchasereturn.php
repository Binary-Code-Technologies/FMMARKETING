<?php include("../../adminsession.php");
$pretentry_id  = $_REQUEST['id'];
$tblname  =$_REQUEST['tblname'];
$tblpkey  =$_REQUEST['tblpkey'];
$module = $_REQUEST['module'];
$submodule = $_REQUEST['submodule'];
$pagename = $_REQUEST['pagename'];

//echo "delete from saleentry_detail where saleid = '$saleid'";die;
$res1 = mysqli_query($connection,"delete from pur_return where pretentry_id = '$pretentry_id'");
if($res1)
{
	$cmn->InsertLog($connection,$pagename, $module, $submodule, "saleentry_detail", "billdetailid", $saleid, "deleted");
	
	
	$res =  mysqli_query($connection,"delete from $tblname where $tblpkey = '$pretentry_id' ");
	if($res)
	{
	$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $pretentry_id, "deleted");
	}
	echo "<script>location='$pagename?action=3';</script>";
}


?>