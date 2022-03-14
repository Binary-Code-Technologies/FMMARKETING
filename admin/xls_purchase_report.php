<?php    include("../adminsession.php");

if(isset($_GET['fromdate'])!="" && isset($_GET['todate'])!="")
{
	$fromdate = addslashes(trim($_GET['fromdate']));
	$todate = addslashes(trim($_GET['todate']));
}
else
{
	$fromdate = date('Y-m-d');
	$todate = date('Y-m-d');
}

$crit = " where 1 = 1 ";
if($fromdate!="" && $todate!="")
{

	$crit .= " and purchasedate between '$fromdate' and '$todate'";
}	


if(isset($_GET['productid']))
{
	$productid = trim(addslashes($_GET['productid']));
	
	if($productid !='') { $crit .=" and B.productid='$productid' ";  }
}
else
{
	$productid= '';	
}


if(isset($_GET['suppartyid']))
{
	$suppartyid = trim(addslashes($_GET['suppartyid']));	
	
	if($suppartyid !='')  { $crit .=" and A.suppartyid='$suppartyid' "; }
}
else
{
	$suppartyid= '';
}

if(isset($_GET['billno']))
{
	$billno = trim(addslashes($_GET['billno']));
	if($billno !='') {  $crit .= " and billno like '%$billno%'"; }
}
else
$billno='';

$enddate = date("t", strtotime($fromdate));
// The function header by sending raw excel
	header("Content-type: application/vnd-ms-excel");
	$filename ="truckownerreport.xls";
	// Defines the name of the export file "codelution-export.xls"
	header("Content-Disposition: attachment; filename=".$filename);



?>


<table class="table table-hover table-nomargin table-bordered" border="1">
									<thead>
                                    
								<tr>                                               
                                         <th width="5%" class="head0 nosort">S.No.</th>
                            <th width="24%" class="head0" >Product Name</th>
                            <th width="9%" class="head0" >Unit </th>
                            <th width="8%" class="head0" >Qty </th>
                            <th width="9%" class="head0" >Rate </th>                            
                            <th width="10%" class="head0" >Purchase No</th>
                            <th width="11%" class="head0">Purchase Date</th>                           
                            <th width="9%" class="head0" >Amount</th>
                            <th width="15%" class="head0" >Customer Name</th>                                                  					 								</tr>
									</thead>
                                    <tbody>
                                  <?php
									$slno=1;
									$totpur=0;
									$nettotal=0;
										$sql_get = mysqli_query($connection,"Select suppartyid,A.disc,A.packing_charge,A.freight_charge,A.purchaseid,
	B.productid,unitid,qty,rate,billno,purchasedate	from purchaseentry as A right join purchasentry_detail as B on A.purchaseid=B.purchaseid $crit order by purchasedate desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid = $row_get['suppartyid'];
										$disc =$row_get['disc'];
										$packing_charge =$row_get['packing_charge'];
										$freight_charge =$row_get['freight_charge'];
										$productid =$row_get['productid'];
										$unitid =$row_get['unitid'];
										$freight_tax=0;
										
										$prodname = $cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
										$unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
										
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										//$total = $cmn->getTotalPerchaseBillAmt($connection,$row_get['purchaseid']);	
										//$gst = $cmn->getTotalGst_pur($connection,$row_get['purchaseid']);
										
										$total =$row_get['rate'] * $row_get['qty'];
									
									$nettotal += $total;
									   ?> 
										<tr>
                                                <td><?php echo $slno++; ?></td>                                                 
                                                <td><?php echo $prodname; ?></td>
                                                <td><?php echo $unit_name; ?></td>
                                                <td><?php echo $row_get['qty']; ?></td>
                                                <td><?php echo $row_get['rate']; ?></td>                                                
                                                <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['purchasedate']); ?></td>
                                                <td style="text-align:right;"><?php echo number_format($total,2); ?></td>
                                                <td><?php echo $supparty_name; ?></td>
										</tr>
                                       <?php
										$slno++;										
									}
									?>
                                    
                                     <tr style="background-color:#03C; color:#FFF;">
                                                <td> </td>                                                 
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td></td>                                                
                                                <td> </td>
                                                <td> </td>
                                                <td style="text-align:right;"><strong><?php echo number_format($nettotal,2); ?></strong></td>
                                                <td></td>                                                  
                        			</tr>
										
									</tbody>                                    
									</tbody>
							</table>
                            

                
                            
                            


<script>window.close();</script>