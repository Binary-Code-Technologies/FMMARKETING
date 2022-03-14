<?php error_reporting(0);
include("../adminsession.php");
$purchaseid=trim(addslashes($_REQUEST['purchaseid'])); 

if($purchaseid =='')
{
	$purchaseid=0;	
}
else
{
	$purchaseid=$purchaseid;
}

$sqlget=mysqli_query($connection,"select * from purchasentry_detail where purchaseid='$purchaseid'");
$sn=1;
$amount=0;
?>

<table width="100%" class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                               <th width="3%">SN</th>
                                                <th width="31%">Product Name</th>
                                                <th width="8%">Unit</th>
                                                 
                                                  <th width="8%" style="text-align:right;">Qty.</th>
                                                    <!-- <th width="8%">Free Qty</th> -->
                                                 <th width="7%" style="text-align:right;">Rate</th>
                                                 <th width="8%" style="text-align:right;">Disc(%)</th>                                               
                                                 <th width="12%" style="text-align:right;">GST(%)</th>                                               
                                                  <th width="10%" style="text-align:right;">Amount</th>
                                                <th width="9%" class="center">Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
				$toal_disc=0;
				$gstamt=0;
			while($rowget=mysqli_fetch_assoc($sqlget))
			{
				$total=0;
				$discamt=0;
				$purdetail_id=$rowget['purdetail_id'];
				$productid=$rowget['productid'];
				$purchaseid=$rowget['purchaseid'];
				$unitid=$rowget['unitid'];
				$qty=$rowget['qty'];
				$rate=$rowget['rate'];
				$disc=$rowget['disc'];
				$tax_id =$rowget['tax_id'];
				$vat=$rowget['vat'];
				$disc=$rowget['disc'];
				$cgst=$rowget['cgst'];
				$sale_unit=$rowget['sale_unit'];
				$sgst=$rowget['sgst'];
				$igst=$rowget['igst'];
			
				if($rowget['cgst'] !='0' && $rowget['sgst'] !='0')
				{	
				$tax= $rowget['cgst'] + $rowget['sgst'];
				$gst =$tax;
				}
				else if($rowget['igst'] !='0')
				{
					$tax= $rowget['igst'];
					$gst = $rowget['igst'].'% IGST';
				}
				else if($rowget['vat'] !='0')
				{
					$tax= $rowget['vat'];
					$gst = $rowget['vat'];
				}
				
				//if($qty!='0' && $rate='0')
	//{
		 $total  =	$qty * $rate;
	//}
	
	
	
				if($disc !='0')
				{
					$discamt=($total * $disc)/100;
				}
				else
				{
					$discamt=0;
				}
				
				$net_total_amt= $total-$discamt;
				
								
				$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
			 	 $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
				 //$stock=$cmn->get_stock($productid);
				//echo $stock; die; 
				 
			   if($tax != '0')
			 {
				 
				$taxamt = ($net_total_amt * $tax)/100;
				  
			 }
										?>
				<tr>
					<td><?php echo $sn; ?></td>
					<td><?php echo $prodname; ?></td>
					<td><?php echo $unit_name; ?></td>                                                 
						<td style="text-align:right;"><?php echo $qty;  ?></td>
						
						<td style="text-align:right;"><?php echo $rate;  ?></td>
						<td style="text-align:right;"> <?php echo $disc;  ?> </td> 
					<td style="text-align:right;"><?php echo $gst;  ?></td>
					
						<td style="text-align:right;"><?php echo $total;  ?></td>
					<td class="center"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $purdetail_id; ?>');"> X </a> / &nbsp;<a  class="btn btn-primary btn-small" title="Edit" onclick="updaterecord('<?php echo $prodname; ?>','<?php echo $productid; ?>','<?php echo $unit_name; ?>','<?php echo $unitid; ?>','<?php echo $rate; ?>','<?php echo $qty; ?>','<?php echo $tax_id; ?>','<?php echo $tax; ?>','<?php echo $total; ?>','<?php echo $purdetail_id; ?>','<?php echo $disc; ?>');">
					<span class='icon-edit' ></span> 
					</a></td>
				</tr>
				
             <?php
			 		$toal_disc += $discamt;
					$amount += $total;
					$gstamt +=$taxamt;
$sn++;
}
 

?>    
 <tr>
 
               <td colspan="8" align="right" style="text-align:right;"><h5>Total :
               <input type="text" id="tot_amt" value="<?php echo number_format($amount,2); ?>" style= "width:70px; border:none; font-weight:bold; text-align:right;" readonly="readonly"  />
                <input type="hidden" id="hidtot_amt" value="<?php echo $amount; ?>" style= "width:70px; border:none; font-weight:bold;" readonly="readonly"  /> </h5> </td>
                <td>&nbsp;</td>
               </tr>
               
               <tr>
               
                <td colspan="8" align="right" style="text-align:right;"><h5> Disc :
               <input type="text" id="tot_disc_per" value="<?php echo round($toal_disc,2); ?>" style= "width:70px; border:none; font-weight:bold;text-align:right;" readonly="readonly"  />
                </h5> </td>
                <td>&nbsp;</td>
               </tr>
               
               <tr>
               
               <td colspan="8" align="right" style="text-align:right;"><h5> Tax :
               <input type="text" id="tot_tax_gst" value="<?php echo round($gstamt,2); ?>" style= "width:70px; border:none; font-weight:bold;text-align:right;" readonly="readonly"  />
                </h5> </td>
                <td>&nbsp;</td>
               </tr>
               
               <tr>
 
               <td colspan="8" align="right" style="text-align:right;"><h5>Net Total  :
               <input type="text" id="netamt" value="<?php echo $net; ?>" style= "width:70px; border:none; font-weight:bold;text-align:right;" readonly="readonly"  />
                </h5> </td>
                <td>&nbsp;</td>
               </tr>
               
                                         
      <tr>
      <td colspan="11"><p align="center"> <input type="submit" class="btn btn-danger" value="Save" name="submit"  >  &nbsp; &nbsp; 
      <input type="hidden" name="purchaseid" value="<?php echo $purchaseid; ?>"  />
      <a href="purchaseentry.php" class="btn btn-primary" > Reset </a>
      
       </p>  </td>
      </tr>                                      
               
                                           
                                        </tbody>
                                    </table>
