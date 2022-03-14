<?php
include("../adminsession.php");
$id=addslashes($_REQUEST['id']);
$tblname=addslashes($_REQUEST['tblname']);
$tblkey=addslashes($_REQUEST['tblkey']);
?>
    
    <table class="table table-condensed table-bordered" style="width:100%; border-radius:5px; float:left" id="myTable">
    <tr class="header" style="font-size:12px;color:#000;">
        <th style="width:10%;">SL</th>
        <th style="width:50%;">Item</th>
         <th style="width:10%;">Unit</th>
         <th style="width:10%;">Quantity</th>
          <th style="width:10%;">Prev. Ret.</th>
          <th style="width:10%;">Bal Qty</th>
          </tr>
    
<?php
//echo "select * from purchasentry_detail where $tblkey='$id'";
	$sql=mysqli_query($connection,"select * from purchasentry_detail where $tblkey='$id'");
	while($row=mysqli_fetch_assoc($sql))
	{
		 $prodname = $cmn->getvalfield($connection,"m_product","prodname","productid='$row[productid]'");
		 $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$row[unitid]'");
		 
		 $qty=$row['qty'];
		  $rate=$row['rate'];
		   $disc=$row['disc'];
		    $tax_id=$row['tax_id'];
			//  $purdetail_id=$row['purdetail_id'];
			  $pretentry_id = $cmn->getvalfield($connection,"purreturn_entry","pretentry_id","purchaseid='$id'");
			  
			//   $total = $cmn->getTotalReturn($purdetail_id);
		
	 $ret_qty=$cmn->getvalfield($connection,"pur_return","sum(ret_qty)","purdetail_id ='$row[purdetail_id]'");
		 
		
		 if($ret_qty =='' && $pretentry_id!=0)
		 {
			$ret_qty=0; 
		 }
		
		 $bal_qty=$qty - $ret_qty;
		 
	
			
		//$stock=$cmn->get_stock($row['productid']);
 ?>	
 <tr onClick="addproduct('<?php echo $row['productid'];?>','<?php echo $row['purdetail_id'];?>','<?php echo $prodname; ?>','<?php echo $unit_name; ?>','<?php echo $row['unitid']; ?>','<?php echo $qty; ?>','<?php echo $ret_qty; ?>','<?php echo $rate; ?>','<?php echo $disc; ?>','<?php echo $tax_id; ?>','<?php echo $bal_qty; ?>');" style="cursor:pointer;">
            	<td><span style="font-weight:bold;font-size:12px;"><?php echo ++$slnos; ?></span></td>
                <td><span style="font-weight:bold;font-size:12px;" ><?php echo $prodname; ?> </span></td>
                <td><span style="font-weight:bold;font-size:12px;"> <?php echo $unit_name; ?> </span></td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo $qty; ?></span>&nbsp;</td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo $ret_qty; ?></span>&nbsp;</td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo $bal_qty; ?></span>&nbsp;</td>
                </tr>
<?php 		
	}




?>


