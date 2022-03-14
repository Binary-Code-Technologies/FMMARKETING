<?php
include("../adminsession.php");
$pcatid=addslashes($_REQUEST['pcatid']);
$process=addslashes($_REQUEST['process']);

if(pcatid !='')
{

if($pcatid == 0)
	$crit = " where 1 = 1 ";
	else
	$crit = " where pcatid='$pcatid' ";
	
?>
    <table class="table table-condensed table-bordered" style="width:100%; border-radius:5px; float:left" id="myTable">
    <tr class="header" style="font-size:14px;color:#000;">
        <th style="width:10%;">SL</th>
        <th style="width:20%;">Product Code</th>
        <th style="width:30%;">Item</th>
        <th style="width:25%;">Categary</th>
         <th style="width:15%;">Unit</th>
         <th style="width:15%;">Stock</th>
    
<?php
	$sql=mysqli_query($connection,"select * from m_product $crit order by prodname asc");
	while($row=mysqli_fetch_assoc($sql))
	{
		 $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$row[unitid]'");		
		$opening_stock=$row['opening_stock'];
		$stock=$cmn->get_stock($row['productid']);
		$pcatid=$row['pcatid'];		
		$catname =$cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'");
		
		if($process=='purchase')
		{
			$rate=$row['pur_rate'];
		}
		else
		{
			$rate=$row['rate'];
		}
 ?>	

 <tr onClick="addproduct('<?php echo $row['productid'];  ?>','<?php echo $row['prodname']; ?>','<?php echo $unit_name; ?>','<?php echo $row['unitid']; ?>','<?php echo $rate; ?>','<?php echo $row['tax_id']; ?>');" style="cursor:pointer;">
            	<td><span style="font-weight:bold;font-size:12px;"><?php echo ++$slnos; ?></span></td>
                 <td><span style="font-weight:bold;font-size:12px;" ><?php echo $row['prod_code']; ?> </span></td>
                <td><span style="font-weight:bold;font-size:12px;" ><?php echo $row['prodname']; ?> </span></td>
                 <td><span style="font-weight:bold;font-size:12px;" ><?php echo $catname; ?> </span></td>
                <td><span style="font-weight:bold;font-size:12px;"> <?php echo $unit_name; ?> </span></td>
                <td style="text-align:right;"><span style="font-weight:bold;font-size:12px;"> <?php echo number_format($stock,2); ?></span>&nbsp;</td>
                </tr>
<?php 		
	}

}



?>


