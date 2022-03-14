<?php
include("../adminsession.php");

 $saleid=trim(addslashes($_REQUEST['saleid'])); 

if($saleid =='')
{
	$saleid=0;	
}
else
{
	$saleid=$saleid;
}

$sqlget=mysqli_query($connection,"select * from saleentry_detail where saleid='$saleid'");
$sn=1;
$amount=0;
?>
<table class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Product Name</th>
                                                <th>Unit</th>
                                                 <th>Rate</th>
                                                <th>Qty.</th>
                                                 <th>Disc%</th>
                                                  <th>Total</th>
                                               
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
									
			while($rowget=mysqli_fetch_assoc($sqlget))
			{
				$total=0;
				
				$saledetail_id=$rowget['saledetail_id'];
				$productid=$rowget['productid'];
				$unitid=$rowget['unitid'];
				$qty=$rowget['qty'];
				$rate=$rowget['rate'];
				$disc=$rowget['disc'];
				
				$total=$qty * $rate;
				$discamt=($total * $disc)/100;
				$total=$total - $discamt;
				
				$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
			  $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
				
										?>
                                            <tr>
                                            	<td><?php echo $sn; ?></td>
                                                <td><?php echo $prodname; ?></td>
                                                <td><?php echo $unit_name; ?></td>
                                                 <td style="text-align:right;"><?php echo $rate;  ?></td>
                                                <td><?php echo $qty;  ?></td>
                                                 <td><?php echo $disc;  ?></td>
                                                  <td><?php echo $total;  ?></td>
                                                <td class="center"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $saledetail_id; ?>');"> X </a></td>
                                            </tr>
                                            
             <?php
			 $amount += $total;
$sn++;
}

?>    
 <tr>
 
               <td colspan="8" align="right" style="text-align:right;"><h5>Total :
               <input type="text" id="tot_amt" value="<?php echo number_format($amount,2); ?>" style= "width:70px; border:none; font-weight:bold;" readonly="readonly"  />
                <input type="hidden" id="hidtot_amt" value="<?php echo $amount; ?>" style= "width:70px; border:none; font-weight:bold;" readonly="readonly"  /> </h5> </td>
               </tr>
                                         
      <tr>
      <td colspan="8"><p align="center"> <input type="submit" class="btn btn-danger" value="Save" name="submit"  >  &nbsp; &nbsp; 
      <input type="hidden" name="saleid" value="<?php echo $saleid; ?>"  />
      <a href="saleentry.php" class="btn btn-primary" > Reset </a>
      
       </p>  </td>
      </tr>                                      
               
                                           
                                        </tbody>
                                    </table>
