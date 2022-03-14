<?php  include("../adminsession.php");
$barcode=trim(addslashes($_REQUEST['barcode']));
$process=trim(addslashes($_REQUEST['process']));

if($barcode !='')
{
	$sql=mysqli_query($connection,"select * from m_product where barcode='$barcode'");
	$row=mysqli_fetch_assoc($sql);
	$numrows=mysqli_num_rows($sql);
	
	if($numrows !='0')
	{
	echo $row['productid'];
	}
	else
	{
		echo '0';
	}
}
else
{
	echo '0';	
}

?>