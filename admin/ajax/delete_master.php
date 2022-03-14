<?php include("../../adminsession.php");
 $id  = $_REQUEST['id'];
 $ltblname = $_REQUEST['ltblname'];
$tblname  =$_REQUEST['tblname'];
$tblpkey  =$_REQUEST['tblpkey'];
$module = $_REQUEST['module'];
$submodule = $_REQUEST['submodule'];
$pagename = $_REQUEST['pagename'];

//echo "delete from $tblname where $tblpkey = '$id'";die;
$res =  mysqli_query($connection,"delete from $tblname where $tblpkey = '$id'");
      mysqli_query($connection,"DELETE FROM $ltblname WHERE $tblpkey = '$id'");

if($res)
{
	//$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $id, "deleted");
	echo "<script>location='$pagename?action=3';</script>";
}


?>