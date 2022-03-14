<?php error_reporting(0);      
include("../adminsession.php");
$pagename = "payment_party.php";
$module = "Payment";
$submodule = "Payment Customer";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "payment";
$tblpkey = "payid";
if(isset($_GET['payid']))
$keyvalue = $_GET['payid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_GET['suppartyid']))
{
$suppartyid = $_GET['suppartyid']; 
$prevbalance = $cmn->getvalfield($connection,"m_supplier_party","prevbalance","suppartyid = '$suppartyid'");
$totalpaid=$cmn->getvalfield($connection,"payment","sum(payamt)","suppartyid='$suppartyid'");

      $sql_get = "select * from saleentry where suppartyid = '$suppartyid'";
	   $res_get = mysqli_query($connection,$sql_get);
	   $total_bill_amt = 0;
	   $tot_paid_amt=0;
	
	   while($row_get = mysqli_fetch_array($res_get))
	   {
		    $bill_amt=0;
		   	$total = 0;
		   	$saleid = $row_get['saleid'];
		 	$disc  = $row_get['disc'];
			$totalsale  = $row_get['totalsale'];
		
		 		   
			// $total = $cmn->getTotalBillAmt($row_get['saleid']);
			// $gst = $cmn->getTotalGst($row_get['saleid']);
			// $igst = $cmn->getTotalIgst_Sale($row_get['saleid']);
			//$bill_amt = $total +$gst+$igst;
		   
		 //  $totalsale -=$disc; 
		   $total_bill_amt += $totalsale;
		   
	   }
	    $total_bill_amt += $prevbalance; 
		$cur_bal_amt = $total_bill_amt-$totalpaid;
}


if(isset($_POST['submit']))
{
	$payid = $_POST['payid'];
	$suppartyid = $_POST['suppartyid'];
	$companyid = $_POST['companyid'];
	$payamt = $_POST['payamt'];
	$payment_type = $_POST['payment_type'];
	$receiptno=$_POST['receiptno'];
	$bank_name = $_POST['bank_name'];
	
	
	$pay_mode="received";
	$chequeno ='';
	$refno = '';
	$bankid = '';
	if($payment_type == 'CHEQUE')
	{
		$chequeno = $_POST['chequeno'];
		$bank_name = $_POST['bank_name'];
		$refno = $_POST['refno'];
	}
	else if($payment_type == 'RTGS')
	{
		$refno = $_POST['refno'];
		$bank_name = $_POST['bank_name'];
	}
	else if($payment_type == 'NEFT')
	{
		$chequeno = $_POST['chequeno'];
		$refno = $_POST['refno'];
		$bank_name = $_POST['bank_name'];
	}
	
	$paydate = $cmn->dateformatusa($_POST['paydate']);
	
	if($payid == 0)
	{
		//insert		
		$sql_ins = mysqli_query($connection,"Insert into $tblname set suppartyid = '$suppartyid',payamt = '$payamt' ,payment_type = '$payment_type',chequeno = '$chequeno',refno = '$refno',bank_name = '$bank_name',sessionid='$sessionid',receiptno='$receiptno',paydate = '$paydate', pay_mode='$pay_mode',createdate = now(),createdby='$loginid'");
		if($sql_ins)
		$action = 1;
	}
	else
	{
		//update
		$sql_up = mysqli_query($connection,"Update $tblname set suppartyid = '$suppartyid',payamt = '$payamt' ,payment_type = '$payment_type',chequeno = '$chequeno',refno = '$refno',bank_name = '$bank_name',receiptno='$receiptno',paydate = '$paydate',pay_mode='$pay_mode',lastupdated = now(),createdby='$loginid' where payid = '$payid'");
		if($sql_up)
		$action = 2;
	}
		
		 echo "<script>location='$pagename?suppartyid=$suppartyid&action=$action'</script>";
	}

if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 //echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit   = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit   = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $suppartyid  =  $rowedit['suppartyid'];
	 $payamt  =  $rowedit['payamt'];
	 $paydate  =  $cmn->dateformatindia($rowedit['paydate']);
	 $payment_type =  $rowedit['payment_type'];
	 $receiptno  =  $rowedit['receiptno'];
	 
	$chequeno =  $rowedit['chequeno'];
	$refno    =  $rowedit['refno'];
	$bank_name =  $rowedit['bank_name'];
	 
	 
	 
		$prevbalance = $cmn->getvalfield($connection,"m_supplier_party","prevbalance","suppartyid = '$suppartyid'");
		$totalpaid=$cmn->getvalfield($connection,"payment","sum(payamt)","suppartyid='$suppartyid'");

      $sql_get = "select * from saleentry where suppartyid = '$suppartyid'";
	   $res_get = mysqli_query($connection,$sql_get);
	   $total_bill_amt = 0;
	   $tot_paid_amt=0;
	
	   while($row_get = mysqli_fetch_array($res_get))
	   {
		    $bill_amt=0;
		   	$total = 0;
		   	$saleid = $row_get['saleid'];
		 	$disc  = $row_get['disc']; 
		
		 		   
			 $total = $cmn->getTotalBillAmt($row_get['saleid']);
			 $gst = $cmn->getTotalGst($row_get['saleid']);
			  $igst = $cmn->getTotalIgst_Sale($row_get['saleid']);
			$bill_amt = $total +$gst+$igst;
		   
		   $bill_amt -=$disc; 
		   $total_bill_amt += $bill_amt;
		   
	   }
	    $total_bill_amt += $prevbalance; 
		$cur_bal_amt = $total_bill_amt-$totalpaid;
	
		
}
else
{
	$receiptno=$cmn->getrec($connection,$tblname,$tblpkey,"pay_mode='received'");
	$paydate=date('d-m-Y');
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
                                <label>Customer Name <span class="text-error">*</span></label>
                                <span class="field">
                                <select name="suppartyid" id="suppartyid" style="width:80%;" onChange="getdetail(this.value)"  class="chzn-select">
                                	<option value="">--Choose Customer--</option>
                                    <?php
									$sql=mysqli_query($connection,"select * from m_supplier_party where type_supparty='party' order by supparty_name");
									while($row=mysqli_fetch_assoc($sql))
									{								
									?>
                                    <option value="<?php echo $row['suppartyid'];  ?>"> <?php echo $row['supparty_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>'; </script>
                      </span>
                     </div>
                     
                     
                     
                       <div class="lg-12 md-12 sm-12">
                                <label>Total Bill Amount(Rs)</label>
                                <span class="field"><input type="text" name="total_bill_amt" id="total_bill_amt" class="input-xxlarge" value="<?php echo round($total_bill_amt);?>" style="width:80%;" autocomplete="off" autofocus readonly  /></span>
                     </div>
                     
                      <div class="lg-12 md-12 sm-12">
                                <label> Total Paid Amount(Rs)</label>
                                <span class="field"> 
                                <input type="text" name="tot_paid_amt" id="tot_paid_amt" class="input-xxlarge" value="<?php echo $totalpaid;?>" style="width:80%;" autocomplete="off" autofocus  readonly />
                       			 </span>
                     </div>
                     
                     <div class="lg-12 md-12 sm-12">
                                <label> Current Bal. Amount(Rs)</label>
                                <span class="field"> <input type="text" name="cur_bal_amt" id="cur_bal_amt" class="input-xxlarge" value="<?php echo round($cur_bal_amt);?>" style="width:80%;" autocomplete="off" autofocus  readonly /> </span>
                     </div>
                     
                     <div class="lg-12 md-12 sm-12">
                                <label>Payment Type <span class="text-error">*</span></label>
                                <span class="field" >                               
                                <select name="payment_type" id="payment_type" style="width:80%;"  class="chzn-select" onChange="set_payment(this.value);">
                                <option value="">--Choose Payment Type--</option>
                                  <option value="CASH">CASH</option>
                                   <option value="CHEQUE">CHEQUE</option>
                                    <option value="NEFT">NEFT</option>
                                     <option value="QR">QR</option>
                                    </select>
                                  <script> document.getElementById('payment_type').value='<?php echo $payment_type; ?>'; </script>  
                                    
                     			 </span>
                     </div>
                   
                      <div class="lg-12 md-12 sm-12" id="cheque_td" <?php if($payment_type=='' || $payment_type=='CASH') { ?> style="display:none;" <?php } ?>>
                                <label>Cheque No.<span class="text-error">*</span> </label>
                                <span class="field"> <input type="text" name="chequeno" id="chequeno" class="input-xxlarge" value="<?php echo $chequeno;?>" style="width:80%;" autocomplete="off" autofocus /> </span>
                     </div>
                     
                      <div class="lg-12 md-12 sm-12" id="ref_td" <?php if($payment_type=='' || $payment_type=='CASH') { ?> style="display:none;" <?php } ?>>
                                <label>Reference NO. <span class="text-error">*</span> </label>
                                <span class="field"> <input type="text" name="refno" id="refno" class="input-xxlarge" value="<?php echo $refno;?>" style="width:80%;" autocomplete="off" autofocus /> </span>
                     </div>
                     
                    
                     
                      <div class="lg-12 md-12 sm-12" id="bank_td" <?php if($payment_type=='' || $payment_type=='CASH') { ?> style="display:none;" <?php } ?> >
                                <label>Bank Name <span class="text-error">*</span></label>
                                <span class="field">
                                
                                <input type="text" name="bank_name" id="bank_name" class="input-xxlarge" value="<?php echo $bank_name;?>"/>
                      </span>
                     </div>
                     
                      <div class="lg-12 md-12 sm-12">
                                <label>Currently Paid Amount(Rs) <span class="text-error">*</span> </label>
                                <span class="field"> <input type="text" name="payamt" id="payamt" class="input-xxlarge" value="<?php echo $payamt;?>" style="width:80%;" autocomplete="off" autofocus /> </span>
                     </div>
                     
                     
                     
                     
                     
                     <div class="lg-12 md-12 sm-12">
                                <label>Payment Date<span class="text-error">*</span> </label>
                                <span class="field">
                              <input type="text" name="paydate" id="paydate" class="input-xxlarge" value="<?php echo $paydate;?>" style="width:80%;" autocomplete="off" autofocus placeholder="dd-mm-yyyy" />
                                 </span>
                     </div>
                     
                       <div class="lg-12 md-12 sm-12">
                                <label>Receipt No<span class="text-error">*</span> </label>
                      <span class="field">
                      <input type="text" name="receiptno" id="receiptno" class="input-xxlarge" value="<?php echo $receiptno;?>" style="width:80%;" autocomplete="off" autofocus readonly />
                      </span></div>
                     
                   <div class="lg-12 md-12 sm-12">                        	                                              
                                                         
                          <center> <p class="stdformbutton">
                    <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('suppartyid,payment_type,payamt,paydate,receiptno'); ">
								<?php echo $btn_name; ?></button>
                                <a href="payment_party.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                       
                    </div>
                     </form>
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
                        	
                          	<th class="head0 nosort">S.No.</th>
                            <th class="head0">Receipt No</th>
                            <th class="head0">Customer Name</th>
                            <th class="head0">Paid Amount</th>
                            <th class="head0">Date</th>
                            <th class="head0">Print Reciept</th>
                            <th  class="head0">Edit</th>
                            <th class="head0">Delete</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from payment where suppartyid='$suppartyid' order by paydate desc,payid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['receiptno']; ?></td> 
                                    <td><?php echo $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$row_get[suppartyid]'"); ?></td> 
                                                 <td><?php echo $row_get['payamt']; ?></td> 
                                                  <td><?php echo $cmn->dateformatindia($row_get['paydate']); ?></td> 
                                                  
                                                  <td><a class="btn btn-danger" target="_blank" href='pdf_paid_receipt.php?payid=<?php echo  $row_get['payid'] ; ?>'>Print</a></td>
                                                  <td><a class='icon-edit' title="Edit" href='?payid=<?php echo  $row_get['payid'] ; ?>'></a></td>
                                   <td><a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['payid']; ?>);' style='cursor:pointer'></a> </td>
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
		imgpath = '<?php echo $imgpath; ?>';
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_image_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath,
			  dataType: 'html',
			  success: function(data){
				 //alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
	
	
function getdetail(suppartyid)
{
	if(suppartyid !='' )
	{
		window.location.href='?suppartyid='+suppartyid;	
	}
	
}
		
		

		
 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#paydate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                               
                //Money Euro
                jQuery("[data-mask]").inputmask();
 });
 
 
 
 function set_payment(payment_type)
{
	
	if(payment_type != "")
	{
		
		if(payment_type == 'CASH')
		{
			
			 jQuery("#chequeno").val('');
			jQuery("#refno").val('');
			jQuery("#bankid").val('');			
			jQuery("#cheque_td").hide();
			jQuery("#bank_td").hide();
			jQuery("#ref_td").hide();
		}
		else if(payment_type=='CHEQUE' || payment_type=='NEFT' )
		{
			jQuery("#chequeno").val('');
			jQuery("#refno").val('');
			jQuery("#bankid").val('');			
			jQuery("#cheque_td").show();
			jQuery("#bank_td").show();
			jQuery("#ref_td").show();
		}
		
	}
}
			

  </script>
  



</body>

</html>
