<?php error_reporting(0); 
include("../adminsession.php");
$pagename = 'customer_ledger.php';
$pageheading = "Customer Transaction Detail";
$mainheading = "Customer Transaction Detail";


$cond = "  1=1 ";
$crit=" 1=1 ";
if(isset($_GET['suppartyid']))
{
	$suppartyid = $_GET['suppartyid'];
	
}
if(isset($_GET['fromdate']) && isset($_GET['todate']))
{
	$fromdate = $_GET['fromdate'];
	$todate = $_GET['todate'];
	if($fromdate != "" && $todate != "")
	{
		$fromdate = $cmn->dateformatusa($fromdate);
		$todate = $cmn->dateformatusa($todate);
		$cond .= " and saledate between '$fromdate' and '$todate' ";
		$crit .= " and paydate between '$fromdate' and '$todate' ";
	}
}
else
{
	$fromdate=date('Y-m-d');
	$todate=date('Y-m-d');
}

?>

<!DOCTYPE html>
<html>
    <head>
   <title>Customer Payment Details</title>     
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
				
								<form action="" method="Get" onSubmit="return checkinputmaster('suppartyid');">
                               
                                    <table width="88%" align="center">
                                   
                                    	 
										<tr>
                                        
                                          <td width="11%" align="right"><strong>From Date: </strong></td>                                              
                                    <td width="16%"><input type="text" name="fromdate" id="fromdate" value="<?php echo $cmn->dateformatindia($fromdate); ?>" placeholder="dd-mm-yyyy" ></td>
                                    
                                    <td width="8%" align="right"><strong>To Date : </strong></td>                                              
                                    <td width="16%">
                                     <input type="text" name="todate" id="todate" value="<?php echo $cmn->dateformatindia($todate); ?>" placeholder="dd-mm-yyyy" >
                                 
                                    
</td>
                                        	
                                              <td width="13%" align="right"><strong>Customer Name : </strong></td><td width="10%">
                                        	
                                            <select id="suppartyid" name="suppartyid"  >
                                        	<option value="">-Select-</option>
                                            <?php 
											$sql2 = "select * from  m_supplier_party where type_supparty ='party' order by supparty_name";
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
                             <?php  $prevbalance =  $cmn->getoldcustbal($connection,$fromdate,$suppartyid); ?>
                          <table border="0" width="100%" align="left">
                          <tr>
                          <td colspan="2" align="center"><hr><strong>Customer Transaction Details</strong><hr></td>
                          
                          </tr>
                          		<tr>
                                <td width="34%" colspan="2"><strong>Opening Balance: <i class="fa fa-inr"></i><?php
							 echo number_format($prevbalance,2);?></strong>
                                </td>
                                
                                </tr>
                                </table>
                          
                          <br>
                        <div>      
                        <div style="float:left; width:49%">
                           
                            
                                                           
                               
                                    <table border="1" width="100%">
                                        <thead>
                                         <tr>
                                        	<th colspan="6" align="center"><strong> Customer Purchase</strong></th>
                                        </tr>
                                            <tr>
                                                <th width="16%">S No</th>
                                                <th width="15%">Bill No</th>                                                
                                                <th width="15%">Date</th>                                                
                                                <th width="21%">Bill Amt</th>
                                                 <th width="21%">Return Amt</th>
                                                   <th width="21%">Total Amt</th>
                                                
                                               	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$netwt = 0;
											$subtotal=0;
									
								$sql_table = "select * from saleentry where  $cond and suppartyid='$suppartyid' order by saledate desc";
											$res_table = mysqli_query($connection,$sql_table);
											while($row_table = mysqli_fetch_array($res_table))
											{
												$netamt =0;
												$saleid=$row_table['saleid'];							   					
												$disc =$row_table['disc'];
												$saledate =$row_table['saledate'];
												$totalsale =$row_table['totalsale'];
												$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
												$total = $cmn->getTotalBillAmt($connection,$row_table['saleid']);
												$igst = $cmn->getTotalIgst_Sale($connection,$row_table['saleid']);
												$gst = $cmn->getTotalGst($connection,$row_table['saleid']);
											//	$total = $total - $disc;
													$return_amt = $cmn->getvalfield($connection,"salereturn","sum(return_amt)","saleid='$saleid'");
											 	$netamt= $totalsale;
											?>
                                            	<tr>
                                                    <td><?php echo ++$slno; ?></td>
                                                    <td><?php echo $row_table['billno']; ?></td>
                                                    <td><?php echo $cmn->dateformatindia($saledate); ?></td>
                                                    
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($netamt,2); ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($return_amt,2); ?></td>
                                                      <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($netamt-$return_amt,2); ?></td>
                                                   
                                                </tr>
                                            
                                            <?php
											$subtotal +=$netamt-$return_amt;
											
											}
											?>
                                            
                                       
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                                <th>&nbsp;</th>
                                               
                                                 <th>&nbsp;</th> 
                                                   <th>&nbsp;</th> 
                                                     <th>&nbsp;</th>  
                                                <th  style="text-align:right">Total</th>
                                               
                                                <th  style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format(round($subtotal),2); ?></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                   
                              
                        </div>
                        <div style="float:right; width:49%">
                            
                                                         
                               
                                    <table border="1" width="100%">
                                  
                                        <thead>
                                        <tr>
                                        	<th colspan="3" align="center"><strong> Customer Payments</strong></th>
                                        </tr>
                                            <tr>
                                                <th width="19%">S No</th>
                                               <th width="32%">Paid Date</th>
                                                <th width="49%">Paid Amt</th>
                                               	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$slno =0;
											$netpayamt = 0;
											$sql_table = "select * from payment where $crit and suppartyid = '$suppartyid' and pay_mode='received' order by payid desc";
											$res_table = mysqli_query($connection,$sql_table);
											while($row_table = mysqli_fetch_array($res_table))
											{
												$paydate = $cmn->dateformatindia($row_table['paydate']);
												$netpayamt += $row_table['payamt'];
												
											?>
                                            	<tr>
                                                    <td><?php echo ++$slno; ?></td>
                                                    <td><?php echo $paydate; ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($row_table['payamt'],2); ?></td>
                                                   
                                                </tr>
                                            
                                            <?php
											}
											?>
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                                 <th>&nbsp;</th>
                                                <th style="text-align:right">Total</th>
                                                <th style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format(round($netpayamt),2); ?></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                            
                        </div>
                   		</div>
                    
                    <?php $balamt = $prevbalance + $subtotal - $netpayamt; 
					 ?>
                    <div style="border:1px solid">
                   <hr>
                    	<table width="100%" border="0" >
                        	<tr>
                           
                            <td  align="left"  style="font-size:14px">&nbsp;
                             </td>
                            	<td align="right"  style="font-size:14px"><strong>Balance Amt : <i class="fa fa-inr"></i> <?php echo number_format(round($balamt - $totdiscount),2); ?></strong></td>
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