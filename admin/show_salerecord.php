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

if($saleid==0)
{
	$cond = "saleid='$saleid' && createdby='$loginid'";
}
else
{
	$cond = "saleid='$saleid'";	
}
$sqlget=mysqli_query($connection,"select * from saleentry_detail where saleid='$saleid' and createdby='$loginid'");
$sn=1;
$amount=0;
?>
<table class="table table-bordered table-condensed" width="100%">
            <thead>
                <tr>
                   <th width="3%">SN</th>
                  <th width="25%">Product Name</th>
                  <th width="8%">Unit</th> 
                    <th width="8%" style="text-align:right;">Qty.</th>
                    <th width="7%" style="text-align:right;">Rate</th>
                      <th width="7%" style="text-align:right;">Disc(%)</th>
                      <th width="7%" style="text-align:right;">GST(%)</th>                                        
                    <th width="10%" style="text-align:right;">Amount</th>
                  <th width="9%" class="center">Action</th>
                </tr>    
            </thead>
            <tbody>
            <?php
			while($rowget=mysqli_fetch_assoc($sqlget))
			{
				$total=0;
				$net_total_amt=0;
				$saledetail_id=$rowget['saledetail_id'];
				$productid=$rowget['productid'];
				$unitid=$rowget['unitid'];
				$rate=$rowget['rate'];
        $qty=$rowget['qty'];
        $disc_per=$rowget['disc_per'];
        $tax=$rowget['tax'];
       
		    $total=	$qty * $rate;
          if($disc_per!=0){
            $discamt=	$total * $disc_per/100;
            $total=	$total - $discamt;
          }
          if($tax!=0){
            $taxamt=	$total * $tax/100;
            $total=	$total + $taxamt;
          }
         
				$net_total_amt += $total;
			  $prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
			  $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
										?>
                          <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $prodname; ?></td>
                                <td><?php echo $unit_name; ?></td>
                                <td style="text-align:right;"><?php echo $qty;  ?></td>
                                <td style="text-align:right;"><?php echo $rate;  ?></td>
                                <td style="text-align:right;"><?php echo $rowget['disc_per'];?></td>
                                <td style="text-align:right;"><?php echo $rowget['tax'];  ?></td>
                                <td style="text-align:right;"><?php echo $total;  ?></td>
                                <td class="left"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $saledetail_id; ?>');"> X </a>  / &nbsp; <a class='btn btn-small btn-info'  title="Edit" onclick="updaterecord('<?php echo $prodname; ?>','<?php echo $productid; ?>','<?php echo $unit_name; ?>','<?php echo $unitid; ?>','<?php echo $rate; ?>','<?php echo $qty; ?>','<?php echo $rowget['disc_per']; ?>','<?php echo $rowget['tax']; ?>','<?php echo $total; ?>','<?php echo $saledetail_id; ?>');"><span class="icon-edit"></span></a></td>
                          </tr>
                      <?php
					$amount += $total;			 	
          $sn++;
         // echo $amount;
          }
          ?>    
            <tr>
               <td colspan="8" align="right" style="text-align:right;"><h5>Total :
               <input type="text" id="tot_amt" value="<?php echo number_format($amount,2); ?>" style= "width:70px; border:none; font-weight:bold; text-align:right;" readonly="readonly"  />
                <input type="hidden" id="hidtot_amt" value="<?php echo $amount; ?>" style= "width:70px; border:none; font-weight:bold;" readonly="readonly"  /> </h5> </td>
                <td>&nbsp;</td>
            </tr> 
            <tr>
               <td colspan="8" align="right" style="text-align:right;"><h5>Net Total  :
               <input type="text" id="netamt" value="<?php echo $net_total_amt; ?>" style= "width:70px; border:none; font-weight:bold;text-align:right;" readonly="readonly"  />
                </h5> </td>
                <td>&nbsp;</td>
            </tr>                                               
            <tr>
               <td colspan="12"><p align="center"> <input type="submit" class="btn btn-primary" value="Save" name="submit"  >  &nbsp; &nbsp; 
               <input type="hidden" name="saleid" value="<?php echo $saleid; ?>"  />
               <a href="saleentry.php" class="btn btn-danger" > Reset </a>
            </p></td>
            </tr>                                          
        </tbody>
        </table>
