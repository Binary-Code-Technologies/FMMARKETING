<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "profile_setting1.php";
$module = "Setting";
$submodule = "User Setting";
$btn_name = "Update";
$imgpath="admin/uploaded/";
//$keyvalue = 0;
$tblname = "m_branch";
$tblpkey = "branchid";
if(isset($_GET['userid']))
$$keyvalue = $_GET['userid'];
$keyvalue = 1;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";

	$app_sql = mysqli_query($connection,"select * from m_branch");
	
	$app_row = mysqli_fetch_array($app_sql);
	 $branchid  = $app_row['branchid'];
	$unique_code = $app_row['unique_code'];
	$username = $app_row['username'];
	$password = $app_row['password'];
	$branch_name = $app_row['branch_name'];
	$address_line1 = $app_row['address_line1'];
	$address_line2 = $app_row['address_line2'];
	$landline = $app_row['landline'];
	$ifsc_code = $app_row['ifsc_code'];
	  $imgname = $app_row['imgname'];
	
if(isset($_POST['submit']))
{
	  $branchid  = test_input($_POST['branchid']);
	  $unique_code = test_input($_POST['unique_code']);
	 $username = test_input($_POST['username']);
	 $password = test_input($_POST['password']);
	$branch_name = test_input($_POST['branch_name']);
	$address_line1 = test_input($_POST['address_line1']);
	$address_line2 = test_input($_POST['address_line2']);
	$landline = test_input($_POST['landline']);
	$ifsc_code = test_input($_POST['ifsc_code']);
	  $imgname = $_FILES['imgname'];
	// echo $imgname;die;
	
	//check Duplicate
	/*$check = check_duplicate($connection,$tblname,"login_name = '$login_name' and $tblpkey <> '$keyvalue'");
	if($check > 0)
	{
		$dup = " Error : Duplicate User Id";
	}*/
	//else
	//{
		/*if($keyvalue == 0)
		{
			//insert
			$form_data = array('login_name'=>$login_name,'branchid'=>$loginid,'password'=>$password,'mobile2'=>$mobile2,'mobile1'=>$mobile1,'emailid'=>$emailid,'username'=>$username,'ipaddress'=>$ipaddress,'createdate'=>$createdate);
			  dbRowInsert($connection,$tblname, $form_data);
			  $action=1;
			  $process = "insert";
		}*/
		//else
		//{
			//update
			$form_data = array('unique_code'=>$unique_code,'username'=>$username,'password'=>$password,'branch_name'=>$branch_name,'address_line1'=>$address_line1,'address_line2'=>$address_line2,'landline'=>$landline,'ifsc_code'=>$ifsc_code,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$branchid'");
			$keyvalue = mysqli_insert_id($connection);
			$old_file1 = $cmn->getvalfield($connection,"m_branch","imgname","branchid = '$branchid'");
				if($_FILES['imgname']['tmp_name'] == '')
				{	
				//echo "hi";die;
					$file_name = $old_file1;
				}
				else
				{				
					if($old_file1!='')
					unlink("uploaded/$old_file1");
					
					$file_name = uploadImage("../admin/uploaded/",$imgname);
					//$cmn->convert_image($file_name,"uploaded/","150","150");
					
					 //echo "Update m_users set imgname = '$file_name' where userid = '$userid'  ";die;
					  mysqli_query($connection,"Update m_branch set imgname = '$file_name' where branchid = '$branchid'");
				}
			$action=2;
			$process = "updated";
		
		 $cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $userid, $process);
		 echo "<script>location='$pagename?action=$action'</script>";
		
	
}



?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("../users/inc/top_files.php"); ?>
</head>

<body>

<div class="mainwrapper">
	
    <!-- START OF LEFT PANEL -->
    <?php include("../users/inc/left_menu.php"); ?>
    
    <!--mainleft-->
    <!-- END OF LEFT PANEL -->
    
    <!-- START OF RIGHT PANEL -->
    
   <div class="rightpanel">
    	<?php include("../users/inc/header.php"); ?>
        
        <div class="maincontent">
        	<div class="contentinner">
              <?php include("../include/alerts.php"); ?>
            	<!--widgetcontent-->        
                <div class="widgetcontent  shadowed nopadding">
                    <form class="stdform stdform2" method="post" action="">
                            <p>
                                <label>User Name <span class="text-error">*</span></label>
                                <span class="field"><input type="text" name="username" id="username" class="input-xxlarge" value="<?php echo $username;?>"/></span>
                            </p>
                            
                            <p>
                                <label>Password </label>
                                <span class="field"><input type="text" name="password" id="password"  class="input-xxlarge" value="<?php echo $password;?>"/></span>
                            </p>
                             <p>
                                <label>Branch Name</label>
                                <span class="field"><input type="text" name="branch_name" id="branch_name"  class="input-xxlarge" value="<?php echo $branch_name;?>"/></span>
                            </p>
                             <p>
                                <label>Address 1</label>
                                <span class="field"><input type="text" name="address_line1" id="address_line1" class="input-xxlarge" value="<?php echo $address_line1;?>"/></span>
                            </p>
                             <p>
                                <label>Address 2 </label>
                                <span class="field"><input type="text" name="address_line2" id="address_line2" class="input-xxlarge" value="<?php echo $address_line2;?>"/></span>
                            </p>
                             <p>
                                <label>LandLine </label>
                                <span class="field"><input type="landline" name="landline" id="password" class="input-xxlarge" value="<?php echo $landline;?>"/></span>
                            </p>
                             <p>
                                <label>IFSC Code</label>
                                <span class="field"><input type="ifsc_code" name="ifsc_code" id="password" class="input-xxlarge" value="<?php echo $ifsc_code;?>"/></span>
                            </p>
                             <p>
                                <label>Unique Code</label>
                                <span class="field"><input type="text" name="unique_code" id="unique_code" class="input-xxlarge" value="<?php echo $unique_code;?>"/></span>
                            </p>
                            
                               <p>
                                <label>Image <span class="text-error">*</span></label>
                                
                                <span class="field"><input type="file"  name="imgname" id="imgname">
                                            <img id="blah"  src="uploaded/<?php if($imgname == "") echo "no-profile-img.gif"; else echo $imgname; ?>"  height="150" width="150" /></span>
                            </p>
                                           
                            <p class="stdformbutton">
                              <center>  <button  type="submit" name="submit"class="btn btn-primary" onClick="return checkinputmaster('username,login_name,password,unique_code'); "><?php echo $btn_name; ?></button></center>
                              
                                <input type="text" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $branchid; ?>">
                            </p>
                        </form>
                    </div>
                   
             
                
               
            </div><!--contentinner-->
        </div><!--maincontent-->
        
   
        
    </div>
    <!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
     <?php include("../users/inc/footer.php"); ?>
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
		 //alert(tblpkey); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			$.ajax({
			  type: 'POST',
			  url: '../ajax/delete_master.php',
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
