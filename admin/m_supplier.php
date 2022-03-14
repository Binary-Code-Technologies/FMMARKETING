<?php error_reporting(0);                                                                                                include("../adminsession.php");
$tblname = 'm_supplier_party';
$tblpkey ='suppartyid';
$pagename = 'm_supplier.php';
$module = "Masters";
$submodule = "Supplier Master";
$heading = "Add Supplier";
$btn_name = "Save";
$type_supparty ='supplier';
$discount = 0;
$prevbalance = 0;
$enable = "enable";
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";

$dup ='';
if(isset($_GET['suppartyid']) != "")
{
	$btn_name = "Update";
	 $keyvalue = test_input($_GET['suppartyid']);
	$app_sql = mysqli_query($connection,"select * from m_supplier_party where suppartyid='$keyvalue'");
	$app_row = mysqli_fetch_array($app_sql);
	$supparty_name = $app_row['supparty_name'];
	$mobile 	 = $app_row['mobile'];
	$address    = $app_row['address'];
	$prevbalance = $app_row['prevbalance'];	
	$bank_name = $app_row['bank_name'];
	$bank_ac = $app_row['bank_ac'];
	$ifsc_code = $app_row['ifsc_code'];
	$bank_address = $app_row['bank_address'];
	$tinno = $app_row['tinno'];
	$prevbal_date = $app_row['prevbal_date'];	
	$stateid    = $app_row['stateid'];	
	$panno    = $app_row['panno'];	
	$lic_no    = $app_row['lic_no'];	
	$van_no    = $app_row['van_no'];	
	$van_licno    = $app_row['van_licno'];	
		
}
else
{
	$supparty_name = '';
	$mobile 	 = '';
	$address    = '';
	$prevbalance = '';	
	$bank_name = '';
	$bank_ac = '';
	$ifsc_code = '';
	$bank_address = '';
	$tinno = '';
	$prevbal_date = date('Y-m-d');
	$mobile1    = '';
	$land_line  = '';
	$stateid    = '';	
	$panno    = '';	
	$lic_no    ='';	
	$van_no    ='';	
	$van_licno    = '';
}
if(isset($_POST['submit']))
{
	  $suppartyid = test_input($_POST['suppartyid']);
	 $supparty_name = test_input($_POST['supparty_name']);
	$mobile = test_input($_POST['mobile']);
	$prevbalance = test_input($_POST['prevbalance']);
	$address = test_input($_POST['address']);
	$enable = test_input($_POST['enable']);
	$bank_name = test_input($_POST['bank_name']);
	$bank_ac = test_input($_POST['bank_ac']);
	$ifsc_code = test_input($_POST['ifsc_code']);
	$bank_address = test_input($_POST['bank_address']);	
	$stateid     = isset($_POST['stateid'])?test_input($_POST['stateid']):'';
	
	$tinno = test_input($_POST['tinno']);
	$prevbal_date = $cmn->dateformatusa($_POST['prevbal_date']);
	
	$panno    = test_input($_POST['panno']);	
	$lic_no    = test_input($_POST['lic_no']);	
	$van_no    = test_input($_POST['van_no']);	
	$van_licno    = test_input($_POST['van_licno']);
	
	
	$form_data = array('supparty_name'=>$supparty_name,'address'=>$address,'type_supparty'=>$type_supparty,'mobile'=>$mobile, 'prevbalance'=>$prevbalance,'enable'=>$enable,'bank_name'=>$bank_name,'bank_ac'=>$bank_ac,'bank_ac'=>$bank_ac,'ifsc_code'=>$ifsc_code,'bank_address'=>$bank_address,'prevbal_date'=>$prevbal_date,'stateid'=>$stateid,
	 'createdby'=>$loginid,'createdate'=>$createdate);
	 
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
		$form_data = array('supparty_name'=>$supparty_name,'type_supparty'=>$type_supparty,'address'=>$address,'mobile'=>$mobile,'prevbalance'=>$prevbalance,'enable'=>$enable,'bank_name'=>$bank_name,'bank_ac'=>$bank_ac,'bank_ac'=>$bank_ac,'ifsc_code'=>$ifsc_code,'bank_address'=>$bank_address,
	 'createdby'=>$loginid,'lastupdated'=>$createdate);
		dbRowUpdate($connection,$tblname, $form_data, "suppartyid='$suppartyid'");
	
		echo "<script>location='$pagename?action=2'</script>";
	}
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
                                <label>Supplier Name<span class="text-error">*</span></label>
                                <span class="field">
                                <input type="text" name="supparty_name" id="supparty_name" class="input-xxlarge" value="<?php echo $supparty_name;?>" style="width:80%;" autocomplete="off"  />
                      </span>
                     </div>
                     <div class="lg-12 md-12 sm-12">
                                <label>Mobile Number</label>
                                <span class="field"><input type="text" name="mobile" id="mobile" class="input-xxlarge" value="<?php echo $mobile;?>" style="width:80%;" autocomplete="off" /></span>
                     </div>
                     
                      
                        <div class="lg-12 md-12 sm-12">
                                <label>Supplier Address</label>
                                <span class="field">
                              <input type="text" name="address" id="address" class="input-xxlarge" value="<?php echo $address;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                    
                     <div class="lg-12 md-12 sm-12">
                                <label>Opening Balance</label>
                                <span class="field">
                              <input type="text" name="prevbalance" id="prevbalance" class="input-xxlarge" value="<?php echo $prevbalance;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                     
                      <div class="lg-12 md-12 sm-12">
                                <label>Opening Balance Date</label>
                                <span class="field">
                              <input type="text" name="prevbal_date" id="prevbal_date" class="input-xxlarge" value="<?php echo $cmn->dateformatindia($prevbal_date);?>" style="width:80%;" autocomplete="off"  autofocus />
                                 </span>
                     </div>
                  <div style="display:none">   
                      <div class="lg-12 md-12 sm-12">
                                <label>PAN No</label>
                                <span class="field"> 
                                <input type="text" name="panno" id="panno" class="input-xxlarge" value="<?php echo $panno;?>" style="width:80%;"/>
                       			 </span>
                     </div>
                     <div class="lg-12 md-12 sm-12">
                                <label>GSTIN No</label>
                                <span class="field">
                              <input type="text" name="tinno" id="tinno" class="input-xxlarge" value="<?php echo $tinno;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                     <div class="lg-12 md-12 sm-12">
                                <label>Licence No</label>
                                <span class="field">
                              <input type="text" name="lic_no" id="lic_no" class="input-xxlarge" value="<?php echo $lic_no;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                     <div class="lg-12 md-12 sm-12">
                                <label>Van No</label>
                                <span class="field">
                              <input type="text" name="van_no" id="van_no" class="input-xxlarge" value="<?php echo $van_no;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                     <div class="lg-12 md-12 sm-12">
                                <label>Van Licence No</label>
                                <span class="field">
                              <input type="text" name="van_licno" id="van_licno" class="input-xxlarge" value="<?php echo $van_licno;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                      <div class="lg-12 md-12 sm-12">
                                <label>Bank Name </label>
                                <span class="field"> 
                                <input type="text" name="bank_name" id="bank_name" class="input-xxlarge" value="<?php echo $bank_name;?>" style="width:80%;"/>
                       			 </span>
                     </div>
                      <div class="lg-12 md-12 sm-12">
                                <label>Bank A/C </label>
                                <span class="field"> <input type="text" name="bank_ac" id="bank_ac" class="input-xxlarge" value="<?php echo $bank_ac;?>" style="width:80%;"  /> </span>
                     </div>
                      <div class="lg-12 md-12 sm-12">
                                <label>Ifsc Code</label>
                                <span class="field"> <input type="text" name="ifsc_code" id="ifsc_code" class="input-xxlarge" value="<?php echo $ifsc_code;?>" style="width:80%;" autocomplete="off" autofocus /> </span>
                     </div>
                      <div class="lg-12 md-12 sm-12">
                                <label>Bank Address</label>
                                <span class="field">
                              <input type="text" name="bank_address" id="bank_address" class="input-xxlarge" value="<?php echo $bank_address;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                          <div class="lg-12 md-12 sm-12">
                                <label>State Name</label>
                                <span class="field">
                              <select name="stateid" id="stateid" class="chzn-select" style="width:82%;" >
                              <option value=""> Select</option>
                              <?php     
							  $sql = mysqli_query($connection,"select * from m_state order by state_name") ;
							   while($row= mysqli_fetch_assoc($sql))
							   {
							  ?>
                            <option value="<?php echo $row['stateid'];?>"><?php echo $row['state_name']." ( ".$row['state_code']." ) ";?> </option>
                              <?php 
							  }
							  ?>
                             </select>
                             <script>  document.getElementById('stateid').value=(<?php echo $stateid;?>); </script>
                         </span>
                     </div>
                     </div>
                     <br/>
                     
                       <div class="lg-12 md-12 sm-12">
                                <label>Status</label>
                                <span class="field">
                              <label><input type="radio" name="enable"  value="enable" <?php if($enable == "enable") echo 'checked';?>>&nbsp;&nbsp;Active </label>
                             
                             <label><input type="radio" name="enable"  value="disable" <?php if($enable == "disable") echo 'checked';?>>&nbsp;&nbsp;Inactive</label>
                                 </span>
                     </div>   
                                                  
                          <center> <p class="stdformbutton">
                    <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('supparty_name');">
								<?php echo $btn_name; ?></button>
                                <a href="m_supplier.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                                            </form>

                    </div>
                    <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_m_supplier.php" class="btn btn-info" target="_blank">
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
                        	
                          	<th width="6%" class="head0 nosort">S.No.</th>
                            <th width="23%" class="head0">Supplier Name</th>
                            <th width="15%" class="head0">Mobile No.</th>
                              <th width="15%" class="head0">Address</th>
                             <th width="14%" class="head0">Opening Balnce</th>
                            <th width="7%" class="head0">Edit</th>
                            <th width="8%" class="head0">Delete</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
										$slno=1;
										//echo "Select * from  m_supplier_party where type_supparty ='supplier' and suppartyid <> 0 order by suppartyid desc";die;
					 $sql_list = mysqli_query($connection,"Select * from  m_supplier_party where type_supparty ='supplier' and suppartyid <> 0 order by suppartyid desc");
									   if($sql_list)
									   {
										   while($row_list = mysqli_fetch_array($sql_list))
										   {?>
                                           <tr>
													<td width="6%" align="center"><?php echo $slno++; ?></td>
													<td><?php echo $row_list['supparty_name'] ; ?></td>
													<td><?php echo $row_list['mobile'] ; ?></td>
                                                    	<td><?php echo $row_list['address'] ; ?></td>
                                                                                                   
                                                    <td style="text-align:right;"><?php echo number_format($row_list['prevbalance'],2); ?></td>
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
		// alert(tblpkey); 
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
                jQuery("#prevbal_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
		 

  </script>
  



</body>

</html>
