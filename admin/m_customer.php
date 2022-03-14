<?php  error_reporting(0);                                                                                                   
include("../adminsession.php");
$pagename = "m_customer.php";
$tblname = "m_supplier_party";
$tblpkey = "suppartyid";
$module = "Masters";
$submodule = "Customer Master";
$heading = "Add Customer";
$suppartyid="";
$btn_name = "Save";
$currentdate=date('Y-m-d');
$type_supparty = 'party';
if(isset($_GET['action']))
$action = $_GET['action'];
else
$action = 0;
$enable='enable';
if(isset($_GET['suppartyid']))
 $suppartyid = $_GET['suppartyid'];
else
$suppartyid = 0;
if(isset($_POST['cancel']))
{
	echo "<script>location='$pagename'</script>";
}
if(isset($_GET['suppartyid']) && $_GET['suppartyid'] != "")
{
	$btn_name = "Update";
	 $suppartyid = test_input($_GET['suppartyid']);
//echo "select * from m_supplier_party where suppartyid='$suppartyid'";
	$app_sql = mysqli_query($connection,"select * from m_supplier_party where suppartyid='$suppartyid'");
	$app_row = mysqli_fetch_array($app_sql);
	$supparty_name = $app_row['supparty_name'];
	$mobile 	 = $app_row['mobile'];
	$address    = $app_row['address'];
	$age = $app_row['age'];	
	$bank_name = $app_row['bank_name'];
	$bank_ac = $app_row['bank_ac'];
	$ifsc_code = $app_row['ifsc_code'];
	$bank_address = $app_row['bank_address'];
	$dob = $app_row['dob'];
	 $gender = $app_row['gender'];
	$mobile    = $app_row['mobile'];
	$land_line  = $app_row['land_line'];
	$disid    = $app_row['disid'];	
	$panno    = $app_row['panno'];	
	$regdate    = $app_row['regdate'];	
		
	$van_licno    = $app_row['van_licno'];
}
//echo $suppartyid;
if(isset($_POST['submit']))
{
	   $suppartyid = test_input($_POST['suppartyid']);
	  $supparty_name = test_input($_POST['supparty_name']);
	$mobile = test_input($_POST['mobile']);
	$age = test_input($_POST['age']);
	$address = test_input($_POST['address']);
	$enable = test_input($_POST['enable']);
	
	$mobile      = test_input($_POST['mobile']);
	
	$disid     = test_input($_POST['disid']);
	
	$regdate    = test_input($_POST['regdate']);	
		
	
	$dob = test_input($_POST['dob']);
	 $gender = $_POST['gender'];
	
	
	$form_data = array('supparty_name'=>$supparty_name,'address'=>$address,'type_supparty'=>$type_supparty,'mobile'=>$mobile,'enable'=>$enable,'mobile'=>$mobile,'createdby'=>$loginid,'createdate'=>$createdate);
	 
	if($suppartyid == 0)
	{
		$count = check_duplicate($connection,$tblname,"supparty_name='$supparty_name'&& mobile = '$mobile' && $tblpkey <> '$suppartyid'");
		if($count == 0)
		{
			dbRowInsert($connection,$tblname, $form_data);
			echo "<script>location='$pagename?action=1'</script>";
		}
		else
		{
			$duplicate = "ERROR: Duplicate Record...";
		}
	}
	
	else
	{
		$form_data = array('supparty_name'=>$supparty_name,'address'=>$address,'type_supparty'=>$type_supparty,'mobile'=>$mobile,'enable'=>$enable,'createdby'=>$loginid,'lastupdated'=>$createdate);
		dbRowUpdate($connection,$tblname, $form_data, "suppartyid='$suppartyid'");
		echo "<script>location='$pagename?action=2'</script>";
	}
}
else{
	$regdate=date('Y-m-d');
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
                    <form class="stdform stdform2" method="post" action=""  >
                    <?php echo  $dup;  ?>
                    
                    <div class="lg-12 md-12 sm-12">
                                <label>Customer Name<span class="text-error">*</span></label>
                                <span class="field">
                                <input type="text" name="supparty_name" id="supparty_name" class="input-xxlarge" value="<?php echo $supparty_name;?>" style="width:80%;" autocomplete="off"  />
                      
                      			</span>
                     </div>
                     
                     
                     
                      
                     <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>Gender</label>
                                <span class="field">
                              <select name="gender" id="gender" class="chzn-select" style="width:82%;">
                              <option value=""> Select</option>
                            <option value="Male">Male </option>
                             <option value="Female">Female </option>
                             <option value="Third Gender">Third Gender </option>
                             
                             </select>
                             <script>  document.getElementById('gender').value=('<?php echo $gender;?>'); </script>
                         </span>
                     </div>
                     
                     
                     <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>DOB </label>
                                <span class="field"> <input type="date" name="dob" id="dob" onChange="getAge(this.value);" class="input-xxlarge" value="<?php echo $dob;?>" style="width:80%;"  /> </span>
                     </div>
                      <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>Age</label>
                                <span class="field">
                              <input type="text" name="age" id="age" class="input-xxlarge" value="<?php echo $age;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                          <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>Register Date</label>
                                <span class="field">
                              <input type="date" name="regdate" id="regdate" class="input-xxlarge" value="<?php echo date('Y-m-d');?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                     
                     
                      
                      <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>Disease Type</label>
                                <span class="field">
                              <select name="disid" id="disid" class="chzn-select" style="width:82%;">
                              <option value=""> Select</option>
                              <?php     
							  $sql = mysqli_query($connection,"select * from m_disease order by diseasename") ;
							   while($row= mysqli_fetch_assoc($sql))
							   {
							  ?>
                            <option value="<?php echo $row['disid'];?>"><?php echo $row['diseasename'];?> </option>
                              <?php 
							  }
							  ?>
                             </select>
                             <script>  document.getElementById('disid').value=(<?php echo $disid;?>); </script>
                         </span>
                     </div>
                     
                     
                       <div class="lg-12 md-12 sm-12">
                                <label>Mobile Number</label>
                                <span class="field"><input type="text" name="mobile" id="mobile" class="input-xxlarge" value="<?php echo $mobile;?>" style="width:80%;" autocomplete="off" /></span>
                     </div>
                     
                     <div class="lg-12 md-12 sm-12">
                                <label>Address</label>
                                <span class="field"> <input type="text" name="address" id="address" class="input-xxlarge" value="<?php echo $address;?>" style="width:80%;" autocomplete="off" autofocus /> </span>
                     </div>
                    
                   <div class="lg-12 md-12 sm-12">
                                <label>Status</label>
                                <span class="field">
                              <label><input type="radio" name="enable"  value="enable" <?php if($enable == "enable") echo 'checked';?>>&nbsp;&nbsp;Active </label>
                              <label><input type="radio" name="enable"  value="disable"  <?php if($enable == "disable") echo 'checked';?>>&nbsp;&nbsp;Inactive</label>
                                 </span>
                     </div>   
                                                  
                          <center> <p class="stdformbutton">
                    <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('supparty_name');">
								<?php echo $btn_name; ?></button>
                                <a href="m_customer.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $suppartyid; ?>">
                            </p> </center>
                         </form>
                    </div>
                   
                    <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_m_customer.php" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>
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
                        	
                          	<th width="9%" class="head0 nosort">S.No.</th>
                            <th width="21%" class="head0">Customer Name</th>
                            <th width="16%" class="head0">Mobile</th>
                            <th width="24%" class="head0">Address</th>
                         
                        
                            <th width="8%" class="head0">Edit</th>
                            <th width="8%" class="head0">Delete</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                              <?php
										$slno=1;
										//echo "Select * from $tblname order by $tblpkey desc";die;
					 $sql_list = mysqli_query($connection,"Select * from $tblname where type_supparty ='party' and suppartyid <> 0 order by $tblpkey desc");
									   if($sql_list)
									   {
										   while($row_list = mysqli_fetch_array($sql_list))
										   {?>
                                           <tr>
                                                <td width="9%" align="center"><?php echo $slno++; ?></td>
                                                <td><?php echo $row_list['supparty_name'] ; ?></td>
                                                <td><?php echo $row_list['mobile'] ; ?></td>
                                                <td><?php echo $row_list['address'] ; ?></td>
                                              
                                              
                                                <td><a class='icon-edit' title="Edit" href='?suppartyid=<?php echo $row_list['suppartyid'] ; ?>'></a></td>
                                                     <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_list['suppartyid']; ?>);' style='cursor:pointer'></a>
                                                </td>
												</tr>
												<?php
										   }
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
 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#gender").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
 
 function getAge(data){
	jQuery.ajax({
			  type: 'POST',
			  url: 'showAge.php',
			  data: 'data='+data,
			  dataType: 'html',
			  success: function(data){				  
		    // alert(data);					
					jQuery('#age').val(data);					
				}				
			  });//ajax close				
 }

  </script>
  



</body>

</html>
