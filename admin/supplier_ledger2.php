<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = 'supplier_ledger.php';
$pageheading = "Supplier Transaction Detail";
$mainheading = "Supplier Transaction Detail";

$cond = " and 1=1 ";
if(isset($_GET['suppartyid']))
{
	$suppartyid = test_input($_GET['suppartyid']);
	
}
if(isset($_GET['fromdate']) && isset($_GET['todate']))
{
	$fromdate = test_input($_GET['fromdate']);
	$todate = test_input($_GET['todate']);
	if($fromdate != "" && $todate != "")
	{
	   $fromdate = $cmn->dateformatusa($fromdate);
	    $todate = $cmn->dateformatusa($todate);
		$cond .= " and purchasedate between '$fromdate' and '$todate' ";
		$crit .= "and  paydate between '$fromdate' and '$todate'" ; 

    }
}
else
{
	$fromdate=date('Y-m-d');
	$todate=date('Y-m-d');
}

 //$prevbalance = $cmn->getsupplieropeningbalance($fromdate,$suppartyid);
 
?>
<!DOCTYPE html>
<html>
    <head>
   <title>Supplier Payment Details</title>     
<style>
table{
	/*//border-collapse:collapse;*/
}
</style>
 <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script src="../js/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="../js/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="../js/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    </head>
    <body>
       
       
                <!-- Main content -->
				
								<form action="" method="Get" onSubmit="return checkinputmaster('supplierid');">
                               
                                    <table width="88%" align="center">
                                   
                                    	 
										<tr>
                                        
                                          <td width="11%" align="right"><strong>From Date: </strong></td>                                              
                                    <td width="16%"><input type="text" name="fromdate" id="fromdate" value="<?php echo $cmn->dateformatindia($fromdate); ?>" placeholder="dd-mm-yyyy" ></td>
                                    
                                    <td width="8%" align="right"><strong>To Date : </strong></td>                                              
                                    <td width="16%">
                                     <input type="text" name="todate" id="todate" value="<?php echo $cmn->dateformatindia($todate); ?>" placeholder="dd-mm-yyyy" >
                                 
                                    
</td>
                                        	
                                              <td width="13%" align="right"><strong>Supplier Name : </strong></td><td width="10%">
                                        	
                                            <select id="suppartyid" name="suppartyid"  >
                                        	<option value="">-Select-</option>
                                            <?php 
											$sql2 = "select * from  m_supplier_party where type_supparty ='supplier'";
											$res2 = mysqli_query($connection,$sql2);
											while($row2 = mysqli_fetch_array($res2))
												{
											?>
                                          			<option value="<?php echo $row2['suppartyid']; ?>"><?php echo $row2['supparty_name']; ?></option>
                                            <?php
												}
												?>
                                          	
                                      </select>
                                      <script>document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>';</script>
                                            
                                            </td>
                                      
                                        	
                                          
                                         <td width="26%">
                                       
										 <input type="submit" name="submit"  value="Search"  >
                                         
										 <input type="button"  onclick="document.location='<?php echo $pagename; ?>'"  name="reset_dept" value="Reset" >
                                         
                                         
                                         </td>
                                       </tr>
                                    </table>
								</form>	
                               
                           
                            <?php
							if($suppartyid != 0)
							{?>
					
                               
                    
                    
                    
                            <!-- /.box -->
                             <?php $prevbalance = $cmn->getsupplieropeningbalance($fromdate,$suppartyid); ?>
                          <table border="0" width="100%" align="left">
                          <tr>
                          <td colspan="2" align="center"><hr><strong>Supplier Payment Details</strong><hr></td>
                          
                          </tr>
                          		<tr>
                                <td width="34%" colspan="2"><strong>Opening Balance: <i class="fa fa-inr"></i><?php
							 echo number_format($prevbalance,2);?></strong>
                                </td>
                                
                                </tr>
                                </table>
                          
                          <br>
                        <div>      
                        <div style="float:left; width:40%">
                           
                            
                                                           
                               
                                    <table border="1" width="100%">
                                        <thead>
                                         <tr>
                                        	<th colspan="5" align="center"><strong> Supplier Purchase</strong></th>
                                        </tr>
                                            <tr>
                                                <th>S No</th>
                                                <th>Bill No</th>                                                
                                                <th>Date</th>                                                
                                                <th>Total Amt</th>
                                                 </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$netamt =0;
											$netwt = 0;
											$sql_table = "select * from purchaseentry where suppartyid='$suppartyid' $cond   
											order by purchasedate desc"; 
											$res_table = mysqli_query($connection,$sql_table);
											while($row_table = mysqli_fetch_array($res_table))
											{
												
												
												$purchasedate = $cmn->dateformatindia($row_table['purchasedate']);
												$total=0;
												$gst=0;
												$disc =$row_table['disc'];
												$packing_charge =$row_table['packing_charge'];
												$freight_charge =$row_table['freight_charge'];
												$total = $cmn->getTotalPerchaseBillAmt($connection,$row_table['purchaseid']);	
												$gst = $cmn->getTotalGst_pur($connection,$row_table['purchaseid']);
												$credit_disc=$cmn->getvalfield($connection,"contra_entry","discount"," purchaseid ='$row_table[purchaseid]'");
												$total = $total +$gst - $disc+$packing_charge+$freight_charge;
												
											?>
                                            	<tr>
                                                    <td><?php echo ++$slno; ?></td>
                                                    <td><?php echo $row_table['billno']; ?></td>
                                                   
                                                    <td><?php echo $purchasedate; ?></td>
                                                    
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($total,2); ?></td>
                                                    
                                                   
                                                </tr>
                                            
                                            <?php
										
											$netamt += $total;
											}
											?>
                                            
                                       
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>  
                                                <th  style="text-align:right">Total</th>
                                                <th  style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format($netamt,2); ?></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                   
                              
                        </div>
                        <div style="float:right; width:58%">
                            
                                                         
                               
                                    <table border="1" width="100%">
                                  
                                        <thead>
                                        <tr>
                                        	<th colspan="5" align="center"><strong> Supplier Payments</strong></th>
                                        </tr>
                                            <tr>
                                                <th>S No</th>
                                               <th>Paid Date</th>
                                               
                                               <th>Payment Type</th>
                                               <th>Check No</th>
                                               
                                                <th>Paid Amt</th>
                                               	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$slno =0;
											$netpayamt = 0;
											$sql_table = "select * from payment where suppartyid = '$suppartyid' and pay_mode='paidtosupp' $crit order by paydate desc,payid desc";
											$res_table = mysqli_query($connection,$sql_table);
											while($row_table = mysqli_fetch_array($res_table))
											{
												$paydate = $cmn->dateformatindia($row_table['paydate']);
												$netpayamt += $row_table['payamt'];
												
											?>
                                            	<tr>
                                                    <td><?php echo ++$slno; ?></td>
                                                    <td><?php echo $paydate; ?></td>
                                                    <td><?php echo $row_table['payment_type']; ?></td>
                                                     <td><?php echo $row_table['chequeno']; ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($row_table['payamt'],2); ?></td>
                                                   
                                                </tr>
                                            
                                            <?php
											}
										
											
											?>
                                            
                                             <tr bgcolor="#CCCCCC">
                                               
                                                <th colspan="4" style="text-align:right">Total Payment</th>
                                                <th style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format(round($netpayamt),2); ?></th>
                                               
                                            </tr>
                                            
                                      
                                      <tr>
                                                    <td colspan="5" style="text-align:center;"><strong>Discount</strong></td>
                                                   
                                                   
                                                </tr> 
                                     
                                        <?php
										$tot_disc=0;
										$sql_dis=mysqli_query($connection,"select contra_entry.* from contra_entry left join purchaseentry on contra_entry.purchaseid=purchaseentry.purchaseid where purchaseentry.suppartyid='$suppartyid'");
											while($row_dis=mysqli_fetch_assoc($sql_dis))
											{
												?>
                                            <tr>
                                                    <td> <?php echo ++$slno; ?></td>
                                                    <td><?php echo $cmn->dateformatindia($row_dis['createdate']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($row_dis['discount'],2); ?></td>
                                                   
                                                </tr>    
                                                
                                                
                                                <?php
												$tot_disc +=$row_dis['discount'];
												
												} ?>
                                                  </tbody>
                                            <tfoot bgcolor="#CCCCCC">       
                                           <tr>
                                              
                                                <th  colspan="4" style="text-align:right">Total Discount</th>
                                                <th style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format(round($tot_disc),2); ?></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                            
                        </div>
                   		</div>
                    
                    <?php $balamt = $prevbalance + $netamt - $netpayamt; 
					 ?>
                    <div style="border:1px solid">
                   <hr>
                    	<table width="100%" border="0" >
                        	<tr>
                           
                            <td  align="left"  style="font-size:14px">&nbsp;
                             </td>
                            	<td align="right"  style="font-size:14px"><strong>Balance Amt : <i class="fa fa-inr"></i> <?php echo number_format(round($balamt - $totdiscount-$tot_disc),2); ?></strong></td>
                            </tr>
                        </table>
                   <hr>
                   </div>
                    <?php
							}
							?>
                   

              <script>
		
		 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#fromdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
                jQuery("#todate").inputmask("dd-mm-yyyy", {"placeholder": "mm-dd-yyyy"});
                //Money Euro
                jQuery("[data-mask]").inputmask();
		 });
		</script>
      
    
    </body>
</html>