<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = 'gst_wise_purchase_report.php';
$pageheading = "GST Wise Purchase Report";
$mainheading = "GST Wise Purchase Report";

$cond = " and 1=1 ";

if(isset($_GET['fromdate']) && isset($_GET['todate']))
{
	$fromdate = test_input($_GET['fromdate']);
	$todate = test_input($_GET['todate']);
}
else
{
	$fromdate=date('d-m-Y');
	$todate=date('d-m-Y');
}

	if($fromdate != "" && $todate != "")
	{
	   $fromdate = $cmn->dateformatusa($fromdate);
	    $todate = $cmn->dateformatusa($todate);
		$cond .= " and purchasedate between '$fromdate' and '$todate' ";
    } 
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
                                        
                                          <td width="10%" align="right"><strong>From Date: </strong></td>                                              
                                    <td width="16%"><input type="text" name="fromdate" id="fromdate" value="<?php echo $cmn->dateformatindia($fromdate); ?>" placeholder="dd-mm-yyyy" ></td>
                                    
                                    <td width="8%" align="right"><strong>To Date : </strong></td>                                              
                                    <td width="16%">
                                     <input type="text" name="todate" id="todate" value="<?php echo $cmn->dateformatindia($todate); ?>" placeholder="dd-mm-yyyy" >
                                 
                                    
</td>
                                        	
                                           
                                      
                                        	
                                          
                                         <td width="50%">
                                       
										 <input type="submit" name="submit"  value="Search"  >
                                         
										 <input type="button"  onclick="document.location='<?php echo $pagename; ?>'"  name="reset_dept" value="Reset" >
                                         
                                         
                                         </td>
                                       </tr>
                                    </table>
								</form>	
                               
                           
                            <?php
							if($fromdate != '' && $todate !='')
							{?>
					             
                             <table border="1" width="100%">
                                        <thead>
                                         <tr>
                                        	<th colspan="5" align="center"><strong>Local Purchase</strong></th>
                                        </tr>
                                            <tr>
                                                <th>Place Of Supplier</th>
                                                <th>Rate</th>                                                
                                                <th>Taxable Value</th>                                                
                                                <th>Net Amt</th>
                                                
                                                 </tr>
                                        </thead>
                                        <tbody>
                                            <?php											
											$sql_table = "select tax_id,taxname,tax from m_tax where tax !='0' and tax_cat_id='4' order by tax"; 
											$res_table = mysqli_query($connection,$sql_table);
											while($row_table = mysqli_fetch_assoc($res_table))
											{
														$tax_id = $row_table['tax_id'];
														$taxable_val = $cmn->get_taxable_val_taxwise($tax_id,$fromdate,$todate);						
												
											?>
                                            <tr>
                                                    <td>22</td>
                                                    <td><?php echo $row_table['tax'].' %'; ?></td>
                                                    <td><?php echo $purchasedate; ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format(round($total),2); ?></td>                                   </tr>
                                            
                                            <?php									
											}
											?>
                                            
                                       
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                             
                                                 <th>&nbsp;</th>  
                                                 
                                                <th  style="text-align:right">Total</th>
                                                <th  style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format($netamt,2); ?></th>
                                                 <th  style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format($nnet_disc,2); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                        
                        <br>
						<br>                        
                       	 <table border="0" width="100%" align="left">
                          <tr>
                          <td colspan="2" align="center"><hr><strong>Local Purchase</strong><hr></td>
                          
                          </tr>
                          		
                          </table>
                        <div>
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
                                            
                                      
                                    
                                     
                                    
                                                  </tbody>
                                            
                                    </table>                            
                       
                   		</div>
                    
                    <?php $balamt = $prevbalance + $netamt - $netpayamt; 
					 ?>
                    <div style="border:1px solid">
                   <hr>
                    	<table width="100%" border="0" >
                        	<tr>
                           
                            <td  align="left"  style="font-size:14px">&nbsp;
                             </td>
                            	<td align="right"  style="font-size:14px"><strong>Balance Amt : <i class="fa fa-inr"></i> <?php echo number_format(round($balamt - $totdiscount-$nnet_disc),2); ?></strong></td>
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