<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "master_bank.php";
$module = "Bank Master";
$submodule = "Bank Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_bank";
$tblpkey = "bankid";
if(isset($_GET['bankid']))
$keyvalue = $_GET['bankid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_POST['submit']))
{
	$bank_name = test_input($_POST['bank_name']);
	$bank_address  = test_input($_POST['bank_address']);
	$ifsc_code  = test_input($_POST['ifsc_code']);
	$ac_number  = test_input($_POST['ac_number']);
	$open_bal = test_input($_POST['open_bal']);
	$bal_date = $cmn->dateformatindia(trim(addslashes($_POST['bal_date'])));
	
    $check = check_duplicate($connection,$tblname,"( ac_number='$ac_number' ) && $tblpkey <> $keyvalue");
			if($check > 0)
			{
			$dup="<div class='alert alert-danger'>
			<strong>Error!</strong> Error : Duplicate Record.
			</div>";
			} 
			
			else {
						
		  if($keyvalue == 0)
		{
			$form_data = array('bank_name'=>$bank_name,'bank_address'=>$bank_address,'ifsc_code'=>$ifsc_code,'ac_number'=>$ac_number,
							   'open_bal'=>$open_bal,'bal_date'=>$bal_date,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			}
		
		else
		{
		
			$form_data = array('bank_name'=>$bank_name,'bank_address'=>$bank_address,'ifsc_code'=>$ifsc_code,'ac_number'=>$ac_number,
							   'open_bal'=>$open_bal,'bal_date'=>$bal_date,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
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
	$sqledit       = "SELECT * from $tblname where $tblpkey = $keyvalue";
	$rowedit       = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	$bank_name    =  $rowedit['bank_name'];
	$bank_address     = $rowedit['bank_address'];
	$ifsc_code    =  $rowedit['ifsc_code'];
	$ac_number     = $rowedit['ac_number'];
	$open_bal     = $rowedit['open_bal'];
	$bal_date     = $rowedit['bal_date'];
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
                                 <th width="35%">Bank Name <span style="color:#F00;"> * </span> </th>
                                 <th width="32%">Bank Address <span style="color:#F00;"> * </span> </th>
                                 <th width="33%">Acc. Number <span style="color:#F00;"> * </span> </th>
                                 
                                 
                               </tr>
                                <tr> 
                                <td><input type="text" name="bank_name" id="bank_name" class="input-xxlarge" style="width:80%" value="<?php echo $bank_name;?>" autofocus autocomplete="off" placeholder="Enter Bank Name" /> </td>
                                
                                 <td><input type="text" name="bank_address" id="bank_address" class="input-xxlarge" style="width:80%" value="<?php echo $bank_address;?>" autofocus autocomplete="off" placeholder="Enter Bank Address" /> </td>
                                 
                                  <td><input type="text" name="ac_number" id="ac_number" class="input-xxlarge" style="width:80%" value="<?php echo $ac_number;?>" autofocus autocomplete="off" placeholder="Enter ACC Number" /> </td>
                                
                       
                                
                                </tr>
                                
                                
                                  <tr>
                                  <th>IFSC Code <span style="color:#F00;"> * </span> </th>
                                 <th>Opening Balance</th>
                                 <th>Opening Balance Date</th>
                               
                                
                                 
                               </tr>
                                <tr> 
                                  <td>
                        <input type="text" name="ifsc_code" id="ifsc_code" class="input-xlarge" style="width:80%" value="<?php echo $ifsc_code;?>" autofocus autocomplete="off" placeholder="Enter Ifsc Code" />
                                </td>
                                <td><input type="text" name="open_bal" id="open_bal" class="input-xxlarge" style="width:80%" value="<?php echo $open_bal;?>" autofocus autocomplete="off" placeholder="Enter Opening Balance" /> </td>
                                
                                 <td><input type="text" name="bal_date" id="bal_date" class="input-xxlarge" style="width:80%" value="<?php echo $cmn->dateformatindia($bal_date);?>" autofocus autocomplete="off" placeholder="Enter Opening Balance Date" /> </td>
                                 
                               
                         
                                
                                </tr>
                                
                                </table>   
                                
                         <center> <p class="stdformbutton">
<button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('bank_name,bank_address,ac_number,ifsc_code');">
								<?php echo $btn_name; ?></button>
                                <a href="<?php echo $pagename; ?>"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                        </form>
                     </div>  
                       
                    </div>
                    <!--<p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_master_pcat.php" class="btn btn-info" target="_blank">-->
                   <!-- <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>-->
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?>List</h4>
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
                            <th class="head0">E Name</th>  
                            <th class="head0">Bank Address</th>   
                            <th class="head0">Acc. Number</th>   
                            <th class="head0">IFSC Code</th>                             
                            <th class="head0">Edit</th>
                            <th class="head0">Delete</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_bank where 1=1 order by bankid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['bank_name']; ?></td> 
                                                <td><?php echo $row_get['bank_address']; ?></td> 
                                                <td><?php echo $row_get['ac_number']; ?></td> 
                                                <td><?php echo $row_get['ifsc_code']; ?></td> 
                                                <td><a class='icon-edit' title="Edit" href='?bankid=<?php echo  $row_get['bankid'] ; ?>'></a></td>
                                                <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['bankid']; ?>);' style='cursor:pointer'></a>
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
                jQuery("#bal_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
			
                jQuery("[data-mask]").inputmask();
		 });
	 
	 

  </script>
</body>

</html>
