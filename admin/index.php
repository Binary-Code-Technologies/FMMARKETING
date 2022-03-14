<?php error_reporting(0);                                                                                                  
include("../adminsession.php");
$pagename = "index.php";
$module = "Dashboard";
$submodule = "Dashboard";

$curr_date=date('Y-m-d');



$total_product=$cmn->getvalfield($connection,"m_product","count(*)","1=1"); 
$total_customer=$cmn->getvalfield($connection,"m_supplier_party","count(*)","type_supparty='party'");
$total_supplier=$cmn->getvalfield($connection,"m_supplier_party","count(*)","type_supparty='supplier'");

$today_sale =$cmn->getvalfield($connection,"saleentry","sum(totalsale)","saledate='$curr_date'");
 $today_perchase =$cmn->getvalfield($connection,"purchaseentry","sum(total_pur)","purchasedate='$curr_date'");




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
        	<div class="contentinner content-dashboard">
            	<div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Welcome!</strong> This alert needs your attention, but it's not super important.
                </div><!--alert-->
                
                <div class="row-fluid">
                	<div class="span12">
                      <ul class="widgeticons row-fluid">
                
                        <li class="one_fifth"><a><small>&nbsp;</small><h1><?php echo $total_customer; ?></h1><span>Total Customer</span></a></li>
                         <li class="one_fifth"><a><small>&nbsp;</small><h1><?php echo $total_supplier; ?></h1><span>Total Suppiler</span></a></li>
<li class="one_fifth"><a><small>&nbsp;</small>
 <h1 style="color:#F00;"><?php echo $total_product; ?> </h1>
  <span>Total Product</span></a> </li>


                           <li class="one_fifth"><a><small>&nbsp;</small><h1><?php echo "Rs.".number_format(round($today_sale),2);?></h1><span>Today's Sell</span></a></li>
                          
                           <li class="one_fifth"><a><small>&nbsp;</small><h1><?php echo "Rs.".number_format(round($today_perchase),2);; ?></h1><span>Today's Purchase</span></a></li>
                        </ul>
                        <ul class="widgeticons row-fluid">
                
                         <li class="one_fifth"><a href="m_customer.php"><img src="../img/gemicon/users.png" alt="" /><span>Customer Entry</span></a></li>  
                           <li class="one_fifth"><a href="master_product.php"><img src="../img/gemicon/edit.png" alt="" /><span>Product Entry</span></a></li>
                             <li class="one_fifth"><a href="saleentry.php"><img src="../img/gemicon/archive.png" alt="" /><span>Sale Entry</span></a></li>
                               
                               <li class="one_fifth last"><a href="salereport.php"><img src="../img/gemicon/notify.png" alt="" /><span>Sale Report</span></a></li>
                               <li class="one_fifth"><a href="purchaseentry.php"><img src="../img/gemicon/reports.png" alt="" /><span>Purchase Entry</span></a></li>
                        </ul>
                    </div><!--span8-->
                    
                    
                    
                    <!--span4-->
                </div>
                
              
                        <br />
                       
                    </div><!--span8-->
                    <!--span4-->
                </div>
                
                <div class="row-fluid" style="display:none">
                	<div class="span12">
                    	<ul class="widgeticons row-fluid">
                        	   <li class="one_fifth"><a href="master_unit.php"><img src="../img/gemicon/location.png" alt="" /><span>Add Unit</span></a></li>
                        <li class="one_fifth"><a href="master_pcat.php"><img src="../img/gemicon/reports.png" alt="" /><span>Add Product Category</span></a></li>
             			 <li class="one_fifth"><a href="master_product.php"><img src="../img/gemicon/location.png" alt="" ><span>Add Product</span></a></li>
                         <li class="one_fifth"><a href="m_supplier.php"><img src="../img/gemicon/edit.png" ><span>Add Supplier</span></a></li>
                        <li class="one_fifth"><a href="m_customer.php"><img src="../img/gemicon/image.png"><span>Add Customer</span></a></li>
                        <li class="one_fifth"><a href="purchaseentry.php"><img src="../img/gemicon/edit.png" ><span>Purchase Entry</span></a></li>
                        
                         <li class="one_fifth"><a href="changepassword.php"><img src="../img/gemicon/image.png"><span>Change Password</span></a></li>
                        </ul>
                        
                        <br />
                        
                        
                       
                        
                    </div><!--span8-->
                    <!--span4-->
                </div><!--row-fluid-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div>
    <!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
     <?php include("inc/footer.php"); ?>
    <!--footer-->

    
</div><!--mainwrapper-->
<script type="text/javascript">

</script>
</body>

</html>

