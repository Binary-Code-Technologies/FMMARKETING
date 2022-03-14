<?php error_reporting(0);                                                                                                   include("../adminsession.php");
if(isset($_GET['productid']))
{
	$crit = " where 1=1 ";
	$productid = $_REQUEST['productid'];
	if($productid != "undefined" && $productid!="")
	{
		$crit =  $crit . " and prodname like '$productid%' ";
	}
}
$sql = "SELECT * from m_product  limit 0,65 ";
//echo $sql; 
?>
<form method="post" action="" enctype="multipart/form-data" name="myform">
<!-- start pagination -->    
<table id="myTable"  width="95%" border="0" cellspacing="1" cellpadding="1" class="gridtable">
                <tr align="center" valign="middle" height="40" style="text-shadow:#333">
                   <th class="H1Text" width="5%">
                   <div align="center"><input type="checkbox"  id="chk0" onClick="toggle(this.checked)" /><strong>All</strong></div></th>
                  <th class="H1Text" width="16%">
                       <strong>Product Name</strong></th>
                       <th class="H1Text" width="6%"><strong>Code</strong></th>
                   </tr>
              
<?php
$count = 1;
$res = mysqli_query($connection,$sql);
while($line = mysqli_fetch_array($res))
{
	$productid = $line['productid'];
	$prodname = $line['prodname'];
	$barcode   = $line['barcode'];
	if($barcode=="")
	 {
	  $barcode= "BCODEPROD00".$productid;
	 // echo "Update m_product set barcode ='$barcode' where productid='$productid'"; die;
	$sql = mysqli_query($connection,"Update m_product set barcode ='$barcode' where productid='$productid'");
  }	
?>
  <tr class="data-content" data-table="<?php echo $prodname; ?>" data-code="<?php echo $barcode; ?>" >
  <td height='20' align='center'>
  <div align="center"><input type="checkbox" name="chk<?php echo $count; ?>" id="chk<?php echo $count; ?>" onclick="addids()" value="<?php echo $barcode; ?>"/></div>  </td>
    <td align="center"><div align="center"><?php echo $prodname; ?></div></td>
    <td height='20' align='center'><div align="center"><?php echo $barcode; ?></div></td>
  	</tr>
<?php
	$c++;
	$count++;
}


?>
</table>

</form>