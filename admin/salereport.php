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
	$crit .= " and  saleentry.saledate between '$fromdate' and '$todate'";
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
if(isset($_GET['billtype']))
{
	$billtype = trim(addslashes($_GET['billtype']));	
	
	if($billtype !='')  { $crit .=" and billtype='$billtype' ";$crit1 .=" and A.billtype='$billtype' "; }
}
else
{
	$billtype= '';
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
                       <th width="15%">Customer </th>
                         <th width="15%">Sale Type </th>
                      
                    </tr>
                    <tr>
                    
              
                    
                     <td><input type="text" name="fromdate" id="fromdate" class="input-medium"  placeholder='dd-mm-yyyy'
                     value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                   
                    
                    <td><input type="text" name="todate" id="todate" class="input-medium" 
                    placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>
                     <td>
                    
                       <select id="suppartyid" name="suppartyid" class="form-control chzn-select" style="width:180px;">
                    <option value="">-select-</option>
                    <?php     
						    	    $sql = mysqli_query($connection,"select * from  m_supplier_party where type_supparty='party' order by supparty_name ") ;
                            while($row= mysqli_fetch_assoc($sql))
                            {
                            ?>
                                        <option value="<?php echo $row['suppartyid'];?>"><?php echo $row['supparty_name'];?></option>
                                          <?php 
                            }
                            ?>
                   </select>
                                    
                                  <script> document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>'; </script>  
                    </td>
                    <td> <select  name="billtype" class="chzn-select" id="billtype" style="font-weight:bold;width:100px; " >
                                         <option value="" >-Select-</option>
                                         <option value="Invoice">Invoice</option>
                            			 <option value="Challan">Challan</option>
                                       </select>
							   		   <script>document.getElementById('billtype').value = '<?php echo $billtype; ?>';</script>
                                  </td> 
                     
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate');"> Search 
                    </button></td>
                    <td>&nbsp; <a href="salereport.php"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                   
                <!--widgetcontent-->
                     
           <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_sale_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&suppartyid=<?php echo $suppartyid;?>" class="btn btn-info" target="_blank">
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
                            <th width="10%" class="head0" >Sale No</th>
                             <th width="10%" class="head0">Sale Date</th>
                      
                            <th width="16%" class="head0" >Customer Name</th>
                              <th width="10%" class="head0" >Sale Type</th>
                             <th width="10%" class="head0" >Amount</th>
                             <th width="20%" class="head0">Print Bill</th>
                                               
                        </tr>
                    
                        
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									$nettot=0;
						
							
									$sql_get = mysqli_query($connection,"Select * from saleentry $crit  order by saledate desc,saleid desc");
									
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid =$row_get['suppartyid'];
										$saleid =$row_get['saleid'];
										$disc =$row_get['disc'];
                    $remark = $row_get['remark'];
										
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										$return_amt = $cmn->getvalfield($connection,"salereturn","sum(return_amt)","saleid='$saleid'");
										$totalsale =$row_get['totalsale']-$return_amt;
										$nettot+=$totalsale;

                    if($supparty_name=="cash"){
                      $supparty_name = $supparty_name.' ('.$remark.')';
                  }else{
                      $supparty_name = $supparty_name;
                  }
										 
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td> 
                                               
                                                 <td><?php echo $supparty_name;?></td>  
                                                  <td><?php echo $row_get['billtype']; ?></td>    
                                                 <td><?php echo number_format(round($totalsale),2);  ?></td>
                                                 <td><a class='btn btn-warning'  href='pdf_sale_details_prnita4.php?saleid=<?php echo  $row_get['saleid'] ; ?>' target="_blank" >Print Bill A4</a>&nbsp;
												 <a class='btn btn-primary'  href='pdf_sale_details_prnita5.php?saleid=<?php echo  $row_get['saleid'] ; ?>' target="_blank" >Print Bill A5</a>
												
												</td>
                                               
                        					</tr>
                        <?php
						}
						?>
                        
                      
                        
                           <thead>
                        <tr style="color:#F00;">
                     
                           
                            <th style="background-color:#FF0;" colspan="5" >&nbsp; </th>
                             <th style="background-color:#FF0;" width="11%" class="head0" ><?php echo number_format(round($nettot),2);?></th>
                               <th style="background-color:#FF0;" ></th>                 
                        </tr>
                    </thead>
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


function changestatus(saleid,is_completed)
{
var crit="<?php echo $crit; ?>";
	
	//alert(crit);
	if(confirm("Do You want to Update this record ?"))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax_update_order.php',
			  data: "saleid="+saleid+'&crit='+crit+'&is_completed='+is_completed,
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
					
					jQuery('#status'+saleid).html(curr_status);
				 
				}
				
			  });//ajax close
		}//confirm close
}

</script>

</body>

</html>
