<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "user_master.php";
$module = "Add Users";
$submodule = "User Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "user";
$tblpkey = "userid";
if(isset($_GET['userid']))
$keyvalue = $_GET['userid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";

if($usertype =='user')
{
	echo "<script>location='index.php'</script>";	
}

if(isset($_POST['submit']))
{
	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$usertype = test_input($_POST['usertype']);
	//check Duplicate
	$check = check_duplicate($connection,$tblname,"username = '$username' and $tblpkey <> '$keyvalue'");
	if($check > 0)
	{
		$dup = " Error : Duplicate User Id";
	}
	else
	{
		if($keyvalue == 0)
		{
			//insert
			$form_data = array('username'=>$username,'password'=>$password,'usertype'=>$usertype,'ipaddress'=>$ipaddress,'createdate'=>$createdate);
			  dbRowInsert($connection,$tblname, $form_data);
			  $keyvalue = mysqli_insert_id($connection);
			  $action=1;
			  $process = "insert";
		}
		else
		{
			//update
			$form_data = array('username'=>$username,'password'=>$password,'usertype'=>$usertype,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$action=2;
			$process = "updated";
		}
		 $cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		 echo "<script>location='$pagename?action=$action'</script>";
		
	}
}

if(isset($_GET[$tblpkey]))
{
	//$btn_name = "Update";
	//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	$sqledit       = "SELECT * from $tblname where $tblpkey = $keyvalue";
	$rowedit       = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	$username      =  $rowedit['username'];
	$password      =  $rowedit['password'];
	$usertype	   =  $rowedit['usertype'];
	
}
else
{
	$usertype=''; 
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
                    
                    
                    <table width="100%" border="1">
  <tr>
    <td><p>
                                <label>User Name <span class="text-error">*</span></label>
                                <span class="field"><input type="text" name="username" id="username" class="input-large" value="<?php echo $username;?>" autocomplete="off" /></span>
                            </p></td>
   
    <td><p>
                                <label>Password <span class="text-error">*</span></label>
                                <span class="field"><input type="password" name="password" id="password" class="input-large" value="<?php echo $password;?>" autocomplete="off" /></span>
                            </p></td>
  </tr>
  <tr>
  	<td><p>
                                <label>User Type <span class="text-error">*</span></label>
                                <span class="field"> 
                                <select name="usertype" id="usertype">
                                	<option value="">-Select-</option>
                                	<option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select> 
                                 <script>document.getElementById('usertype').value = '<?php echo $usertype;?>';</script>                                
                                </span>
                           
                           
     </p></td>
  
  </tr>
  
</table>

   <p class="stdformbutton">
                             <center>   <button  type="submit" name="submit"class="btn btn-primary" 
                             onClick="return checkinputmaster('username,password,usertype'); "> <?php echo $btn_name; ?></button>
                                <a href="<?php echo $pagename; ?>" class="btn btn-primary" name="reset_dept" value="Reset" tabindex="5">Reset</a></center>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p>
                        </form>
                    </div>
                   
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
                 <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_user_master.php" class="btn btn-info" target="_blank"><span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span>
</a></p>
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
                            <th class="head0">User Name</th>
                            <th class="head1">Password</th>
                            <th class="head1">User Type</th>
                            <th class="head0">Edit / Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                      
                           </span></td>
                               <?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from user where 1=1 order by userid desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['username'] ; ?></td>    
                                                <td><?php echo $row_get['password'] ; ?></td>
                                                 <td><?php echo $row_get['usertype'] ; ?></td>                        
                           
                             
                              <td><a class='icon-edit' title="Edit" href='?userid=<?php echo  $row_get['userid'] ; ?>'></a> /
                                                <a class='icon-remove' onclick='funDel(<?php echo  $row_get['userid'] ; ?>);' style='cursor:pointer' title="Delete"></a></td>
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
				//alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close

  </script>

</body>

</html>
