<?php include("../adminsession.php");
$pagename ="issuereport.php";  
$module = "Product Wise Issue Report";
$submodule = "Product Wise Issue Report List";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "saleentry";
$tblpkey = "saleid";
if(isset($_GET['saleid']))
$keyvalue = $_GET['saleid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
{
$action = $_GET['action'];
}
else
$action ='';

$search_sql = "";

if(isset($_GET['fromdate'])!="" && isset($_GET['todate'])!="")
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
	$crit .= " and  B.saledate between '$fromdate' and '$todate'";
}

if(isset($_GET['branch_id']) !='')
{
	$branch_id = trim(addslashes($_GET['branch_id']));
	if($branch_id !='')
	{
	$crit .=" and B.branch_id='$branch_id'";
	}
}
else
$branch_id='';

if(isset($_GET['receivername']))
{
	$receivername = trim(addslashes($_GET['receivername']));
	
	if($receivername !=''){
		$crit .=" and B.receivername like '%$receivername%'";
		}
}
else
$receivername='';

if(isset($_GET['productid']) !='')
{
	$productid = trim(addslashes($_GET['productid']));
	if($productid !='')
	{
	$crit .=" and A.productid='$productid'";
	}
}
else
$productid='';

if(isset($_GET['pcatid']) !='')
{
	$pcatid = trim(addslashes($_GET['pcatid']));
	if($pcatid !='')
	{
	$crit .=" and C.pcatid='$pcatid'";
	}
}
else
$pcatid='';


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
                    	
                        <th width="12%">From Date</th>
                        <th width="11%">To Date  </th>
                        <th width="16%">Branch Name </th>
                        <th width="18%">Receiver Name </th>
                        <th width="16%">Product Name </th>
                        <th width="27%">Action</th>
                       
                    </tr>
                    <tr>
                    
              
                    
                     <td><input type="text" name="fromdate" id="fromdate" class="input-small"  placeholder='dd-mm-yyyy'
                     value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                   
                    
                    <td><input type="text" name="todate" id="todate" class="input-small" 
                    placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>
                    <td>
                    			 <select name="branch_id" id="branch_id"  class="chzn-select" style="width:90%;">
                                	<option value="">--All--</option>
                                    <?php
									$sql=mysqli_query($connection,"select branch_id,branch_name from m_branch order by branch_name");
									while($row=mysqli_fetch_assoc($sql))
									{								
									?>
                                    <option value="<?php echo $row['branch_id'];  ?>"> <?php echo $row['branch_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('branch_id').value='<?php echo $branch_id; ?>'; </script>
                    </td>
                    <td>
   				<input type="text" name="receivername" id="receivername" class="input-small"  placeholder='Enter Receiver Name' value="<?php echo $receivername; ?>" />
                    </td>
                    <td>
                    		 <select name="productid" id="productid"  class="chzn-select" style="width:90%;">
                                	<option value="">--All--</option>
                                    <?php
									$sql=mysqli_query($connection,"select * from m_product order by prodname");
									while($row=mysqli_fetch_assoc($sql))
									{								
									?>
                                    <option value="<?php echo $row['productid'];  ?>"> <?php echo $row['prodname']; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('productid').value='<?php echo $productid; ?>'; </script>
                    </td>
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate,todate');"> Search 
                    </button>&nbsp; <a href="<?php echo $pagename; ?>"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                   
                <!--widgetcontent-->
                     
            <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="xls_issue_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&branch_id=<?php echo $branch_id; ?>&pcatid=<?php echo $pcatid; ?>&receivername=<?php echo $receivername; ?>&productid=<?php echo $productid; ?>" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Download Excel</span></a></p>  
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
                        	<th width="4%" class="head0 nosort">SN</th>
                            <th width="19%" class="head0">Product Name</th>
                             <th width="8%" class="head0" >Unit</th>
                            <th width="6%" class="head0" >Qty</th>
                             <th width="6%" class="head0" >Rate</th>
                            <th width="8%" class="head0">Issue No</th>
                            <th width="8%" class="head0">Issue Date</th>
                            <th width="6%" class="head0">Branch</th>                            
                            <th width="10%" class="head0" >Recieved By</th>
                            <th width="20%" class="head0" style="text-align:center;">Remark</th>
                            <th width="11%" class="head0" style="text-align:center;">Total</th>                     
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									$tot_rate = 0;
									
									$sql_get = mysqli_query($connection,"Select A.productid,A.unitid,qty,B.saleid,branch_id,saledate,billno,receivername,remark from saleentry_detail as A left join saleentry as B on A.saleid=B.saleid left join m_product as C on A.productid=C.productid $crit order by saledate desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$rate = $cmn->getvalfield($connection,"purchasentry_detail","rate","productid='$row_get[productid]' order by purchaseid desc");
										$total =  $rate * $row_get['qty'];
										
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
                    <td><?php echo $total; ?></td>
        </tr>
                        <?php
						$tot_rate += $total;
						}
						?>
                    <tr style="background-color:#03C; color:#FFF;">
                            <td> </td> 
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>         
                            <td> </td>
                            <td> </td>
                            <td><strong><?php echo $tot_rate; ?></strong></td>
                    </tr>
                       
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
