<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "bank_contra_details.php";
$module = "Contra Entry";
$submodule = "Contra Entry";
$btn_name = "Transfer";
$keyvalue =0 ;
$tblname = "bank_contra_entry";
$tblpkey = "bank_contra_id";
if(isset($_GET['bank_contra_id']))
$keyvalue = $_GET['bank_contra_id'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_POST['submit']))
{
	$bankid = test_input($_POST['bankid']);
	$amount = test_input($_POST['amount']);
	$remark = test_input($_POST['remark']);
	$contra_date = $cmn->dateformatusa($_POST['contra_date']);
	
	
		if($keyvalue == 0)
		  {
			$form_data = array('bankid'=>$bankid,'amount'=>$amount,'remark'=>$remark,'contra_date'=>$contra_date,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			
			}
		
		else
		{
			//update
			$form_data = array('bankid'=>$bankid,'amount'=>$amount,'remark'=>$remark,'contra_date'=>$contra_date,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		}
		//insert into log report
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		echo "<script>location='$pagename?action=$action'</script>";
	 
		
	}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 //echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $bankid =  $rowedit['bankid'];
	 $amount = $rowedit['amount'];
	 $remark = $rowedit['remark'];
	 $contra_date =$rowedit['contra_date'];	
}
else
{
	$contra_date=date('Y-m-d');
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
                       <table class="table table-bordered" width="100%"> 
                       <tr> 
                       <th width="30%">Date <span style="color:#F00;">*</span> </th>
                       <th width="20%">Amount<span style="color:#F00;">*</span></th>
                       <th width="13%">Bank Name<span style="color:#F00;">*</span></th>
                       <th width="37%">Remark</th>
                       </tr>
                       <tr>
                       <td> <input type="text" name="contra_date" id="contra_date" class="input-xlarge"  value="<?php echo $cmn->dateformatindia($contra_date);?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask style="width:140px;" >  </td>
                       
                        <td><input type="text" name="amount" id="amount" value="<?php echo $amount; ?>" autofocus autocomplete="off" class="input-xlarge" style="width:150px;"></td>
                        <td> <select name="bankid" id="bankid"autofocus autocomplete="off" class="chzn-select" style="width:80%px;">
                              <option value=""> Select Bank - </option>
                              <?php $sql = mysqli_query($connection,"select * from m_bank order by bankid ");
							         while($row= mysqli_fetch_assoc($sql))
									 {
							  ?>
                                    <option value="<?php echo $row['bankid'];?>"> <?php echo $row['bank_name'].' / '.$row['ac_number'];?> </option>
                                    <?php
									 }
									 ?>
                                    </select>
                                    <script>document.getElementById('bankid').value='<?php echo $bankid;?>';</script>
                         </td>
                           <td><input type="text" name="remark" id="remark"  value="<?php echo $remark;?>"autofocus autocomplete="off"class="input-xlarge" > </td>
                       </tr>
                       
                       </table>
                       </div>
                           <center> <p class="stdformbutton">
                                <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('contra_date,amount,bankid'); ">
								<?php echo $btn_name; ?></button>
                                <a href="<?php echo $pagename; ?>"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                        </form>
                    </div>
                   <!-- <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_master_unit.php" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>-->
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
                         	 <th width="9%" class="head0 nosort">S.No.</th>
                              <th width="25%" class="head0">Date </th>
                             <th width="23%" class="head0">Bank Name</th>                            
                             <th width="21%" class="head0">Amount</th>
                             <th width="9%" class="head0">Edit</th>
                             <th width="13%" class="head0">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from  bank_contra_entry where 1=1 order by bank_contra_id desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$bankid = $row_get['bankid'];
										$bank_name = $cmn->getvalfield($connection,"m_bank","bank_name","bankid='$bankid'");
										$ac_number = $cmn->getvalfield($connection,"m_bank","ac_number","bankid='$bankid'");
										
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                  <td><?php echo $cmn->dateformatindia($row_get['contra_date']); ?></td> 
                                                <td><?php echo $bank_name." / ".$ac_number; ?></td>                                                
                                                  <td><?php echo $row_get['amount']; ?></td>
                                                <td><a class='icon-edit' title="Edit" href='?bank_contra_id=<?php echo  $row_get['bank_contra_id'] ; ?>'></a></td>  <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['bank_contra_id']; ?>);' style='cursor:pointer'></a>
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
	
	
	  jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#contra_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
			
                jQuery("[data-mask]").inputmask();
		 });

  </script>



</body>

</html>
