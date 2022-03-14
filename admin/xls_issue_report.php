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

	$crit .= " and  B.saledate between '$fromdate' and '$todate'";
}	

if(isset($_GET['receivername']))
{
	$receivername = trim(addslashes($_GET['receivername']));
	
	if($receivername !=''){
		$crit .=" and B.receivername like '%$receivername%'";
		}
}
else
$receivername='';

if(isset($_GET['branch_id']) !='')
{
	$branch_id = trim(addslashes($_GET['branch_id']));
	if($branch_id !='')
	{
	$crit .=" and B.branch_id='$branch_id'";
	}
}

if(isset($_GET['productid']) !='')
{
	$productid = trim(addslashes($_GET['productid']));
	if($productid !='')
	{
	$crit .=" and A.productid='$productid'";
	}
}


if(isset($_GET['pcatid']) !='')
{
	$pcatid = trim(addslashes($_GET['pcatid']));
	if($pcatid !='')
	{
	$crit .=" and C.pcatid='$pcatid'";
	}
}


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
                                               
                                        <th width="4%" class="head0 nosort">SN</th>
                                        <th width="19%" class="head0">Product Name</th>
                                        <th width="8%" class="head0" >Unit</th>
                                        <th width="6%" class="head0" >Qty</th>
                                        <th width="6%" class="head0" >Rate</th>
                                        <th width="8%" class="head0">Issue No</th>
                                        <th width="8%" class="head0">Issue Date</th>
                                        <th width="6%" class="head0">Branch</th>                            
                                        <th width="10%" class="head0" >Recieved By</th>
                                        <th width="20%" class="head0" style="text-align:center;">Remark</th>                                 </tr>
									</thead>
                                    <tbody>
                                  <?php
									$slno=1;
									$totqty=0;
									$nettotal=0;
									$sql_get = mysqli_query($connection,"Select A.productid,A.unitid,qty,B.saleid,branch_id,saledate,billno,receivername,remark from saleentry_detail as A left join saleentry as B on A.saleid=B.saleid left join m_product as C on A.productid=C.productid $crit order by saledate desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
						$rate = $cmn->getvalfield($connection,"purchasentry_detail","rate","productid='$row_get[productid]' order by purchaseid desc");		
						 $total =$rate * $row_get['qty'];									
									$nettotal += $total;
										
									   ?> 
                <tr>
                        <td><?php echo $slno++; ?></td> 
                        <td><?php echo $cmn->getvalfield($connection,"m_product","prodname","productid='$row_get[productid]'"); ?></td>
                        <td><?php echo $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$row_get[unitid]'"); ?></td>
                        <td><?php echo $row_get['qty']; ?></td>
                        <td><?php echo $rate; ?></td>
                        <td><?php echo $row_get['billno']; ?></td>
                        <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td>
                        <td><?php echo $cmn->getvalfield($connection,"m_branch","branch_name","branch_id='$row_get[branch_id]'"); ?></td>         
                        <td><?php echo $row_get['receivername']; ?></td>
                        <td><?php echo $row_get['remark']; ?></td>  
                        <td><?php echo number_format($total,2); ?></td>
                             
                </tr>
                                       <?php									   
									 $totqty += $row_get['qty'];
									 $slno++;										
									}
									?>
                                    
                                    
									
                                    <tr>
                                        <td style="background-color:#00F; color:#FFF;"> </td>
                                        <td style="background-color:#00F; color:#FFF;"><strong>Total</strong></td>
                                        <td style="background-color:#00F; color:#FFF;"> </td>
                                        <td style="background-color:#00F; color:#FFF;"><?php echo $totqty; ?></td>
                                        <td style="background-color:#00F; color:#FFF;"> </td>
                                        <td style="background-color:#00F; color:#FFF;"> </td>
                                        <td style="background-color:#00F; color:#FFF; text-align:right;"></td>
                                        <td style="background-color:#00F; color:#FFF; text-align:right;"></td>  
                                        <td style="background-color:#00F; color:#FFF; text-align:right;"></td>   
                                         <td style="background-color:#00F; color:#FFF; text-align:right;"></td>
                                         <td style="background-color:#00F; color:#FFF; text-align:right;"><?php echo number_format($nettotal,2); ?></td>   
                                    </tr>						
									
										
										
									</tbody>
                                    
									</tbody>
							</table>
                            

                
                            
                            


<script>window.close();</script>