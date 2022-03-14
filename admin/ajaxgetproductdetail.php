<?php error_reporting(0);                                                                                                   include("../adminsession.php");

$productid=trim(addslashes($_REQUEST['productid']));
$process=trim(addslashes($_REQUEST['process']));


	if($productid !='')
	{
		$unitid =$cmn->getvalfield($connection,"m_product","unitid","productid='$productid'");
		$unit_name=$cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
		$pur_rate=$cmn->getvalfield($connection,"m_product","pur_rate","productid='$productid'");
		$tax_id=$cmn->getvalfield($connection,"m_product","tax_id","productid='$productid'");
		$tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
		
		echo $unitid."|".$unit_name."|".$pur_rate."|".$tax_id."|".$tax;
			
	}

?>