<?php  error_reporting(0);                                                                                               include("../adminsession.php");
$pagename = "company_setting.php";
$module = "Add Company";
$submodule = "Company Setting";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "company_setting";
$tblpkey = "compid";
$keyvalue= "1";
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_POST['submit']))
{
	$comp_name = test_input($_POST['comp_name']);
	$mobile = test_input($_POST['mobile']);
	$address = mysqli_real_escape_string($connection,$_POST['address']);	
	$address2 = mysqli_real_escape_string($connection,$_POST['address2']);
	$email_id = mysqli_real_escape_string($connection,$_POST['email_id']);
	$term_cond  = mysqli_real_escape_string($connection,$_POST['term_cond']);
	$gsttinno= mysqli_real_escape_string($connection,$_POST['gsttinno']);
	// $licence_no= mysqli_real_escape_string($connection,$_POST['licence_no']);
	$com_panno= mysqli_real_escape_string($connection,$_POST['com_panno']);
	

	//check Duplicate
	$check=0;
	$cntchk = check_duplicate($connection,$tblname,"comp_name = '$comp_name' and $tblpkey  <> '$keyvalue'");
	if($check > 0)
	{
		$dup = " Error : Duplicate Record";
	}
	else
	{
		//update
			$form_data = array('comp_name'=>$comp_name,'mobile'=>$mobile,'address'=>$address,'address2'=>$address2,'gsttinno'=>$gsttinno,'email_id'=>$email_id,'term_cond'=>$term_cond,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$action=2;
			$process = "updated";
		  
	
		 //$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		 echo "<script>location='$pagename?action=$action'</script>";
	  }
	
}
     $btn_name = "Update";
	 //echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit       = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit       = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $comp_name     =  $rowedit['comp_name'];
	 $mobile        = $rowedit['mobile'];
	 $address       = $rowedit['address'];
	 $address2   = $rowedit['address2'];
	 $email_id  = $rowedit['email_id'];
	 $term_cond  = $rowedit['term_cond'];
	 $gsttinno = $rowedit['gsttinno'];
	
	 $licence_no   = $rowedit['licence_no']; 
	//  $com_panno   = $rowedit['com_panno']; 
	 
	 
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
                            <p>
                                <label>Company Name <span class="text-error">*</span></label>
                                <span class="field"><input type="text" name="comp_name" id="comp_name" class="input-xxlarge" value="<?php echo $comp_name;?>" autofocus/></span>
                            </p>
                            <p>
                                <label>Mobile No:</label>
                                <span class="field"><input type="text" name="mobile" id="mobile" class="input-xxlarge" value="<?php echo $mobile;?>" maxlength="10" autofocus/></span>
                            </p>
                            <p>
                                <label>Address1: </label>
                                <span class="field"><input type="text" name="address" id="address" class="input-xxlarge" value="<?php echo $address;?>" autofocus/></span>
                            </p>
                            
                             <p>
                                <label>Address2: </label>
                                <span class="field"><input type="text" name="address2" id="address2" class="input-xxlarge" value="<?php echo $address2;?>" autofocus/></span>
                            </p>
                            
                            <p>
                                <label>Email ID: </label>
                                <span class="field"><input type="text" name="email_id" id="email_id" class="input-xxlarge" value="<?php echo $email_id;?>" autofocus/></span>
                            </p>
                            
                             <p>
                                <label>GSTIN No: </label>
                                <span class="field"><input type="text" name="gsttinno" id="gsttinno" class="input-xxlarge" value="<?php echo $gsttinno;?>" autofocus/></span>
                            </p>
                             <!-- <p>
                                <label>Licence No: </label>
                                <span class="field"><input type="text" name="licence_no" id="licence_no" class="input-xxlarge" value="" autofocus/></span>
                            </p> -->
                            
                              <!-- <p>
                                <label>PAN No: </label>
                                <span class="field"><input type="text" name="com_panno" id="com_panno" class="input-xxlarge" value="" autofocus/></span>
                            </p> -->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                           <p>
                                <label>Terms & Condition: </label>
                                <span class="field"><textarea id="term_cond" name="term_cond" class="input-xxlarge"> <?php echo $term_cond;?></textarea>
                               </span>
                            </p>
                            
                          <center> <p class="stdformbutton">
                                <button  type="submit" name="submit"class="btn btn-primary" onClick="return checkinputmaster('comp_name'); ">
								<?php echo $btn_name; ?></button>
                                <a href="company_setting.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                        </form>
                    </div>
                   
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
 <script src="../js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
     
       <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor2"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('term_cond');
				 
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script> 

</body>

</html>
