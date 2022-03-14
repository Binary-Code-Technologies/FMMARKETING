<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "contra_entry.php";
$module = "Master";
$submodule = "Credit Note Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "contra_entry";
$tblpkey = "contra_id";

if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";


if(isset($_GET['purchaseid']))
{
$purchaseid = addslashes(trim($_GET['purchaseid']));
}


if($purchaseid !='')
{
$sql=	mysqli_query($connection,"select * from purchaseentry where purchaseid='$purchaseid'");
while($row=mysqli_fetch_assoc($sql))
{
	$suppartyid=$row['suppartyid'];
	$purchasedate=$row['purchasedate'];
	$purchase_type=$row['purchase_type'];
	$billtype=$row['billtype'];	
	$discount=$cmn->getvalfield($connection,"contra_entry","discount","purchaseid='$purchaseid'");
	$contra_id =$cmn->getvalfield($connection,"contra_entry","contra_id","purchaseid='$purchaseid'");
	$supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
	
	$disc =$row['disc'];
	$packing_charge =$row['packing_charge'];
	$freight_charge =$row['freight_charge'];
	
	$total = $cmn->getTotalPerchaseBillAmt($connection,$row['purchaseid']);	
	$gst = $cmn->getTotalGst_pur($connection,$row['purchaseid']);
	$total_bill = $total - $disc+$packing_charge+$freight_charge;
	
	
	
	if($billtype=="withouttax")
	{
		$billtype_name="Invoice";
	}
	else
	{
		$billtype_name="Challan";
	}
	
}
}


if(isset($_POST['submit']))
{
	$purchaseid = test_input($_POST['purchaseid']);
	$discount = test_input($_POST['discount']);

  
			
			if($contra_id == 0)
		{
			$form_data = array('discount'=>$discount,'purchaseid'=>$purchaseid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			
			}
		
		else
		{
			//update
			$form_data = array('discount'=>$discount,'purchaseid'=>$purchaseid,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$contra_id'");
			$keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		}
		//insert into log report
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		echo "<script>location='$pagename?action=$action'</script>";
	
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
                       <th width="25%">Bill No</th>
                       <th width="25%">Supplier Name </th>
                        <th width="25%">Purchase Date </th>
                         <th width="25%">Bill Type</th>
                       </tr>
                       <tr> 
                                <td>
                                <select name="purchaseid" id="purchaseid"  class="chzn-select" onChange="setbill(this.value)">
                                <option value="">--Select Bill No--</option>
                                <?php
                                $sql=mysqli_query($connection,"select * from purchaseentry order by purchaseid desc");
                                while($row=mysqli_fetch_assoc($sql))
                                {								
                                ?>
                                <option value="<?php echo $row['purchaseid'];  ?>"> <?php echo $row['billno']; ?></option>
                                <?php } ?>
                                </select>
                                <script> document.getElementById('purchaseid').value='<?php echo $purchaseid; ?>'; </script>
                                </td>
                                <td>
                                <input type="text" name="" id="" class="form-control" style="background-color:#CCC;color:0F25C8;" value="<?php echo $supparty_name; ?>" readonly >
                                
                                </td>
                                <td><input type="text" name="" id="" class="form-control" style="background-color:#CCC;color:0F25C8;" value="<?php echo $cmn->dateformatindia($purchasedate); ?>" readonly >
                                </td>
                                <td><input type="text" name="" id="" class="form-control" style="background-color:#CCC;color:0F25C8;" value="<?php echo $purchase_type; ?>" readonly >
                                </td>
                       </tr>
                       
                        <tr> 
                       <th width="25%">Purchase Type</th>
                       <th width="25%">Bill Amount</th>
                        <th width="25%">Tax Amount</th>
                         <th width="25%">Discount <span style="color:#F00;"> * </span> </th>
                       </tr>
                       <tr> 
                                <td>
                                <input type="text" name="" id="" class="form-control" style="background-color:#CCC;color:0F25C8;" value="<?php echo $billtype_name; ?>" readonly >
                                </td>
                                <td>
                                <input type="text" name="" id="" class="form-control" style="background-color:#CCC;color:0F25C8;" value="<?php echo $total_bill; ?>" readonly >
                                </td>
                                <td>
                                <input type="text" name="gst" id="gst" class="form-control" style="background-color:#CCC;color:0F25C8;" value="<?php echo $gst; ?>" readonly >
                                </td>
                                <td>
                                <input type="text" name="discount" id="discount" class="form-control" value="<?php echo $discount; ?>" autocomplete="off"  >
                                </td>
                       </tr>
                       
                       </table>
                       </div>
                           <center> <p class="stdformbutton">
                                <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('discount'); ">
								<?php echo $btn_name; ?></button>
                                <a href="<?php echo $pagename; ?>"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $contra_id; ?>">
                            </p> </center>
                        </form>
                    </div>
                    <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_contra_entry.php" class="btn btn-info" target="_blank">
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
                            <th width="18%" class="head0">Bill No </th>
                              <th width="18%" class="head0">Suppiler</th>
                             <th width="18%" class="head0">Discount</th>
                            <th width="9%" class="head0">Edit</th>
                            <th width="10%" class="head0">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from contra_entry where 1=1 order by contra_id desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$suppartyid= $cmn->getvalfield($connection,"purchaseentry","suppartyid","purchaseid='$purchaseid'");
											$supparty_name= $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										$purchaseid = $row_get['purchaseid'];
										$billno= $cmn->getvalfield($connection,"purchaseentry","billno","purchaseid='$purchaseid'");
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $billno; ?></td> 
                                                 <td><?php echo $supparty_name; ?></td> 
                                                 <td><?php echo $row_get['discount']; ?></td> 
                              					<td><a class='icon-edit' title="Edit" href='?purchaseid=<?php echo  $row_get['purchaseid'] ; ?>'></a></td>  <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['contra_id']; ?>);' style='cursor:pointer'></a>
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
	
	
function setbill(purchaseid)
{
	if(!isNaN(purchaseid))
	{
		window.location.href='contra_entry.php?purchaseid='+purchaseid;
	}
}


</script>



</body>

</html>
