<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "report_other_income.php";
$module = "Master";
$submodule = "Other Income Report";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "other_income";
$tblpkey = "incomid";
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
                
                    <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="excel_report_income.php" class="btn btn-info" >Excel</a><a href="pdf_report_other_income.php" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>
             
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
                            <th class="head0">Income Name</th>
                            <th class="head0">Income Date</th>
                            <th class="head0">Amount</th>
                         </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from other_income where 1=1 order by incom_date desc,incomid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$expen_name=$cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$row_get[expencetypeid]'");
									   ?> <tr>
                                               <td><?php echo $slno++; ?></td> 
                                               <td><?php echo $expen_name; ?></td> 
                                               <td><?php echo $cmn->dateformatindia($row_get['incom_date']); ?></td>
                                               <td><?php echo $row_get['amount']; ?></td>
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
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
  </script>
  
   <script>
		
		jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#incom_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
              jQuery("[data-mask]").inputmask();
		 });
		</script>



</body>

</html>
