<?php
//error_reporting(0);
include("../adminsession.php");
$pagename ="salereport.php"; 
$module = "Sale Report";
$submodule = "Sale Report List";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "saleentry";
$tblpkey = "saleid";
if(isset($_GET['saleid']))
$keyvalue = $_GET['saleid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = $_GET['action'];

$search_sql = "";

if($_GET['fromdate']!="" && $_GET['todate']!="")
{
	$fromdate = addslashes(trim($_GET['fromdate']));
	$todate = addslashes(trim($_GET['todate']));
}
else
{
	$fromdate = date('d-m-Y');
	$todate = date('d-m-Y');
}
$crit = " where 1 = 1 ";
if($fromdate!="" && $todate!="")
{
	$fromdate = $cmn->dateformatusa($fromdate);
	$todate = $cmn->dateformatusa($todate);
	$crit .= " and  salereturn.sale_retdate between '$fromdate' and '$todate'";
}	

if(isset($_GET['suppartyid']))
{
	$suppartyid = trim(addslashes($_GET['suppartyid']));	
	
	if($suppartyid !='')  { $crit .=" and suppartyid='$suppartyid' ";$crit1 .=" and A.suppartyid='$suppartyid' "; }
}
else
{
	$suppartyid= '';
}

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
</head>

<body>

<div class="mainwrapper">
	
    <!-- START OF LEFT PANEL -->
    <?php include("inc/left_menu.php"); ?>
    
    <!--mainleft-->
    <!-- END OF LEFT PANEL -->
    
    <!-- START OF RIGHT PANEL -->
    
   <div class="rightpanel">
    	<?php include("inc/header.php"); ?>
        
        <div class="maincontent">
        	<div class="contentinner">
              <?php include("../include/alerts.php"); ?>
            	<!--widgetcontent-->        
                <div class="widgetcontent  shadowed nopadding">
                    <form class="stdform stdform2" method="get" action="">
                    
                    <table id="mytable01" align="center" class="table table-bordered table-condensed"  >
                    <tr>
                    	
                        <th>From Date</th>
                        <th>To Date : </th>
                      
                      
                    </tr>
                    <tr>
                    
              
                    
                     <td><input type="text" name="fromdate" id="fromdate" class="input-medium"  placeholder='dd-mm-yyyy'
                     value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                   
                    
                    <td><input type="text" name="todate" id="todate" class="input-medium" 
                    placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>
                     
                    
                     
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate');"> Search 
                    </button></td>
                    <td>&nbsp; <a href="salereport.php"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                   
                <!--widgetcontent-->
                     
           <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_return_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p> 
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
                
            	<table class="table table-bordered" id="dyntable">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                        	 <th class="head0 nosort">S.No.</th>
                             <th  class="head0">Bill No</th>
                               <th  class="head0">Customer</th>
                             <th  class="head0">Product Name</th>
                             <th  class="head0">Return Date</th>
                             <th  class="head0">Total Amount</th>
                              <th class="head0">Return Qty</th>
                             <th  class="head0">Return Amount</th>

                             <th width="16%" class="head0">Balance Amount</th>  
                             <th width="20%" class="head0">Print Bill</th>                        
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									
									$sql_get = mysqli_query($connection,"Select * from salereturn $crit group by saleid order by sale_returnid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
                                        $productid = $row_get['productid'];
                                        $ret_qty = $row_get['ret_qty'];
										$saleidl = $row_get['saleid'];
										 $suppartyid = $cmn->getvalfield($connection,"saleentry","suppartyid","saleid='$saleidl'");
										$billno = $cmn->getvalfield($connection,"saleentry","billno","saleid='$saleidl'");
										
										$totamt = $cmn->getvalfield($connection,"saleentry","totalsale","saleid='$saleidl'");

										$rateamt = $cmn->getvalfield($connection,"saleentry_detail","rate","saleid='$saleidl' and productid='$productid' order by productid desc");
                                         $newamt =   $rateamt * $ret_qty;
										
                                         $balamt = $totamt - $newamt;

 $supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										
										$prodname = $cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
										
									   ?> <tr>
                                                 <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $billno; ?></td>
                                                   <td><?php echo $supparty_name; ?></td>
                                                 <td><?php echo ucwords($prodname); ?></td>
                                                 <td><?php echo $cmn->dateformatindia($row_get['sale_retdate']); ?></td>
                                                 <td><?php echo $totamt; ?></td>                                              
                                                  <td><?php echo $row_get['ret_qty']; ?></td>                                               
                                                  <td><?php echo $newamt; ?></td>                                               
                                                  <td><?php echo $balamt; ?></td>
                                                
                                                 <td><a class='btn btn-warning'  href='pdf_sale_return_prnit.php?sale_returnid=<?php echo  $row_get['sale_returnid']; ?>' target="_blank" >Print Bill</a>
												 
												</td>
                        					</tr>
                        <?php
						}
						?>
                        
                       
                    </tbody>
                </table>
             
                
               
            </div><!--contentinner-->
        </div><!--maincontent-->
        
   
        
    </div>
    <!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
     <?php include("inc/footer.php"); ?>
    <!--footer-->

    
</div><!--mainwrapper-->



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
