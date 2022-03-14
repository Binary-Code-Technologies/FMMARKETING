<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "master_expense.php";
$module = "Expense / Income  Master";
$submodule = "Expense / Income  Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "master_expence";
$tblpkey = "expencetypeid";
if(isset($_GET['expencetypeid']))
$keyvalue = $_GET['expencetypeid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_POST['submit']))
{
	$expense_name = test_input($_POST['expense_name']);
	$type  = test_input($_POST['type']);
	
    $check = check_duplicate($connection,$tblname,"(expense_name = '$expense_name') && $tblpkey <> $keyvalue");
			if($check > 0)
			{
			$dup="<div class='alert alert-danger'>
			<strong>Error!</strong> Error : Duplicate Record.
			</div>";
			} 
			
			else {
						
		  if($keyvalue == 0)
		{
			$form_data = array('expense_name'=>$expense_name,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			}
		
		else
		{
		
			$form_data = array('expense_name'=>$expense_name,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		}
		//insert into log report
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		echo "<script>location='$pagename?action=$action'</script>";
		}
	}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 $sqledit  = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit  = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $expense_name  =  $rowedit['expense_name'];
	 $type  = $rowedit['type'];
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
                         <table class="table table-bordered" > 
                                <tr>
                                 <th> Name <span style="color:#F00;"> * </span> </th>
                                 <th>Action </th>
                              </tr>
                                <tr> 
                                <td><input type="text" name="expense_name" id="expense_name" class="input-xxlarge" style="width:80%" value="<?php echo $expense_name;?>" autofocus autocomplete="off" placeholder="Enter Expense Name" /> </td>
                                
                                 <td>
                        
                <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('expense_name'); ">
                <?php echo $btn_name; ?></button>
                <a href="<?php echo $pagename; ?>"  name="reset" id="reset" class="btn btn-success">Reset</a>
                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                           
                                </td>
                                </tr>
                                </table>  
                       
                        </form>
                     </div>  
                       
                    </div>
                   <!-- <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_master_pcat.php" class="btn btn-info" target="_blank">  <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>-->
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
                         	<th width="12%" class="head0 nosort">S.No.</th>
                            <th width="61%" class="head0">Name</th>  
                             
                            <th width="13%" class="head0">Edit</th>
                            <th width="14%" class="head0">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from master_expence where 1=1 order by expencetypeid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										if($row_get['type']==1)
										{
											
											$type = "Other Expense";
										}
										else  if($row_get['type']==2)
										{
											
											$type = "Other Income";
										}
										
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['expense_name']; ?></td> 
                                                 
                                                <td><a class='icon-edit' title="Edit" href='?expencetypeid=<?php echo  $row_get['expencetypeid'] ; ?>'></a></td>
                                                <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['expencetypeid']; ?>);' style='cursor:pointer'></a>
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
