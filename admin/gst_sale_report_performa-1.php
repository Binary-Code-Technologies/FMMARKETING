<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename ="gst_sale_report_performa-1.php";   
$module = "GST Sale Report Performa-I";
$submodule = "GST Sale Report Performa-I";
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


if($todate !='' && $fromdate !='')
{
	$todate = $cmn->dateformatusa($todate);
	$fromdate= $cmn->dateformatusa($fromdate);
	
	$crit .=" and saledate between '$fromdate' and '$todate'";
	
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
                    <form class="stdform stdform2" method="get" >
                    
                    <table id="mytable01" align="center" class="table table-bordered table-condensed"  >
                    <tr>
                    	
                        <th width="22%">From  Date : </th>
                        <th width="22%">To Date : </th>                       
                        <th width="56%">&nbsp;</th>                       
                    </tr>
                    <tr>
                  
                    <td><input type="text" name="fromdate" id="fromdate" class="input-medium" 
                    placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" /></td>
                    
                     <td><input type="text" name="todate" id="todate" class="input-medium" 
                    placeholder='dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" /></td>
                                        
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate,todate');"> Search 
                    </button> &nbsp; &nbsp; <a href="gst_sale_report_performa-1.php"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                    
                    <p align="right" style="margin-top:7px; margin-right:10px;">
                      <a onClick="tableToExcel('mytable', 'W3C Example Table')" class="btn btn-xs btn-warning">Export in Excel</a>  &nbsp;&nbsp;
                     </p>
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
            	<table class="table table-bordered" id="mytable">
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
                        	<th colspan="8"> <strong>From Date : <?php  echo $cmn->dateformatindia($fromdate); ?>   &nbsp;&nbsp;&nbsp; To Date : <?php  echo $cmn->dateformatindia($todate); ?>  </strong> </th>
                            
                                                       
                        <tr>
                        	
                          	<th colspan="8" class="head0 nosort" style="background-color: rgb(21, 21, 161); color:#FFF;"><strong>Summary For B2CS(7)</strong></th>
                          
                           
                        </tr>
                    </thead>
                    
                       <thead>
                        <tr>
                        	
                          	<th  style="background-color: rgb(21, 21, 161); color:#FFF;" colspan="3">&nbsp;</th>
                            <th  style="background-color: rgb(21, 21, 161); color:#FFF; text-align:center;" class="head0"> Total Taxable Value</th>
                            <th  style="background-color: rgb(21, 21, 161); color:#FFF; text-align:center;" class="head0"> Total Tax Value</th>
                            <th  style="background-color: rgb(21, 21, 161); color:#FFF; text-align:center;" class="head0">Total Cess </th>
                            <th  style="background-color: rgb(21, 21, 161); color:#FFF;" class="head0"></th>
                     <th  style="background-color: rgb(21, 21, 161); color:#FFF; text-align:center;" class="head0"> Total Net Value</th>                           
                        </tr>
                    </thead>
                    
                    <?php
					
					$total_tax=$cmn->gettotalB2CS($fromdate,$todate);
					$total_tax_gst=$cmn->gettotalB2CS_tax($fromdate,$todate);
					?>
                    
                       <thead>
                        <tr>
                        	
                          	<td class="head0 nosort" colspan="3"></td>
                           
                            <td class="head0" style="text-align:right;"><strong><?php echo number_format($total_tax,2); ?></strong></td>
                            <td class="head0" style="text-align:right;"><strong><?php echo number_format($total_tax_gst,2); ?></strong></td>
                            <td class="head0"></td>
                            <td class="head0"></td>
                            <td class="head0" style="text-align:right;">
                            <strong><?php echo number_format($total_tax + $total_tax_gst,2); ?></strong></td>
                        </tr>
                    </thead>
                    
                    
                    <thead>
                        <tr>
                        	
                          	<th style="background-color:#CC9;" >Type</th>
                            <th style="background-color:#CC9;" >Place of Supply</th>
                            <th style="background-color:#CC9; text-align:center;" >Rate</th>
                            <th style="background-color:#CC9; text-align:center;">Taxable Value</th>
                            <th style="background-color:#CC9; text-align:center;">Tax Value</th>
                            <th style="background-color:#CC9; text-align:center;" >Cess Amount</th>
                            <th style="background-color:#CC9;">E-commerce GSTIN</th>
                           <th style="background-color:#CC9; text-align:center;">Net Value</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                  <?php 
					  
				  
			
				$sqldata=mysqli_query($connection,"select  A.suppartyid,tax_id,D.stateid,state_name,state_code from saleentry As A left join saleentry_detail as B ON A.saleid=B.saleid left join m_supplier_party As C on C.suppartyid = A.suppartyid left join m_state as D on D.stateid=C.stateid where  saledate between '$fromdate' and '$todate' and B.tax_id !='0' and C.stateid !='0' group by B.tax_id,C.stateid"); 
				  while($rowdata=mysqli_fetch_assoc($sqldata))
				  {
					 $tax_id=$rowdata['tax_id']; 
					 $tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");					 
					 $totalamount=$cmn->getb2csamt($tax_id,$fromdate,$todate);
					 $totaltaxamount=$cmn->getb2csamttax($tax_id,$fromdate,$todate);
				  ?>
                           <tr>
                                                <td>OE</td> 
                                                <td><?php echo $rowdata['state_code'].'-'.$rowdata['state_name']; ?></td> 
                                                <td style="text-align:right;"><strong><?php echo number_format($tax,2); ?></strong></td>  
                              					<td style="text-align:right;"><strong><?php echo number_format($totalamount,2); ?></strong></td>
                                                <td style="text-align:right;"><strong><?php echo number_format($totaltaxamount,2); ?></strong></td>
                                                <td></td> 
                                                <td></td>
                                                <td style="text-align:right;"><strong><?php echo number_format($totalamount + $totaltaxamount,2); ?></strong></td>
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
<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
</body>

</html>
