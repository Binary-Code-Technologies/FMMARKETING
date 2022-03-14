<?php include("../adminsession.php");
$pagename ="stock_report.php";   
$module = "Stock Report";
$submodule = "Stock Report List";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "";
$crit = " where 1 = 1 ";
set_time_limit(0);

$n1=1;
$n1=400;

if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));
}

if($_GET['pcatid']!="")
{
	$pcatid= addslashes(trim($_GET['pcatid']));
	
}

 header("Content-type: application/vnd-ms-excel");
$filename = "DatewiseStockReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

<table border="1">
<thead>			
    <tr>
            <th width="5%" class="head0 nosort">S.No.</th>
            <th width="13%" class="head0" >Product</th>
            <th width="11%" class="head0">Categary</th>
            <th width="8%" class="head0" >Open. Bal.</th>
            <th width="12%" class="head0" style="text-align:center;" >Purchased</th>
            
            <th width="12%" class="head0" style="text-align:center;" >Sold</th>  
                                      
            <th width="16%" class="head0" >Stock</th>                                                     
    </tr>
                   
</thead>
<tbody>

 <?php
								
		$slno=1;
$sql_get = mysqli_query($connection,"Select * from m_product where pcatid='$pcatid' order by prodname asc ");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$stock=0;
									$productid =  $row_get['productid'];
									$pcatid =  $row_get['pcatid'];
									 $opening_stock = $cmn->getstock($connection,$productid,$fromdate);
									$catname=$cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'");									
									
									 $pcond=" where  1=1 ";
									 $scond=" where 1=1 ";									 
									$pret =" and 1=1 ";
									$sret =" and 1=1 ";
									 
								if($todate !='' && $fromdate !='')
								{
								$pcond .=" and purchasedate between '$fromdate' and '$todate' ";
								$scond .=" and saledate between '$fromdate' and '$todate' ";
								$pret .=" and ret_date between '$fromdate' and '$todate' ";
								$sret .=" and sale_retdate between '$fromdate' and '$todate' ";
								
								}
						 $pur = 0;											 
						 $sql_p = mysqli_query($connection,"select purchaseid from purchaseentry $pcond"); 
						while($row_p = mysqli_fetch_assoc($sql_p))
						{
						$pur += $cmn->getvalfield($connection,"purchasentry_detail","sum(qty)","productid='$productid' and purchaseid='$row_p[purchaseid]'");//purchase
						}
						
						 $pur_ret = 0;						 
					 $pur_ret = $cmn->getvalfield($connection,"pur_return","sum(ret_qty)","productid='$productid' $pret");//purchase
					
						
						 $sold = 0;																
						$sql_s = mysqli_query($connection,"select saleid from saleentry $scond");
						while($row_s = mysqli_fetch_assoc($sql_s))
						{
						$sold += $cmn->getvalfield($connection,"saleentry_detail","sum(qty)","productid='$productid' and saleid='$row_s[saleid]'");//purchase
						}
						
						
						$saleret=0;						
					 $saleret= $cmn->getvalfield($connection,"salereturn","sum(ret_qty)","productid='$productid' $sret");
					 
					 if($saleret=='')
					 {
						$saleret=0; 
					 }
					 else
					 {
						$saleret=$saleret; 
					 }
					 
					  if($pur_ret=='')
					 {
						$pur_ret=0; 
					 }
					 else
					 {
						$pur_ret=$pur_ret; 
					 }
							
							$stock=$opening_stock+$pur - $sold-$pur_ret+$saleret;
					 ?>
                    <tr>
                    <td><?php echo $slno++; ?></td>
                    <td><?php echo $row_get['prodname']; ?></td>
                    <td><?php echo $catname; ?></td>
                    <td><?php echo $opening_stock; ?></td>
                    <td><?php echo $pur; ?></td>
                    
                    <td><?php echo $sold; ?></td>
                    
                    <td><?php echo $stock; ?></td>
                   </tr>
                   <?php
            }
            ?>
        </tbody>
 </table>
 
 
