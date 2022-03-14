<?php //error_reporting(0); 
include("../adminsession.php");
$pagename = "other_expense.php";
$module = "Master";
$submodule = "Other Expense";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "other_expense";
$tblpkey = "expenid";
if(isset($_GET['expenid']))
$keyvalue = $_GET['expenid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_POST['submit']))
{
	$keyvalue = test_input($_POST['expenid']);
	$expen_date   =  $cmn->dateformatusa(test_input($_POST['expen_date']));
	 $expencetypeid =  test_input($_POST['expencetypeid']);
	$amount =  test_input($_POST['amount']);
//	$payment_type= test_input($_POST['payment_type']);	
	//$chequeno= test_input($_POST['chequeno']);
//	$tax_id= test_input($_POST['tax_id']);
	//$refno= test_input($_POST['refno']);
	//$bankid= test_input($_POST['bankid']);
	$remark=mysqli_real_escape_string($connection,$_POST['remark']);
	$payto=test_input($_POST['payto']);
	
	//check Duplicate
		if($keyvalue == 0)
		   {
			$form_data = array('expencetypeid'=>$expencetypeid,'expen_date'=>$expen_date,'amount'=>$amount,'payto'=>$payto,'remark'=>$remark,'sessionid'=>$sessionid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$action=1;
			$process = "insert";
			}
		else
		{
			//update
			$form_data = array('expencetypeid'=>$expencetypeid,'expen_date'=>$expen_date,'payto'=>$payto,'amount'=>$amount,'remark'=>$remark,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		}
		//insert into log report
		
		
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		echo "<script>location='$pagename?action=$action'</script>";
		
		
		
	}
	
if($_GET['expenid'])
  {
	 $btn_name = "Update";
	//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	$rowedit = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	$expenid =  $rowedit['expenid'];
	$expen_date = $rowedit['expen_date'];
	$amount = $rowedit['amount'];	
	$tax_id = $rowedit['tax_id'];	
	$expencetypeid = $rowedit['expencetypeid'];	
	
	$payto = $rowedit['payto'];
	$remark = $rowedit['remark'];
	
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
                       <th width="33%">Expense Type</th>
                       <th width="33%">Expense Date</th>
                       <th width="33%">Amount</th>
                      
                      </tr>                  
                      
                       <tr>
                      	<td>
                        <select name="expencetypeid" id="expencetypeid" class="chzn-select" >
                           <option value=""> Select </option>
                           <?php 
						    $sql = mysqli_query($connection,"select * from master_expence order by expencetypeid ");
						       while($row= mysqli_fetch_array($sql))
						        {
						      ?>
                          <option value="<?php echo $row['expencetypeid'];?>"> <?php echo $row['expense_name'];?> </option>
                          <?php
						        }
						   ?>
                           </select>
                            <script> document.getElementById('expencetypeid').value='<?php echo $expencetypeid; ?>'; </script>
                        
                           </td>
                           
                           <td>
                          
                      <input type="text" name="expen_date" id="expen_date" class="input-medium"  placeholder='dd-mm-yyyy'
                     value="<?php echo $cmn->dateformatindia($expen_date); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                           </td>
                           
                           <td width="144"><input type="number"  name="amount" id="amount"class="input-medium" value="<?php echo $amount;?>" onChange="settax();"></td>
                           
                        
                      </tr>
                      
                      
                        <tr> 
                        <th>Remark</th>
                        <th>Pay To</th>
                        <th>&nbsp;</th>
                        
                        </tr>  
                        <tr>
                        <td>
                        
                        <textarea name="remark" id="remark"  rows="3" cols="7" class="form-control" style="text-align:left" >
                        <?php echo $remark; ?>
                        </textarea>
                        </td>
                        
                        <td>
                        <input type="text" name="payto" id="payto" value="<?php echo $payto; ?>" class="form-control"  >
                        </td>   
                        
                        <td>&nbsp;  </td>
                        
                        
                        </tr>
                      
                      <tr>
                      <td colspan="3" align="center"> 
                      <center>
                      <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('expencetypeid,expen_date,amount'); ">
								<?php echo $btn_name; ?></button>
                                <a href="other_expense.php"  name="reset" id="reset" class="btn btn-success">Reset</a> 
                               </center> 
                                
                      </td>
                      
                      </tr>
                                              
                    
                       
                       </table>
                               
                     </div>
                     	     <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                         
                        </form>
                    </div>
                  
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
                            <th class="head0">Expense Type</th>
                              <th class="head0">Pay To</th>
                            <th class="head0">Expense Date</th>
                            <th class="head0"> Amount</th>
                             <th class="head0"> Remark</th>
                             
                            <th class="head0">Edit</th>
                            <th class="head0">Delete</th>
                         </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from other_expense where 1=1 order by expen_date desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
											$payto = $row_get['payto']; 
										$amount = $row_get['amount']; 
										$expense_name = $cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$row_get[expencetypeid]'");
										$tax = $cmn->getvalfield($connection,"m_tax","tax","tax_id='$row_get[tax_id]'");
										$taxamt = $amount*$tax/100;
                                         $total =$amount+$taxamt; 
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $expense_name; ?></td> 
                                                   <td><?php echo $payto; ?></td>
                                                 <td><?php echo $cmn->dateformatindia($row_get['expen_date']); ?></td>
                                                  <td><?php echo $row_get['amount']; ?></td>
                                                     <td><?php echo $row_get['remark']; ?></td>
                                                      
                                               <td><a class='icon-edit' title="Edit" href='?expenid=<?php echo  $row_get['expenid'] ; ?>'></a></td>
                                                <td>
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['expenid']; ?>);' style='cursor:pointer'></a>
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
  
   <script>
		
		jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#expen_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
              jQuery("[data-mask]").inputmask();
		 });
		
		
function set_payment(payment_type)
{
	
	if(payment_type != "")
	{
		
		if(payment_type == 'CASH')
		{
			document.getElementById('t1').style.display="none";
			document.getElementById('t2').style.display="none";
		}
		else if(payment_type=='CHEQUE' || payment_type=='NEFT' )
		{
			document.getElementById('t1').style="null";
			document.getElementById('t2').style="null";
		}
		
	}
}	


function settax()
{

	var tax_id=document.getElementById('tax_id').value;
	var amount=document.getElementById('amount').value;
	
	
	if(!isNaN(tax_id) && !isNaN(amount) && tax_id !='')
	{
	jQuery.ajax({
			  type: 'POST',
			  url: 'total_amt.php',
			  data: 'amount='+amount+'&tax_id='+tax_id,
			  dataType: 'html',
			  success: function(data){
				// alert(data);
				 	//document.getElementById("totalamount").innerHTML=data;
				  jQuery("#totalamount").val(data);
				 
			   }
			
			  });//ajax close
	}
	else
	{
		 jQuery("#totalamount").val(amount);
	}
}

</script>



</body>

</html>
