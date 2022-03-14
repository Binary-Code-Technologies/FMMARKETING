<?php
include("../adminsession.php");
 $saleid=addslashes($_REQUEST['saleid']);


if($saleid == 0)
	$crit = " where 1 = 1 ";
	else
	$crit = " where saleid='$saleid' ";
	
?>
    
    <table class="table table-condensed table-bordered" style="width:100%; border-radius:5px; float:left" id="myTable">
    <tr class="header" style="font-size:12px;color:#000;">
        <th style="width:10%;">SL</th>
        <th style="width:60%;">Item</th>
        <th style="width:15%;">Unit</th>
        <th style="width:10%;">Quantity</th>
        <th style="width:10%;">Prev. Ret.</th>
        <th style="width:10%;">Bal Qty</th>
    
<?php

 $slnos=1;
	$sql=mysqli_query($connection,"select * from saleentry_detail $crit order by productid asc");
	while($row=mysqli_fetch_assoc($sql))
	{
		
		 $productid = $row['productid'];
		 
		 $prodname = $cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
	     $sale_qty = $row['qty'];
		 $ret_qty=$cmn->getvalfield($connection,"salereturn","sum(ret_qty)","saleid='$saleid' && productid='$productid'");
		 $unitid = $row['unitid'];
		 $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
		 
		  if($ret_qty =='')
		 {
			$ret_qty=0; 
		 }
		 $bal_qty= $sale_qty - $ret_qty;
 ?>	

 <tr onClick="addproduct('<?php echo $productid;  ?>','<?php echo $prodname; ?>','<?php echo $unit_name; ?>','<?php echo  $unitid; ?>','<?php echo  $sale_qty ; ?>','<?php echo $ret_qty; ?>','<?php echo $bal_qty; ?>');" style="cursor:pointer;">
            	<td><span style="font-weight:bold;font-size:12px;"><?php echo $slnos++; ?></span></td>
                <td><span style="font-weight:bold;font-size:12px;" ><?php echo  $prodname; ?> </span></td>
                <td><span style="font-weight:bold;font-size:12px;"> <?php echo $unit_name; ?> </span></td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo $sale_qty; ?></span>&nbsp;</td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo $ret_qty; ?></span>&nbsp;</td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo $bal_qty; ?></span>&nbsp;</td>
                
                </tr>
<?php 		
	}

?>


