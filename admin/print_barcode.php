<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "print_barcode.php";
$module = "";
$submodule = "Print Barcode";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_product";
$tblpkey = "productid";
if(isset($_GET['productid']))
$keyvalue = $_GET['productid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
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
                  
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
            	<table width="98%" class="table table-bordered" id="dyntable">
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
                            <th width="14%" class="head0">Product Code</th>
                            <th width="14%" class="head0">Product Name</th>
                            <th width="14%" class="head0">Barcode</th>
                            <th width="12%" class="head0">Rate</th>
                            <th width="13%" class="head0">Print Barcode</th>
                       </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_product where 1=1 order by productid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['prod_code']; ?></td> 
                                                 <td><?php echo $row_get['prodname']; ?></td> 
                                                  <td><?php echo $row_get['barcode']; ?></td> 
                                                   <td><?php echo $row_get['rate']; ?></td> 
                 <td><a class='btn btn-warning' title="Edit" href='generet_barcode.php?productid=<?php echo  $row_get['productid'] ; ?>&barcode=<?php echo $row_get['barcode'];?> ' target="_blank" >Generate Barcode</a></td>
                              					
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
		imgpath = '<?php echo $imgpath; ?>';
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_image_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath,
			  dataType: 'html',
			  success: function(data){
				 //alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
	
	


	
		

  </script>
  
  <script>
		
		 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#manu_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
                jQuery("#exp_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
				
                //Money Euro
                jQuery("[data-mask]").inputmask();
		 });
		</script>



</body>

</html>
