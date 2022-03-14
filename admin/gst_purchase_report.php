<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename ="stock_report.php";   
$module = "GST Purchase Report";
$submodule = "GST Purchase List";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "";
$crit = " where 1 = 1 ";

if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));
}
else
{
	$todate = date('d-m-Y');
	$fromdate=date('d-m-Y');
}

if($_GET['suppartyid']!="")
	{
		$suppartyid= addslashes(trim($_GET['suppartyid']));
		$crit .=" and suppartyid='$suppartyid' ";
	}


if($todate !='' && $fromdate !='')
{
	$todate = $cmn->dateformatusa($todate);
	$fromdate= $cmn->dateformatusa($fromdate);
	
	$crit .=" and purchasedate between '$fromdate' and '$todate'";
	
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
                    	
                        <th width="19%">From  Date : </th>
                        <th width="19%">To Date : </th>
                        <th> Supplier Name :</th>
                        <th width="62%">&nbsp;</th>
                       
                    </tr>
                    <tr>
                  
                        <td><input type="date" name="fromdate" id="fromdate" class="input-medium" 
                        placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" /></td>
                        
                        <td><input type="date" name="todate" id="todate" class="input-medium" 
                        placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" /></td>
                    
                    	<td>
                        		                                   <select name="suppartyid" id="suppartyid" class="form-control chzn-select" >
                                    
                                    	 <option value="">-select-</option>
                                        <?php
											$sql = mysqli_query($connection,"Select suppartyid,supparty_name from m_supplier_party where type_supparty = 'supplier' || type_supparty = 'cash' order by supparty_name");
											if($sql)
											{
												while($row = mysqli_fetch_assoc($sql))
												{
											?>
											 <option value="<?php echo $row['suppartyid']; ?>"><?php echo strtoupper($row['supparty_name']); ?></option>
											<?php
												}
											}
									   ?>
                                       
                                    </select>
                                    
                                  <script> document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>'; </script>  

                        
                        </td>
						                    
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate,todate');"> Search 
                    </button> &nbsp; &nbsp; <a href="gst_purchase_report.php"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                   
                <!--widgetcontent-->
                     
                      <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_gst_purchase_report.php?todate=<?php echo $todate;?>&fromdate=<?php echo $fromdate;?>&suppartyid=<?php echo $suppartyid;?>" class="btn btn-info" target="_blank">
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
                        	
                          	<th width="6%" class="head0 nosort">S.No.</th>
                            <th width="14%" class="head0" >Bill No</th>
                             <th width="9%" class="head0">Bill Date</th>
                            <th width="13%" class="head0" >Supplier Name</th>
                            <th width="12%" class="head0" >Total Bill Amt</th>
                            <th width="12%" class="head0" style="text-align:center;" >CGST Amount</th>                                             
                             <th width="11%" class="head0" >SGST Amount</th>    
                              <th width="11%" class="head0" style="text-align:center;" >IGST Amount</th> 
                              <th width="12%" class="head0" style="text-align:center;" >Total Tax Amt</th>                                 
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
								
									$slno=1;
						          $sql_get = mysqli_query($connection,"Select * from purchaseentry $crit order by purchasedate");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
											$total=0;
											$suppartyid = $row_get['suppartyid'];
											$total = $cmn->getTotalPerchaseBillAmt($connection,$row_get['purchaseid']);
											$total=$total-$row_get['disc']+$row_get['packing_charge']+$row_get['freight_charge'];
											$sgst=$cmn->getbillwisegst("sgst",$row_get['purchaseid']);
											$cgst=$cmn->getbillwisegst("cgst",$row_get['purchaseid']);
											$igst=$cmn->getbillwisegst("igst",$row_get['purchaseid']);
								
											?> <tr>
											<td><?php echo $slno++; ?></td> 
											<td><?php echo $row_get['billno']; ?></td>
											<td><strong><?php echo $cmn->dateformatindia($row_get['purchasedate']); ?> </strong></td>
											<td><?php echo $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'"); ?></td>
                                            <td style="text-align:right"><?php echo number_format($total+$cgst+$sgst+$igst,2); ?></td>
											<td style="text-align:right;"><strong><?php echo number_format($cgst,2); ?> </strong></td>
											<td style="text-align:right;"><strong><?php echo number_format($sgst,2); ?></strong></td>
											<td style="text-align:right;"> <strong><?php echo number_format($igst,2); ?></strong></td>
                                            <td style="text-align:right;"> <strong><?php echo number_format($cgst+$sgst+$igst,2); ?></strong></td>
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
			  url: 'ajax/delete_entry.php',
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


function changestatus(outentry_id,is_completed)
{
var crit="<?php echo $crit; ?>";
	
	//alert(crit);
	if(confirm("Do You want to Update this record ?"))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax_update_order.php',
			  data: "outentry_id="+outentry_id+'&crit='+crit+'&is_completed='+is_completed,
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
					
					jQuery('#status'+outentry_id).html(curr_status);
				 
				}
				
			  });//ajax close
		}//confirm close
}

</script>
<script>
		
		 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#todate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
				jQuery("#fromdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
                jQuery("[data-mask]").inputmask();
		 });
		</script>

</body>

</html>
