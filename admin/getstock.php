<?php
include("../adminsession.php");
$productid = addslashes($_REQUEST['productid']);

if($productid !='')
{
					
						$pur = $cmn->getvalfield($connection,"purchasentry_detail","sum(qty)","productid='$productid'");
						$freepur = $cmn->getvalfield($connection,"purchasentry_detail","sum(freeqty)","productid='$productid'");
					$sold = $cmn->getvalfield($connection,"saleentry_detail","sum(qty)","productid='$productid'");
					 $sold_ret =$cmn->getvalfield($connection,"salereturn","sum(ret_qty)","productid='$productid'");
					$opening_stock = $cmn->getvalfield($connection,"m_product","opening_stock","productid='$productid'");
					echo $stock=$opening_stock+$pur+$freepur - $sold+$sold_ret;
						
}
else
echo "0";
?>