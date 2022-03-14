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
											
											$i = 0;											
											$sqlgetincome=mysqli_query($connection,"select suppartyid,paydate,payamt,payid from payment where payment_type !='CASH' and pay_mode='received' $cond and paydate between '$fromdate' and '$todate' order by paydate");
											while($rowgetincome=mysqli_fetch_array($sqlgetincome))
											{
												
												$inncome_arr[] = $rowgetincome;
												$i++;
												
												
											}
												
								
										$j = 0;
											$sqlgetincome=mysqli_query($connection,"select expencetypeid,incom_date,amount,incomid from other_income where payment_type !='CASH' $cond  and incom_date between '$fromdate' and '$todate' order by  incom_date ");
											while($rowgetincome=mysqli_fetch_array($sqlgetincome))
											{	
													$inncome_arr[]=$rowgetincome;
													
												$j++;
												
											}
										
											//print_r($inncome_arr[0]);	
											?>
                                            	     
                                            <?php
										$k = 0;
											$sqlgetdep=mysqli_query($connection,"select bankid,contra_date,amount,bank_contra_id from bank_contra_entry where  contra_date  between '$fromdate' and '$todate' order by contra_date");
											while($rowgetdep=mysqli_fetch_array($sqlgetdep))
											{	$inncome_arr[]= $rowgetdep;
													
												$k++;
											}
											
											//echo $inncome_arr[0]['bank_contra_id'];
																		
							
							
							//$abc=array_merge($inncome_arr,$dep_arr);
							
							
							//echo count($inncome_arr); die;
							
							if(!empty($inncome_arr))
							{
							
							$rowgetincome[] =	 array_merge($inncome_arr);
							
							
									
										function date_compare($a, $b)
										{
										$t1 = strtotime($a['1']);
										$t2 = strtotime($b['1']);
										return $t1 - $t2;
										} 
									usort($rowgetincome[0], 'date_compare');
									
										 $nettotalincome=0; 
										  for($i=0; $i< count($rowgetincome[0]); $i++)
										  {	
									   $incomid=$rowgetincome[0][$i]['incomid'];
										  
										 
										  if($rowgetincome[0][$i]['incomid']!="")
										  {
											 $supp_name=strtoupper($cmn->getvalfield($connection,"other_income","receivedfrom","incomid='$incomid'"));
											 $expencetypeid =$cmn->getvalfield($connection,"other_income","expencetypeid","incomid='$incomid'");
											 $heding=$cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$expencetypeid'");
										  }
										  else if($rowgetincome[0][$i]['bank_contra_id']!="")
										  {
											  $bank_contra_id=$rowgetincome[0][$i]['bank_contra_id'];
											  $bankid=$cmn->getvalfield($connection,"bank_contra_entry","bankid","bank_contra_id='$bank_contra_id'");
											  $supp_name=$cmn->getvalfield($connection,"m_bank","bank_name","bankid='$bankid'");
											  $heding="Deposite ";
										  }
										  
											?>
                                         <tr>   
                                          <td> <?php echo $heding; ?></td>
                                          <td><?php echo $supp_name; ?></td>
                                          <td><?php echo $cmn->dateformatindia($rowgetincome[0][$i][1]); ?></td>
                                          <td style="text-align:right;"><?php echo number_format($rowgetincome[0][$i][2],2); ?></td>  
                                           </tr> 
                                           <?php 
										   $nettotalincome += $rowgetincome[0][$i][2];
										  }
										  
							}
										   
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
											
											$sqlgetincome=mysqli_query($connection,"select suppartyid,paydate,payamt,payid from payment where payment_type !='CASH' $cond  and pay_mode='paidtosupp' and paydate between '$fromdate' and '$todate' order by paydate");
											while($rowgetincome=mysqli_fetch_array($sqlgetincome))
											{
										
											$expense_arr[]= $rowgetincome;
											}
											?>
                                            
                                            
                                            
                                              <?php
											$totamt=0;
											$sqlgetincome=mysqli_query($connection,"select expencetypeid,expen_date,amount,expenid from other_expense where payment_type !='CASH'  $cond  and expen_date between '$fromdate' and '$todate' order by expen_date");
											while($rowgetincome=mysqli_fetch_array($sqlgetincome))
											{
																								
													$expense_arr[]= $rowgetincome;
											}
											
											if(!empty($expense_arr))
							{
											
										$rowgetexpense[] =	 array_merge($expense_arr);											
										usort($rowgetexpense[0], 'date_compare');
										 $nettotalexpense=0; 
										 
										  for($i=0; $i< count($rowgetexpense[0]); $i++)
										  {	
										  
									   $expenid=$rowgetexpense[0][$i]['expenid'];
										  
										 
										  if($rowgetexpense[0][$i]['expenid']!="")
										  {
											 $supp_name=strtoupper($cmn->getvalfield($connection,"other_expense","payto","expenid='$expenid'"));
											 $heding="Other Expenses";
										  }
										  else if($rowgetexpense[0][$i]['payid']!="")
										  {
											  $payid=$rowgetexpense[0][$i]['payid'];
											   $suppartyid=$cmn->getvalfield($connection,"payment","suppartyid","payid='$payid'");
											  $supp_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
											  $heding="Supp. Payment";
										  }
										  
									
											?>
                                            <tr>
                                            
                                            	<td><?php echo $heding; ?></td>
                                                <td><?php echo $supp_name; ?></td>
                                                <td><?php echo $cmn->dateformatindia($rowgetexpense[0][$i][1]); ?></td>
                                               <td style="text-align:right;"><?php echo number_format($rowgetexpense[0][$i][2],2); ?></td>  
                                            </tr>
                                            
                                            <?php 
											
											$nettotalexpense +=$rowgetexpense[0][$i][2];
											
										  }
												  }
											
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