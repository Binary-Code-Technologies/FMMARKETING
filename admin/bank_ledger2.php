<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = 'bank_ledger.php';
$pageheading = "Bank Ledger Detail";
$mainheading = "Bank Ledger Detail";


$cond=" and 1=1 ";
if(isset($_GET['bankid']))
{
	$bankid = test_input($_GET['bankid']);
	$cond .= " and bankid = '$bankid' ";
}
if(isset($_GET['fromdate']) && isset($_GET['todate']))
{
	$fromdate = test_input($_GET['fromdate']);
	$todate = test_input($_GET['todate']);
	if($fromdate != "" && $todate != "")
	{
		$fromdate = $cmn->dateformatusa($fromdate);
		$todate = $cmn->dateformatusa($todate);
		
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
   <title>Bank Transaction Details</title>   
     
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
				
								<form action="" method="Get" >
                               
                                    <table width="84%" align="center">
					<tr>                                        
                                    <td width="10%" align="right"><strong>From Date: </strong></td>                                              
                                    <td width="17%"><input type="text" name="fromdate" id="fromdate" value="<?php echo $cmn->dateformatindia($fromdate); ?>" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
                                    
                                    <td width="9%" align="right"><strong>To Date : </strong></td>                                              
                                    <td width="17%">
                                     <input type="text" name="todate" id="todate" value="<?php echo $cmn->dateformatindia($todate); ?>" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask >
                                 
                                    
</td>
                                    
                                    
                                    
                                    
                                    <td width="11%" align="right"><strong>Bank Name : </strong></td>                                              
                                    <td width="13%">
                                   
                                    <select id="bankid" name="bankid"  >
                                    <option value="">-Select-</option>
                                    <?php 
									
                                    $sql2 = mysqli_query($connection,"select * from m_bank  order by bank_name");
                                    while($row2 = mysqli_fetch_assoc($sql2))
                                    {
                                    ?>
                                    <option value="<?php echo $row2['bankid']; ?>"><?php echo $row2['bank_name'].' / '.$row2['ac_number']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    
                                    </select>
                                    <script>document.getElementById('bankid').value='<?php echo $bankid; ?>';</script>
                                    
                                    </td>
                                                
                                                
                                          
                                         <td width="23%">
                                       
										 <input type="submit" name="submit"  value="Search"  onClick="checkdata();" >
                                         
										 <input type="button"  onclick="document.location='<?php echo $pagename; ?>'"  name="reset_dept" value="Reset" >
                                         
                                         
                                         </td>
                    </tr>
                                    </table>
		</form>	
                               
                           
                          
					
                            <!-- /.box -->
                             <?php 
						
							 
							 
							 $prevbalance = $cmn->getoldbanktrans($fromdate,$bankid);
							 
							 ?>
                          <table border="0" width="100%" align="left">
                          <tr>
                          <td colspan="2" align="center"><hr><strong>Bank Transaction Details</strong><hr></td>
                          
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
                                        	<th colspan="5" align="center"><strong> Income</strong></th>
                                        </tr>
                                            <tr>
                                                
                                                <th>Heading</th>
                                                <th>Payee Name</th>
                                                <th>Date</th>
                                                
                                                <th>Total Amt</th>
                                               	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$netamt=0;
											$sqlgetincome=mysqli_query($connection,"select * from payment where payment_type !='CASH' and pay_mode='received' $cond and paydate between '$fromdate' and '$todate' order by paydate");
											while($rowgetincome=mysqli_fetch_assoc($sqlgetincome))
											{
												$payamt=0;
												$suppartyid=$rowgetincome['suppartyid'];
												$payamt=$rowgetincome['payamt'];
												
												
											?>
                                            	<tr>
                                                    
                                                    <td>Cust. Payment</td>
                                                    <td><?php echo $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'"); ?></td>                <td><?php echo $cmn->dateformatindia($rowgetincome['paydate']);  ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($payamt,2); ?></td>                                                   
                                                </tr>
                                            
                                            <?php
											
											$netamt +=$payamt;
											}
											?>
                                            
                                            
                                            
                                              <?php
											  
										
											$totamt=0;
											
											
											$sqlgetincome=mysqli_query($connection,"select * from other_income where payment_type !='CASH' $cond  and incom_date between '$fromdate' and '$todate' order by  incom_date ");
											while($rowgetincome=mysqli_fetch_assoc($sqlgetincome))
											{
												$amount=0;
												$suppartyid=$rowgetincome['suppartyid'];
												$amount=$rowgetincome['amount'];
												$tax_id=$rowgetincome['tax_id'];												
												$tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
												$amount=($amount * $tax)/100 + $amount;
											
											?>
                                            	<tr>
                                                    
                                                    <td><?php echo $cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$rowgetincome[expencetypeid]'"); ?></td>
                                                    <td><?php echo strtoupper($rowgetincome['receivedfrom']); ?></td>                
                                                    <td><?php echo $cmn->dateformatindia($rowgetincome['incom_date']);  ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($amount,2); ?></td>                                                   
                                                </tr>
                                            
                                            <?php
											
											$totamt +=$amount;
											}
											
										
											?>
                                            
                                            
                                            
                                            
                                            
                                            <?php
											$totdepamt=0;
											$sqlgetdep=mysqli_query($connection,"select * from bank_contra_entry where  contra_date  between '$fromdate' and '$todate' order by contra_date");
											while($rowgetdep=mysqli_fetch_assoc($sqlgetdep))
											{
												$amount=0;
												$bankid=$rowgetdep['bankid'];
												$amount=$rowgetdep['amount'];
												$contra_date =$rowgetdep['contra_date'];												
												
												
											?>
                                            	<tr>
                                                    
                                                    <td>Deposite</td>
                                         <td><?php echo strtoupper($cmn->getvalfield($connection,"m_bank","bank_name","bankid='$bankid'")); ?></td>                
                                                    <td><?php echo $cmn->dateformatindia($rowgetdep['contra_date']);  ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($amount,2); ?></td>                                                   
                                                </tr>
                                            
                                            <?php
											
											$totdepamt +=$amount;
											}
											
											$nettotalincome=$netamt+$totamt +$totdepamt;
											?>
                                            
                                       
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                            
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th>  
                                                <th  style="text-align:right">Total</th>
                                               
                                                <th  style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format($nettotalincome,2); ?></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                   
                              
                        </div>
                        <div style="float:right; width:49%">
                            
                                                         
                               
                                    <table border="1" width="100%">
                                  
                                        <thead>
                                        <tr>
                                        	<th colspan="4" align="center"><strong> Expense</strong></th>
                                        </tr>
                                            <tr>
                                                <th>Heading</th>
                                                <th>Payee Name</th>
                                               <th>Date</th>
                                                <th>Paid Amt</th>
                                               	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$netamt=0;
											$slno=0;
											$sqlgetincome=mysqli_query($connection,"select * from payment where payment_type !='CASH' $cond  and pay_mode='paidtosupp' and paydate between '$fromdate' and '$todate' order by paydate");
											while($rowgetincome=mysqli_fetch_assoc($sqlgetincome))
											{
												$payamt=0;
												$suppartyid=$rowgetincome['suppartyid'];
												$payamt=$rowgetincome['payamt'];
												
											?>
                                            	<tr>
                                                    <td>Supp. Payment</td>
                                                   
                                                    <td><?php echo $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'"); ?></td>                <td><?php echo $cmn->dateformatindia($rowgetincome['paydate']);  ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($payamt,2); ?></td>                                                   
                                                </tr>
                                            
                                            <?php
											
											$netamt +=$payamt;
											}
											?>
                                            
                                            
                                            
                                              <?php
											$totamt=0;
											$sqlgetincome=mysqli_query($connection,"select * from other_expense where payment_type !='CASH'  $cond  and expen_date between '$fromdate' and '$todate' order by expen_date");
											while($rowgetincome=mysqli_fetch_assoc($sqlgetincome))
											{
												$amount=0;
												$amount=$rowgetincome['amount'];
												
												$tax_id=$rowgetincome['tax_id'];												
												$tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
												$amount=($amount * $tax)/100 + $amount;
												
											?>
                                            	<tr>
                                                    
                                                    <td ><?php echo $cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$rowgetincome[expencetypeid]'"); ?></td>
                                                    <td><?php echo strtoupper($rowgetincome['payto']); ?></td>                
                                                    <td><?php echo $cmn->dateformatindia($rowgetincome['expen_date']);  ?></td>
                                                    <td align="right"><i class="fa fa-inr"></i> <?php echo number_format($amount,2); ?></td>                                                   
                                                </tr>
                                            
                                            <?php
											
											$totamt +=$amount;
											}
											
											$nettotalexpense=$netamt + $totamt;
											?>
                                            
                                       
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                <th style="text-align:right">Total</th>
                                                <th style="text-align:right"><i class="fa fa-inr"></i> <?php echo number_format(round($nettotalexpense),2); ?></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                            
                        </div>
                   		</div>
                    
                    <?php $balamt = $prevbalance + $nettotalincome - $nettotalexpense; 
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
                 
                   
<script>
function checkdata()
{
	var bankid=document.getElementById('bankid').value;	
	
	if(bankid=='')
	{
		alert('Plz Select Bank Name');
		document.getElementById('bankid').focus();
		return false;
		
	}	
	
}
</script>
             
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