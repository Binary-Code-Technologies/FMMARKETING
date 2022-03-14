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
                   <div align="center"><input type="checkbox" id="chk0" onClick="toggle(this.checked)" /><strong>All</strong></div></th>
                  <th class="H1Text" width="16%">
                       <strong>Code</strong></th>
                       <th class="H1Text" width="6%"><strong>Product Name</strong></th>
                       <th class="H1Text" width="6%"><strong>Rate</strong></th>
                       <th class="H1Text" width="6%"><strong>Batch NO.</strong></th>
                   </tr>
<?php
$count = 1;
$res = mysqli_query($connection,$sql);
while($line = mysqli_fetch_array($res))
{
?>
  <tr class="data-content" data-table="<?php echo $line['prodname']; ?>" data-code="<?php echo $line['prod_code']; ?>" >
  <td height='20' align='center'>
  <div align="center"><input type="checkbox" name="chk<?php echo $count; ?>" id="chk<?php echo $count; ?>" onclick="addids()" value="<?php echo $line['prod_code']; ?>"/></div>  </td>
    <td align="center"><div align="center"><?php echo $line['prod_code']; ?></div></td>
    <td height='20' align='center'><div align="center"><?php echo $line['prodname']; ?></div></td>
    <td height='20' align='center'><div align="center"><?php echo $line['rate']; ?></div></td>
    <td height='20' align='center'><div align="center"><?php echo $line['batch_no']; ?></div></td>
  	</tr>
<?php
	$c++;
	$count++;
}
?>
</table>

</form>