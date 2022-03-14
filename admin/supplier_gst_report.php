<?php error_reporting(0);                                                                                                   include("../adminsession.php");

$pagename = 'supplier_gst_report.php';
$pageheading = "Supplier GST Report";
$mainheading = "Supplier GST Report";

 $prefix = $cmn ->getvalfield($connection,"company_details","prefix","1=1"); 

$cond = " where 1=1 ";
if(isset($_GET['suppartyid']))
{
	$suppartyid = test_input($_GET['suppartyid']);
	$todate=test_input($cmn->dateformatusa($_GET['todate']));
	$fromdate=test_input($cmn->dateformatusa($_GET['fromdate']));	
}
else
{
	$todate=date('Y-m-d');	
	$fromdate=date('Y-m-d');	
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
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
       
       
                <!-- Main content -->
				
								<form action="" method="Get">
                               
                                    <table width="100%" align="center" >
                                   
                                    	 
										<tr>
                                        	
                                        	
                                             <td width="7%" align="right"><strong>From Date :</strong></td>
                                             
                                             <td width="10%">                                        	
                                             <input type="text" name="fromdate" id="fromdate" placeholder="dd-mm-yyyy" value="<?php echo dateformatindia($fromdate);?>" >                                    
                                             </td>
                                             
                                             
                                              <td width="6%" align="right"><strong>To Date :</strong></td>
                                             
                                             <td width="11%">                                        	
                                             <input type="text" name="todate" id="todate" placeholder="dd-mm-yyyy" value="<?php echo dateformatindia($todate);?>" >                                    
                                             </td>
                                             
                                             <td width="10%" align="right"><strong>Supplier Name : </strong></td>
                                                                                            
                                              <td width="6%">
                                        	
                                            <select id="suppartyid" name="suppartyid">
                                        	<option value="">-Select-</option>
                                            <?php 
											$sql2 = "select * from  m_supplier_party where type_supparty='supplier' order by supparty_name asc";
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
                                          
                                         <td width="50%">
                                       
										 <input type="submit"  name="submit" id="submit" onClick="function chkdate();" value="Search"  >
                                         
										 <input type="button"  onclick="document.location='<?php echo $pagename; ?>'"  name="reset_dept" value="Reset" >
                                         
                                         
                                         </td>
                                       </tr>
                                    </table>
								</form>	
                               
                           
                            <?php
							if($suppartyid != 0)
							{?>
					
                            <!-- /.box -->
                            
                          <table border="0" width="100%" align="left">
                          <tr>
                          <td colspan="2" align="center"><hr><strong>Supplier GST Purchase Report</strong><hr></td>
                          
                          </tr>
                          		
                                </table>
                          
                          <br>
                          <p align="right"style="margin-top:7px; margin-right:10px;"><a href="suppiler_gst_report_excel.php?fromdate=<?php  echo $fromdate;?>&todate=<?php  echo $todate;?>&suppartyid=<?php echo $suppartyid;?>" class="btn btn-info" target="_blank"><span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print Excel</span>
</a> </p>
                          
                        <div>      
                        <div style="width:100%">
                           
                            
                                                           
                               
                                    <table width="150%" style="border:1px;">
                                        <thead>
                                         <tr>
                                        	<th colspan="4" align="center"><strong>Supplier Name : <?php echo $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'"); ?> </strong></th>
                                        </tr>
                                            <tr>
                                                <th >Date </th>
                                                <th >Supplier Name</th>
                                                <th >Sale Tax No</th>
                                                
                                                <th>Purchase 5 %</th>
                                                <th>CGST 2.5%</th>
                                                <th>SGST 2.5%</th>
                                                
                                                 <th>Purchase 12 %</th>
                                               <th>CGST 6%</th>
                                                <th>SGST 6%</th>
                                                
                                                 <th>Purchase 18 %</th>
                                                <th>CGST 9%</th>
                                                <th>SGST 9%</th>
                                                
                                                 <th>Purchase 28 %</th>
                                                <th>CGST 14%</th>
                                                <th>SGST 14%</th>
                                                
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$totalval5=0;
											$totaltaxval5=0;
											$totalval12=0;
											$totaltaxval12=0;
											$totalval18=0;
											$totaltaxval18=0;
											$totalval28=0;
											$totaltaxval28=0;
											 $sql_table = "select * from process_purchase where suppartyid='$suppartyid' && billdate between '$fromdate' and '$todate' order by billdate desc"; 
											$res_table = mysqli_query($connection,$sql_table);
											while($row_table = mysqli_fetch_array($res_table))
											{
												$supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$row_table[suppartyid]'");
												$purchaseid = $row_table['purchaseid'];
												$suppartyid = $row_table['suppartyid'];
												$totav_val5=0;
												$totav_val12=0;
												$totav_val18=0;
												$totav_val28=0;
												$tottaxablevalue5=0;
												$tottaxablevalue12=0;
												$tottaxablevalue18=0;
												$tottaxablevalue28=0;
												
											$totav_val5=$cmn->gettotalvaluewithouttax_pur('purchased_product','purchaseid',$purchaseid,'5');
											$totav_val12=$cmn->gettotalvaluewithouttax_pur('purchased_product','purchaseid',$purchaseid,'12');
											$totav_val18=$cmn->gettotalvaluewithouttax_pur('purchased_product','purchaseid',$purchaseid,'18');
											$totav_val28=$cmn->gettotalvaluewithouttax_pur('purchased_product','purchaseid',$purchaseid,'28');
											$tottaxablevalue5=$cmn->nettotaltax_purgst('purchased_product','purchaseid',$purchaseid,'5');
											$tottaxablevalue12=$cmn->nettotaltax_purgst('purchased_product','purchaseid',$purchaseid,'12');
											$tottaxablevalue18=$cmn->nettotaltax_purgst('purchased_product','purchaseid',$purchaseid,'18');
											$tottaxablevalue28=$cmn->nettotaltax_purgst('purchased_product','purchaseid',$purchaseid,'28');
														
											?>
                                            	<tr>
                                                    <td><?php echo $cmn->dateformatindia($row_table['billdate']); ?></td>
                                                    <td><?php echo $supparty_name; ?></td>
                                                    <td><?php echo $paydate; ?></td>                                                    
                                                                                                     
                                                     <td><?php echo number_format($totav_val5,2); ?></td>
                                                    <td><?php echo number_format($tottaxablevalue5/2,2); ?></td>
                                                   <td><?php echo number_format($tottaxablevalue5/2,2); ?></td>                                                   
                                                   
                                                    
                                                     <td><?php echo number_format($totav_val12,2); ?></td>
                                                    <td><?php echo number_format($tottaxablevalue12/2,2); ?></td>
                                                    <td><?php echo number_format($tottaxablevalue12/2,2); ?></td>                                                   
                                                   
                                                    
                                                     <td><?php echo number_format($totav_val18,2); ?></td>
                                                   <td><?php echo number_format($tottaxablevalue18/2,2); ?></td>
                                                     <td><?php echo number_format($tottaxablevalue18/2,2); ?></td>                                                  
                                                   
                                                    
                                                      <td><?php echo number_format($totav_val28,2); ?></td>
                                                   <td><?php echo number_format($tottaxablevalue28/2,2); ?></td>
                                                   <td><?php echo number_format($tottaxablevalue28/2,2); ?></td>                                                
                                                                                                     
                                                </tr>
                                            
                                            <?php
											
											$totalval5+=$totav_val5;
											$totaltaxval5+=$tottaxablevalue5;
											
											$totalval12+=$totav_val12;
											$totaltaxval12+=$tottaxablevalue12;
											
											$totalval18+=$totav_val18;
											$totaltaxval18+=$tottaxablevalue18;
											
											$totalval28+=$totav_val28;
											$totaltaxval28+=$tottaxablevalue28;
											
											
											}
											
                                          ?>
                                       
                                        </tbody>
                                        <tfoot bgcolor="#CCCCCC">
                                           <tr>
                                                <th>&nbsp;</th>                                                   
                                                <th>Total</th>
                                                <th>&nbsp;</th>
                                                <th><?php echo number_format($totalval5,2); ?></th>
                                                <th><?php echo number_format($totaltaxval5/2,2); ?></th>
                                                <th><?php echo number_format($totaltaxval5/2,2); ?></th>  
                                                
                                                <th><?php echo number_format($totalval12,2); ?></th>
                                                <th><?php echo number_format($totaltaxval12/2,2); ?></th>
                                                <th><?php echo number_format($totaltaxval12/2,2); ?></th>   
                                                
                                                <th><?php echo number_format($totalval18,2); ?></th>
                                                <th><?php echo number_format($totaltaxval18/2,2); ?></th>
                                                <th><?php echo number_format($totaltaxval18/2,2); ?></th>   
                                                
                                                <th><?php echo number_format($totalval28,2); ?></th>
                                                <th><?php echo number_format($totaltaxval28/2,2); ?></th>
                                                <th><?php echo number_format($totaltaxval28/2,2); ?></th>                                               
                                              
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                   
                              
                        </div>
                        
                   		</div>
                    
                  
                    <?php
							}
							?>
                   
<script>
function chkdate()
{
	var todate=document.getElementById('todate').value;
	var fromdate=document.getElementById('fromdate').value;
	var suppartyid=document.getElementById('suppartyid').value;
	//alert(todate);
	
	if(!isNaN(fromdate) && fromdate=='')
	{
		alert('Please select from date');
	}
	
	if(!isNaN(todate) && todate=='')
	{
		alert('Please select to date');
	}
	
	
	if(!isNaN(suppartyid) && suppartyid=='')
	{
		alert('Please select Supplier Name');
	}
}
</script>            
      
    
    </body>
</html>