<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "master_session.php";
$module = "Master";
$submodule = "Session Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_session";
$tblpkey = "sessionid";
if(isset($_GET['sessionid']))
$keyvalue = $_GET['sessionid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_GET['st']))
{
	 $st = test_input($_GET['st']);
	  mysqli_query($connection,"Update  m_session set status = 0");
	  mysqli_query($connection,"Update m_session set status = 1 where $tblpkey = '$st' ");
}
if(isset($_POST['submit']))
{
	$keyvalue = test_input($_POST['sessionid']);
	$fromdate   =  $cmn->dateformatusa(test_input($_POST['fromdate']));
	$todate     =  $cmn->dateformatusa(test_input($_POST['todate']));
	$session_name =  test_input($_POST['session_name']);
	//check Duplicate
	$check = check_duplicate($connection,$tblname,"session_name = '$session_name' && $tblpkey <> $keyvalue");
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
			$form_data = array('fromdate'=>$fromdate,'todate'=>$todate,'session_name'=>$session_name,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			
			}
		
		else
		{
			//update
			$form_data = array('fromdate'=>$fromdate,'todate'=>$todate,'session_name'=>$session_name,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
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
	
if($_GET['sessionid'])
  {
	 $btn_name = "Update";
	//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $fromdate =  $rowedit['fromdate'];
	 $todate = $rowedit['todate'];
	 $session_name = $rowedit['session_name'];	
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
                        <table id="mytable01" align="center" class="table table-bordered table-condensed">
                       <tr> 
                       <th>From Date </th>
                       <th>To Date</th>
                       <th>Session</th>
                       <th>&nbsp;</th>
                      </tr>
                      <tr> 
                      <td><input type="text" name="fromdate" id="fromdate" class="input-medium"  placeholder='dd-mm-yyyy'
                     value="<?php echo $cmn->dateformatindia($fromdate); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                      <td><input type="text" name="todate" id="todate" class="input-medium" placeholder= 'dd-mm-yyyy' value="<?php echo $cmn->dateformatindia($todate);?>" data-inputmask="alias:'dd-mm-yyyy'" data-mask /> </td>
                      <td><input type="text"  name="session_name" id="session_name"class="input-medium" value="<?php echo $session_name;?>"></td>
                      <td> <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('fromdate,todate,session_name,'); ">
								<?php echo $btn_name; ?></button>
                                <a href="master_session.php"  name="reset" id="reset" class="btn btn-success">Reset</a> </td>
                      </tr>
                       
                       </table>
                               
                     </div>
                     	     <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                         
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
                        	
                          	<th class="head0 nosort">S.No.</th>
                            <th class="head0">From Date</th>
                            <th class="head0">To Date</th>
                            <th class="head0">Session Name</th>
                            <th class="head0">Status</th>
                            <th class="head0">Edit</th>
                            <th class="head0">Delete</th>
                         </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_session where 1=1 order by sessionid  desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $cmn->dateformatindia($row_get['fromdate']); ?></td> 
                                                 <td><?php echo $cmn->dateformatindia($row_get['todate']); ?></td>
                                                  <td><?php echo $row_get['session_name']; ?></td>
                                                  <td align="center">
                                                <small class="badge pull-right bg-<?php if($row_get['status'] == 1) echo 'green'; else echo 'red'; ?>" style="cursor:pointer;" onClick="return change_status('<?php echo $row_get['sessionid'];?>');" >&nbsp;</small>
                                                
                                               <?php if($row_get['status'] == 1) echo "<span style='color:green'> Active </span> "; else echo "<span style='color:Red'>In-Active </span> "; ?>
                                                
                                                </td>
                              					<td><a class='icon-edit' title="Edit" href='?sessionid=<?php echo  $row_get['sessionid'] ; ?>'></a></td>
                                                <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['sessionid']; ?>);' style='cursor:pointer'></a>
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

function change_status(st)
{
	if(st != "")
	{
		if(confirm("Are you sure! You want to active this session."))
		{
			location = '<?php echo $pagename; ?>?st='+st;
		}
		
	}
}
  </script>
  
  
   <script>
		
		jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#fromdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
                jQuery("#todate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Money Euro
                jQuery("[data-mask]").inputmask();
		 });
		</script>



</body>

</html>
