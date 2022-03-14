<?php 
error_reporting(0);
include("../adminsession.php");
$tblname = "m_product";
$tblpkey = "productid";
$prodname = test_input($_REQUEST['s_prodname']);  
$pcatid = test_input($_REQUEST['s_pcatid']); 
$unitid = test_input($_REQUEST['s_unitid']);
$rate = test_input($_REQUEST['s_rate']);
$pur_rate = test_input($_REQUEST['s_pur_rate']); 
$opening_stock = test_input($_REQUEST['s_opening_stock']);
$barcode = test_input($_REQUEST['s_barcode']);
$stockdate = $cmn->dateformatusa($_REQUEST['s_stockdate']); 
// $expiry_date = test_input($_REQUEST['s_expiry_date']);
// $batchno = test_input($_REQUEST['s_batchno']);

if($prodname !='' )
{
	
	$getsqlchk = mysqli_query($connection,"select * from m_product where (prodname = '$prodname') ");
	$cntchk = mysqli_num_rows($getsqlchk);	
	if($cntchk != 0)
	{
		$duplicate = "ERROR: Duplicate Record...";
	}
	else
	{	
	  //save product
		$form_data = array('prodname'=>$prodname,'pcatid'=>$pcatid,'unitid'=>$unitid,'rate'=>$rate,'opening_stock'=>$opening_stock,'pur_rate'=>$pur_rate,'stockdate'=>$stockdate,'ipaddress'=>$ipaddress,'createdate'=>$createdate);
	 	dbRowInsert($connection,'m_product', $form_data);
		$productid = mysqli_insert_id($connection);
		$prod_code=$cmn->getcode($connection,$tblname,$tblpkey,"1=1");
		mysqli_query($connection,"update m_product set prod_code = '$prod_code' where productid = '$productid'");
		//$cmn->InsertLog($connection,"master_product.php", "master", "Product Master", "m_product", "productid", $productid, 'Insert');
	}
	
 }
 
 
 
 $sql=mysqli_query($connection,"select * from m_product order by productid desc");
 while($row=mysqli_fetch_assoc($sql))
 {
	  $catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid=$row[pcatid]");
?>

<option value="<?php echo $row['productid']; ?>" > <?php echo $row['prodname']." / ".$catname; ?> </option>

<?php }  ?>