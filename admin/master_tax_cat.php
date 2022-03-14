<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "master_tax_cat.php";
$module = "Add Tax Categary";
$submodule = "Tax Categary Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_taxt_cat";
$tblpkey = "tax_cat_id";
if(isset($_GET['tax_cat_id']))
$keyvalue = $_GET['tax_cat_id'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";

if(isset($_POST['submit']))
{
	$tcat_name = test_input($_POST['tcat_name']);
	$enable = test_input($_POST['enable']);
	
	
	
	//check Duplicate
	$check = check_duplicate($connection,$tblname,"tcat_name = '$tcat_name' and $tblpkey <> '$keyvalue'");
	if($check > 0)
	{
		$dup = " Error : Duplicate Record";
	}
	else
	{
		if($keyvalue == 0)
		{
			//insert
			$form_data = array('tcat_name'=>$tcat_name,'enable'=>$enable,'ipaddress'=>$ipaddress,'createdate'=>$createdate);
			  dbRowInsert($connection,$tblname, $form_data);
			  $action=1;
			  $process = "insert";
		}
		else
		{
			//update
			$form_data = array('tcat_name'=>$tcat_name,'enable'=>$enable,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			 $keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		}
		 $cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		 echo "<script>location='$pagename?action=$action'</script>";
		
	}
}

if(isset($_GET[$tblpkey]))
{
	$btn_name = "Update";
	//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit       = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit       = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $tcat_name    =  $rowedit['tcat_name'];
	 $enable      = $rowedit['enable'];
	
}
else
$enable ="enable";

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
                <div class="widgetcontent  shadowed nopadding" style="display:none;">
                    <form class="stdform stdform2" method="post" action="">
                    
                  
                    
                            <p>
                                <label>Tax Categary Name <span class="text-error">*</span></label>
                                <span class="field"><input type="text" name="tcat_name" id="tcat_name" class="input-xxlarge" value="<?php echo $tcat_name;?>" autofocus autocomplete="off" /></span>
                            </p>
                            
                            
                            
                            <div class="lg-12 md-12 sm-12">
                                <label>Status<span class="text-error">*</span> </label>
                                <span class="field">
                              <label><input type="radio" name="enable"  value="enable" <?php if($enable == "enable") echo 'checked';?>>&nbsp;&nbsp;Active </label>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        	<label><input type="radio" name="enable"  value="disable"
                                        	<?php if($enable == "disable") echo 'checked';?>>&nbsp;&nbsp;Inactive</label>
                                 </span>
                     </div>
                            
                             <center> <p class="stdformbutton">
                                <button  type="submit" name="submit"class="btn btn-primary" onClick="return checkinputmaster('tcat_name,tax nu,enable'); "><?php echo $btn_name; ?></button>
                                <a href="master_tax_cat.php" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                        </form>
                    </div>
                   <!-- <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_city.php" class="btn btn-info" target="_blank"><span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span>
</a></p>-->
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
            	<table class="table table-bordered" id="dyntable">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                        	
                          	<th class="head0 nosort">S.No.</th>
                            <th class="head0">Tax Categary Name</th>
                            <th class="head0">Status</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        
                      
                           </span></td>
                               <?php
											$slno=1;
											$sql_get = mysqli_query($connection,"select * from m_taxt_cat where 1=1 order by tax_cat_id desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
			
												
												?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['tcat_name'] ; ?></td>    
                                                <td><?php echo $row_get['enable'];  ?></td>
                                              
                             
                             
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
    <!--footer-->

    
</div><!--mainwrapper-->

<script type="text/javascript">
    
 // $('#partyid').trigger('chosen:activate'); // for autofocus
 
</script>
</body>

</html>
