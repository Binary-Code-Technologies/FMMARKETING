<?php                                                                                                include("../adminsession.php");
$pagename = "master_state.php";
$module = "Master";
$submodule = "State Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_state";
$tblpkey = "stateid";
if(isset($_GET['stateid']))
$keyvalue = $_GET['stateid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";

$dup ='';
if(isset($_POST['submit']))
{
	$state_name = test_input($_POST['state_name']);
	$state_code = test_input($_POST['state_code']);
	$enable="enable";
    //check Duplicate
	$check = check_duplicate($connection,$tblname,"state_name = '$state_name' && $tblpkey <> $keyvalue");
		if($check > 0)
			{
			/*$dup = " Error : Duplicate Record";*/
			$dup="<div class='alert alert-danger'>
			<strong>Error!</strong> Error : Duplicate Record.
			</div>";
			} 
			
			else {
			//insert
			
			if($keyvalue == 0)
		{
			$form_data = array('state_name'=>$state_name,'state_code'=>$state_code,'enable'=>$enable,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			
			}
		
		else
		{
			//update
			$form_data = array('state_name'=>$state_name,'state_code'=>$state_code,'enable'=>$enable,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		}
		//insert into log report
		//$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		echo "<script>location='$pagename?action=$action'</script>";
	   }
		
	}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 $sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $state_name =  $rowedit['state_name'];
	 $state_code = $rowedit['state_code'];		
}
else
{
	$state_name='';
	$state_code='';
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
                    <form class="stdform stdform2" method="post" action="">
                    <?php echo  $dup;  ?>
                       <div class="lg-12 md-12 sm-12">
                       <table class="table table-bordered"> 
                       <tr> 
                       <th> State Name</th>
                       <th> State Code</th>
                       </tr>
                       <tr> 
                       <td> <input type="text" name="state_name" id="state_name" class="input-xlarge" style="width:80%" value="<?php echo $state_name;?>" 
                                autofocus autocomplete="off"  placeholder="Enter State Name"/></td>
                       <td> <input type="text" name="state_code" id="state_code" class="input-xlarge" style="width:80%" value="<?php echo $state_code;?>" 
                                autofocus autocomplete="off" placeholder="Enter State Code" /></td>
                       </tr>
                       
                       </table>
                       </div>
                           <center> <p class="stdformbutton">
                                <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('state_name'); ">
								<?php echo $btn_name; ?></button>
                                <a href="master_unit.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                        </form>
                    </div>
                    <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_master_unit.php" class="btn btn-info" target="_blank">
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
                        	
                          	<th width="11%" class="head0 nosort">S.No.</th>
                            <th width="18%" class="head0">State Name</th>
                             <th width="18%" class="head0">State Code</th>
                            <th width="9%" class="head0">Edit</th>
                            <th width="10%" class="head0">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_state where 1=1 order by stateid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['state_name']; ?></td> 
                                                 <td><?php echo $row_get['state_code']; ?></td> 
                              					<td><a class='icon-edit' title="Edit" href='?stateid=<?php echo  $row_get['stateid'] ; ?>'></a></td>  <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['stateid']; ?>);' style='cursor:pointer'></a>
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



</body>

</html>
