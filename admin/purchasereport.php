<?php //error_reporting(0);  

include("../adminsession.php");
$pagename ="purchasereport.php"; 
$module = "Sale Report";
$submodule = "Sale Report List";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "purchaseentry";
$tblpkey = "purchaseid";
if(isset($_GET['purchaseid']))
$keyvalue = $_GET['purchaseid'];
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
	$crit .= " and  purchaseentry.purchasedate between '$fromdate' and '$todate'";
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
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                    
              
                    
                     <td><input type="text" name="fromdate" id="fromdate" class="input-medium"  placeholder='dd-mm-yyyy'
                     value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                   
                    
                    <td><input type="text" name="todate" id="todate" class="input-medium" 
                    placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>
                    
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate');"> Search 
                    </button></td>
                    <td>&nbsp; <a href="purchasereport.php"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                   
                <!--widgetcontent-->
                     
            <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_purchase_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>" class="btn btn-info" target="_blank">
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
                        	
                          	<th width="7%" class="head0 nosort">S.No.</th>
                            <th width="16%" class="head0" >Pur No</th>
                             <th width="11%" class="head0">Sale Date</th>
                           
                            <th width="16%" class="head0" >Customer Name</th>
                             <th width="11%" class="head0" >Amount</th>
                            <th width="13%" class="head0">Print Bill</th>
                            <!-- <th width="14%" class="head0" >Delete</th>   -->                       
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									//echo "Select * from purchaseentry $crit order by purchaseid desc";die;
									$sql_get = mysqli_query($connection,"Select * from purchaseentry $crit  order by purchasedate desc,purchaseid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid =$row_get['suppartyid'];
										$disc =$row_get['disc'];
										$total_pur =$row_get['total_pur'];
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										$total = $cmn->getTotalBillAmt($connection,$row_get['purchaseid']);
										$gst = $cmn->getTotalGst($connection,$row_get['purchaseid']);
										$igst = $cmn->getTotalIgst_Sale($connection,$row_get['purchaseid']);
										$total = $total - $disc;
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['purchasedate']); ?></td> 
                                                 <td><?php echo $supparty_name; ?></td>      
                                                 <td><?php echo number_format(round($total_pur),2);  ?></td>
                                                 <td><a class='btn btn-warning'  href='pdf_purchase_invoicea4.php?purchaseid=<?php echo  $row_get['purchaseid'] ; ?>' target="_blank" >Print Bill</a></td>
                                               
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
	function funDel(id)
	{  //alert(id);   
	

		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		fromdate = '<?php echo $cmn->dateformatindia($fromdate); ?>';
		todate = '<?php echo $cmn->dateformatindia($todate); ?>';
		// alert(fromdate); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_sale.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				  //alert(pagename+'?action=3&fromdate='+fromdate+'&todate='+todate);
				   location=pagename+'?action=3&fromdate='+fromdate+'&todate='+todate;
				}
				
			  });//ajax close
		}//confirm close
	} //fun close

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

<script> 


function changestatus(purchaseid,is_completed)
{
var crit="<?php echo $crit; ?>";
	
	//alert(crit);
	if(confirm("Do You want to Update this record ?"))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax_update_order.php',
			  data: "purchaseid="+purchaseid+'&crit='+crit+'&is_completed='+is_completed,
			  dataType: 'html',
			  success: function(data){
				//alert(data);
				 // jQuery('#record').html(data);
					arr = data.split("|");						
					status =arr[0].trim(); 
					count_product = arr[1].trim();
					
					//alert(status);
					
					if(status==1)
					{
						curr_status="Completed";
					}
					else
					{
						curr_status="Pending";
					}
					
					jQuery('#status'+purchaseid).html(curr_status);
				 
				}
				
			  });//ajax close
		}//confirm close
}

</script>

</body>

</html>
