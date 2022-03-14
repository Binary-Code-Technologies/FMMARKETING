<?php 
error_reporting(0);            
include("../adminsession.php");
$pagename = "saleentry.php";
$module = "Add Sale Entry";
$submodule = "Sale Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "saleentry";
$tblpkey = "saleid";
if(isset($_GET['action']))
{
$action = addslashes(trim($_GET['action']));
if($action==1)
{
	$last_bill=trim(addslashes($_GET['last_bill']));
	
}
}
else
{
	$action = "";
}
if(isset($_GET['saleid']))
$keyvalue = $_GET['saleid'];
else
$keyvalue = 0;
if(isset($_POST['submit']))
{
    $billno = trim(addslashes($_POST['billno']));
	$saledate = $cmn->dateformatusa(trim(addslashes($_POST['saledate'])));
	$saletype =  trim(addslashes($_POST['saletype']));
	$suppartyid = trim(addslashes($_POST['suppartyid']));
	$billtype=trim(addslashes($_POST['billtype']));
	$order_by = trim(addslashes($_POST['order_by']));
	$remark = trim(addslashes($_POST['remark']));

	
	if($_POST['disc']!=''){
		$disc = trim(addslashes($_POST['disc']));
	}else{ $disc=0;}
	
	
	
	if($keyvalue == 0 )
	{
	$billno = $cmn->getvalfield($connection,"saleentry","count(*)","sessionid='$sessionid'");
	if($billno=='0')
	{
		$billno = $cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	else
	{
		$billno = $cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	// disc = feight Amount
	$sale_t = $cmn->getvalfield($connection,"saleentry_detail","sum(totalval)","saleid='0'");
 $totalsale=round($sale_t+$disc);
		$form_data = array('billno'=>$billno,'saledate'=>$saledate,'saletype'=>$saletype,'billtype'=>$billtype,'remark'=>$remark,'suppartyid'=>$suppartyid,'order_by'=>$order_by,
						   'disc'=>$disc,'totalsale'=>$totalsale,'sessionid'=>$sessionid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
		dbRowInsert($connection,"saleentry", $form_data);
		$action=1;
		$process = "insert";
		$keyvalue = mysqli_insert_id($connection);
		$suppartyid = $cmn->getvalfield($connection,"saleentry","suppartyid","saleid='$keyvalue'");
		mysqli_query($connection,"update saleentry_detail set saleid='$keyvalue' where saleid='0'");	
		/*echo "<script>window.open('payment_party.php?suppartyid=$suppartyid', '_blank');</script>";*/
		/*echo "<script>window.open('pdf_sale_details_prnita5.php?saleid=$keyvalue', '_blank');</script>";*/
	}
	else
	{
		 $sale_t = $cmn->getvalfield($connection,"saleentry_detail","sum(totalval)","saleid='$keyvalue'");
		 $totalsale=round($sale_t+$disc);
		$form_data = array('billno'=>$billno,'saledate'=>$saledate,'saletype'=>$saletype,'billtype'=>$billtype,'remark'=>$remark,'suppartyid'=>$suppartyid,'order_by'=>$order_by,
						  'disc'=>$disc,'totalsale'=>$totalsale,'sessionid'=>$sessionid,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
		dbRowUpdate($connection,"saleentry", $form_data,"WHERE $tblpkey = '$keyvalue'");
		
		$keyvalue = mysqli_insert_id($connection);
		$action=2;
		$process = "updated";
	}
	$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
	
	
	echo "<script>location='$pagename?action=$action&last_bill=$keyvalue'</script>";
}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 $sqledit    = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit    = mysqli_fetch_array(mysqli_query($connection,$sqledit));
		$keyvalue 	 = $rowedit['saleid'];
		$billno     = $rowedit['billno'];
		$saledate   = $rowedit['saledate'];
		$disc  	 = $rowedit['disc'];	
		$billtype  	 = $rowedit['billtype'];	 
		$suppartyid = $rowedit['suppartyid'];
		$saletype = $rowedit['saletype'];
		$order_by = $rowedit['order_by'];
		$remark = $rowedit['remark'];
	 
}
else
{
	
	$billno = $cmn->getvalfield($connection,"saleentry","count(*)","sessionid='$sessionid'");	
	
	if($billno=='0')
	{
		$billno = $cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	else
	{
		$billno = $cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	
	
	$saletype = "cash";
	$saledate = date('Y-m-d');
	
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
<style>
.textbox { 
    /*background: #FFF url(/input-text-9.png) no-repeat 4px 4px; */
    border: 1px solid #999; 
    outline:0; 
    padding-left: 25px;
    height:25px; 
    width: 275px; 
  } 

</style>
</head>
<body onLoad="getrecord('<?php echo $keyvalue; ?>');">
<div class="mainwrapper">
	
    <!-- START OF LEFT PANEL -->
    <?php include("inc/left_menu.php"); ?>
    
    <!--mainleft-->
    <!-- END OF LEFT PANEL -->
  
    <!-- START OF RIGHT PANEL -->
   <div class="rightpanel">
    	<?php include("inc/header.php"); ?>
        
         <div style="float:left; margin:10px;"  class="par control-group success input-prepend">
         <!-- <span class="add-on" style="display:none;">BARCODE</span>
      <input type="text" style="height:26px;" style="display:none;"  id="productbarcode" placeholder="Search From Barcode" onChange="getproductfrombarcode(this.value);" class="form-control span3" > -->
          </div>
        
      <div style="float:right;">
      
            <input type="button" class="btn btn-primary" style="float:right; margin-top:10px" name="addnew" id="addnew" onClick="add();" 
            value="Show List">
          
           </div>
       <div class="maincontent">
        	 <div class="contentinner content-dashboard">
             <div id="new2">
                <form action="" method="post" onSubmit="return checkinputmaster('suppartyid,billno,billdate,purchase_type');" >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered" style="background-color:#FFF">
							  
							  <tr>
                              <td width="25%" ><strong>Customer Name: <span style="color:#F00;">*</span> </strong><a class="btn btn-success"
                               onClick="jQuery('#myModal1').modal('show');" data-toggle="modal1"><strong>+</strong></a></td>

                               <td width="15%" style="display:none;" ><strong>Consultancy Fees: <span style="color:#F00;">*</span> </strong></td>
                                 <td width="15%" ><strong>Bill No.: <span style="color:#F00;">*</span> </strong></td>
							    <td width="10%" ><strong>Date <span style="color:#F00;">*</span> </strong> </td>
                                 <td width="10%" ><strong>Bill Type:<span style="color:#F00;">*</span></strong></td> 
                                    <!-- <td width="10%" ><strong>Sale Type:<span style="color:#F00;">*</span></strong></td>  -->
                                   <td style="width:15%;"><strong>Order By :</strong></td>
                                <td width="15%" ><strong>Freight Amount (Rs):</strong></td>
                              
						      </tr>
                              
							  <tr>
							     <td>
                                      <select id="suppartyid" name="suppartyid" class="form-control chzn-select" style="background:url(input-text-9.png) no-repeat 4px 4px; width:200px;" onchange="showData(this.value);" >
                                        <option value="">-select-</option>
                                      <!--   <option value="Cash">Cash</option>-->
                                        <?php
											$sql = mysqli_query($connection,"Select suppartyid,supparty_name,mobile from m_supplier_party where type_supparty = 'party'  || type_supparty = 'cash' order by supparty_name");
											if($sql)
											{
												while($row = mysqli_fetch_assoc($sql))
												{
											?>
											 		<option value="<?php echo $row['suppartyid']; ?>"><?php echo strtoupper($row['supparty_name'])." (".$row['mobile']." )"; ?></option>
											<?php
												}
											}
									   ?>
                                       </select>
                                       <script>
                                       document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>';
                                       </script>
									   <input type="text" name="remark" id="remark"  class="form-control"  value="<?php echo $remark ;?>"  style="width:110px; margin-top:-30px; display:none;" autocomplete="off" placeholder="Remark"> 
                                            </td>
                                              <!-- <td>                                           
                                            <input type="number" name="consultancy_fees" id="consultancy_fees" class="form-control text-red"  value=" echo $consultancy_fees ;?>"  style="font-weight:bold; width:150px;" onChange="setTotalrate();" autocomplete="off" required >   
                                            </td> -->
                                   
                                  <td>                                           
                                            <input type="text" name="billno" id="billno" class="form-control text-red"  value="<?php echo $billno ;?>"  style="font-weight:bold;width:100px; " autocomplete="off" readonly >   
                                            </td>
							   
							      <td>                                           
                                            <input type="text" name="saledate" id="billdate" class="form-control text-red" style="font-weight:bold;width:100px; " value="<?php echo $cmn->dateformatindia($saledate);?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  >                                           	
                                            </td >
							 
                                  <!-- <td> <select  name="saletype" class="chzn-select" id="saletype"  style="font-weight:bold;width:100px; ">
                                         <option value="" >-Select-</option>
                                         <option value="Cash">Cash</option>
                            			 <option value="Credit">Credit</option>
                                       </select>
							   		   <script>document.getElementById('saletype').value = '<?php echo $saletype ; ?>';</script>
                                  </td> 
                                   -->
                                     <td> <select  name="billtype" class="chzn-select" id="billtype" style="font-weight:bold;width:100px; " >
                                         <option value="" >-Select-</option>
                                         <option value="Invoice">Invoice</option>
                            			 <option value="Challan">Challan</option>
                                       </select>
							   		   <script>document.getElementById('billtype').value = '<?php echo $billtype; ?>';</script>
                                  </td> 
                                    <td> <input type="text" name="order_by" id="order_by" class="input-xxlarge" value="<?php echo $order_by;?>" style="width:90%;" autocomplete="off"  /></td>        
                                        <td>                                           
                                            <input type="number" name="disc" id="disc" class="form-control text-red"  value="<?php echo $disc;?>"  style="font-weight:bold;width:90px;"   autocomplete="off" onChange="setTotalrate();" >   
                                        </td> 
						      </tr>                                    				
							  </table>
                                </div>
                            <br>
                             <!--span8-->
                    <div >
                 	 <div class="alert alert-success">
                     <table width="100%" class="table table-bordered table-condensed">
                     <tr>
                     	<th width="15%">PRODUCT <a class="btn btn-success btn-small"onClick="jQuery('#myModal_product').modal('show');" data-toggle="modal_product" style="margin-left:20px;"><strong> + </strong></a> </th>
                          <th width="9%">Stock</th>
                        <th width="9%">UOM</th>
                         <!-- <th width="9%">Batch No</th>
                          <th width="9%">Exp. Date</th> -->
                           <th width="9%">Qty</th>
                        <th width="9%">Rate</th>
                        <th width="9%">Disc(%)</th>
						<th width="10%">GST %</th>
                        <th width="9%">GST Amount</th>
                        <th width="12%">Total</th>
                        <th width="10%">Action</th>
                     </tr>
                     <tr>
                     	<td>
                         <select name="productid" id="productid" class="form-control chzn-select"  onChange="getstock();getproductinfo();" >
                         	<option value="" >--Choose Product--</option>
                         <?php
                         $resprod = mysqli_query($connection,"select * from m_product order by prodname");
                         while($rowprod = mysqli_fetch_array($resprod))
                         {
                             $catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid=$rowprod[pcatid]");
                         ?>
                                <option value="<?php echo $rowprod['productid']; ?>"><?php echo $rowprod['prodname']." / ".$catname; ?></option>
                           <?php
                         }
                         ?>
                          </select>
                          </td>
                           <td><input class="input-mini" type="text" name="stock" id="stock" value="" style="width:90%;" readonly></td>
                              <td><input class="input-mini form-control" type="text" name="unit_name" id="unit_name" value="" style="width:90%;" readonly >
                             
                             
                        
                           <input class="input-mini form-control" type="hidden" name="unitid" id="unitid" value="" style="width:90%;">
                           </td>
                            <!-- <td><input class="input-mini" type="text" name="batchno" id="batchno" value="" style="width:90%;"  ></td>
                         
                          <td><input class="input-mini" type="text" name="expiry_date" id="expiry_date" value="" style="width:90%;"  ></td> -->
                           <td><input class="input-mini" type="text" name="qty" id="qty" value="" style="width:90%;" onChange="settotal()"></td>
                           <td><input class="input-mini" type="text" name="rate" id="rate" value="" style="width:90%;" onChange="settotal()" ></td>
                         
                           <td><input class="input-mini" type="text" name="disc_per" id="disc_per" value="" style="width:90%;" onChange="settotal()" ></td>
                         
						   <td>
                            <select name="tax" id="tax" onChange="settotal()" style="width:100px;" >
                            	<!-- <option value="" >--choose tax--</option> -->
                         <?php
                         $restax = mysqli_query($connection,"SELECT * from m_tax where enable='enable' order by tax asc"); 
                         while($rowtax = mysqli_fetch_array($restax))
                         {
                            
                         ?>
                                <option value="<?php echo $rowtax['tax']; ?>"> <?php echo $rowtax['taxname']; ?></option>
                           <?php
                         }
                         ?>
                          </select>
                           </td>
                           
                           
                        <td><input class="input-mini" type="text" name="taxamt" id="taxamt" value="" style="width:90%;" readonly></td>
                        
                        <td><input class="input-mini" type="text" name="total" id="mtotal" value="" style="width:90%;" readonly ></td> 
                          <td>
                           <input type="button" class="btn btn-success" onClick="addlist();" style="margin-left:20px;" value="Add">
                          </td>
                      </tr>
                    </table>
                      </div>
                    </div>
                  <!--span4-->
                  <br>
                    <div class="row-fluid">
                        <div class="span12">
                            <h4 class="widgettitle nomargin"> <span style="color:#00F;" >  Product Details : 
                            </span></h4>
                        
                            <div class="widgetcontent bordered" id="showrecord">
                                
                            </div><!--widgetcontent-->
                     </div>
                 
                </div>
                </form>
                <!--row-fluid-->
                 
                
                </div>
               
                <div id="list" style="display:none">
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
                        	<th width="7%" class="head0 nosort">S.No.</th>
                            <th width="16%" class="head0" >Sale No</th>
                            <th width="11%" class="head0">Sale Date</th>
                          
                            <th width="16%" class="head0" >Customer Name</th>
                          <th width="11%" class="head0" >Sale Type</th>
                            <th width="11%" class="head0" >Amount</th>
                            <th width="11%" class="head0" >Print Out Invoice</th>
                             
                            <th width="14%" class="head0" >Action</th>                          
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;									
									$sql_get = mysqli_query($connection,"Select * from saleentry  order by saledate desc,saleid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid =$row_get['suppartyid'];
										
										 $saleid =$row_get['saleid'];
										 $remark =$row_get['remark'];

										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										//$total = $cmn->getTotalBillAmt($row_get['saleid']);
									//	$igst = $cmn->getTotalIgst_Sale($row_get['saleid']);
									//	$gst = $cmn->getTotalGst($row_get['saleid']);
									//	$total = $total - $disc;
										//$billtype = $row_get['billtype'];
										$disc = $row_get['disc'];
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										$return_amt = $cmn->getvalfield($connection,"salereturn","sum(return_amt)","saleid='$saleid'");
										$totalsale =$row_get['totalsale']-$return_amt;
										$nettot+=$totalsale;
										
										if($supparty_name=="cash"){
											$supparty_name = $supparty_name.' ('.$remark.')';
										}else{
											$supparty_name = $supparty_name;
										}
										 
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                 <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td>
                                                  <td><?php echo $supparty_name;?></td>
                                                   <td><?php echo $row_get['billtype']; ?></td>
                                                   <td><?php echo number_format(round($totalsale),2); ?></td>
                                                 
                                                  
                                                  
                                                   <td>
												 
                                                   <a class="btn btn-success" href="pdf_sale_details_prnita4.php?saleid=<?php echo  $row_get['saleid']; ?>" target="_blank"> <i class="fa fa-print" aria-hidden="true"> Print(A4)</i></a>&nbsp;
												   <a class="btn btn-primary" href="pdf_sale_details_prnita5.php?saleid=<?php echo  $row_get['saleid']; ?>" target="_blank" ><i class="fa fa-print" aria-hidden="true"> Print(A5)</i></a>
                                                   </td>
                                                  
                                                  <td>
                                                   <a class='icon-edit' title="Edit" href='saleentry.php?saleid=<?php echo  $row_get['saleid']; ?>' style='cursor:pointer'></a>
                                                   &nbsp;
                                                <a class='icon-remove' title="Delete" onClick="funDel(<?php echo  $row_get['saleid']; ?>);" style='cursor:pointer'></a>
                                                </td>
                                                 
                                          </tr>
                        <?php
						}
						?>
                        
                       
                    </tbody>
                </table>
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
<div class="modal fade" id="myModal" role="dialog" aria-hidden="true" style="display:none;" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Product</h4>
                    </div>
                        <div class="modal-body">
							<table class="table table-bordered table-condensed">
										<tr>
                                            <th width="18%">Product Name &nbsp;<span style="color:#F00;">*</span></th>
                                            <th width="18%">Unit &nbsp;<span style="color:#F00;">*</span></th>                                           
                                        </tr>
                                        <tr>
                             <td>                                           
                      <input class="form-control" name="mprodname" id="mprodname" value="" autofocus="" type="text" readonly style="z-index:-44;" >
                      <input type="hidden" name="mproductid" id="mproductid"  readonly >                              
                      	 </td>
                        <td>                                           
                         <input class="form-control" name="unit_name" id="munit_name"  value="" autocomplete="off" autofocus="" type="text" readonly >
                         <input type="hidden" name="unitid" id="munitid" readonly > 
                         </td>
                                           
                                        </tr>
                                        
                                        
                                        <tr>
                                          <th>Quantity &nbsp;<span style="color:#F00;">*</span></th>
                                          <th width="18%">Rate &nbsp;<span style="color:#F00;">*</span></th>
                                        </tr>
                                        <tr>  
                                                                                 
                                            <td> 
                   <input class="form-control" name="qty" id="mqty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:60%" onChange="settotalupdate();"  >  
                   <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
                  <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                     </td>
                   <td>                                           
                         <input class="form-control" name="rate" id="mrate"  value="" autocomplete="off" autofocus="" type="text" onChange="settotalupdate();" >      </td>
                                         
                                        </tr>
                            
                        <tr>
                         <th width="9%" style="color:#00F;"><strong>Disc(%) &nbsp;</strong><span style="color:#F00;">*</span></th>
						 <th width="18%" style="color:#00F;"><strong>Total &nbsp;</strong><span style="color:#F00;">*</span></th>
                           
                        </tr>
                        <tr>
                        <td>                                           
                        <input class="form-control" name="mdisc_per" id="mdisc_per"  value="" autocomplete="off" autofocus="" type="text" onChange="settotalupdate();"  >
                        
                        </td>
						<td>                                           
                        
						<input class="form-control" name="total" id="ktotal"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        </td>
                        
                        </tr>
                        <tr>
						<th width="9%" style="color:#00F;"><strong>GST(%)</strong><span style="color:#F00;">*</span></th>
						
						</tr>
                           <tr>
							   <td>                                           
                       
                        <input class="form-control" name="mtax" id="mtax"  value="" autocomplete="off" autofocus="" type="text" onChange="settotalupdate();"  >
                        </td>
						   </tr>    
                       </table>
                        </div>
                        <div class="modal-footer clearfix">
                        <input type="hidden" id="saledetail_id" value="0" >
                         <input type="submit" class="btn btn-primary" name="submit" value="Add" id="saveitem" onClick="updatelist();" >
                           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>
        <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal1">
            <div class="modal-header  alert-info" >
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Customer</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th colspan="1">Customer Name <span style="color:#F00;"> * </span> </th> 
              <!-- <th>Gender <span style="color:#F00;"> * </span> </th>  -->
       
            </tr>
            <tr>
            <td colspan="1"> <input type="text" name="supparty_name"  id="supparty_name" class="form-control" style="width:100%;" autocomplete="off"  />
            </td>
            
            <!-- <td> <select name="gender" id="gender" style="display:none;" class="chzn-select"  style="width:200px;"">
                              <option value=""> Select</option>
                            <option value="Male">Male</option>
                             <option value="Female">Female </option>
                             <option value="Third Gender">Third Gender </option>
                             
                             </select>
                           
            </td> -->
            </tr>
            
              <!-- <tr> 
            
            <th>DOB</th>
                 <th>Age</th>
            </tr>
            <tr>
            <td> <input type="date" name="dob" id="dob" class="input-xxlarge" style="width:80%;" onChange="getAge(this.value);" autocomplete="off"  />
            </td>
            
            <td> <input type="text" name="age" id="age" class="input-xxlarge" style="width:70%;" autocomplete="off" maxlength="10" />
            </td>
            </tr> -->
              <!-- <tr> 
                <th>Reg Date</th>
              <th>Disease Type</th> 
              
            </tr>
            <tr>
            <td> <input type="date" name="regdate" id="regdate" class="input-xxlarge" value="<?php echo date('Y-m-d');?>" style="width:80%;" autocomplete="off" autofocus />
             <td> <select name="disid" id="disid" class="chzn-select" style="width:200px;">
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
                             </td>
            
            </td>
            </tr> -->
            
                <tr> 
                <th>Mobile</th>
              <th>Address</th> 
              
            </tr>
            <tr>
            <td> <input type="text" name="mobile" id="mobile" class="input-xxlarge" style="width:80%;" autocomplete="off" maxlength="10" />
             <td><input type="text" name="address" id="address" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            
            </td>
            </tr>
            
           
             </table>
            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" name="save" id="save" onClick="save_supplier_data();">Save</button>
               <button data-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
    </div>
    
       <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal_payment">
            <div class="modal-header  alert-info" >
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">Customer Payment</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Total Bill Amount</th> 
              <td> <input type="text" name="totalbillamount" id="totalbillamount" class="input-xxlarge" style="width:80%;" autocomplete="off"  readonly />
            </td>
            </tr>
            <tr>
             <th>Previouse Paid Amount</th>
            <td> <input type="text" name="prevamount" id="prevamount" class="input-xxlarge" style="width:80%;" autocomplete="off" readonly />
            </td>
            </tr>
             <tr> 
            <th>Balance Amount</th> 
            <td> <input type="text" name="balanceamount" id="balanceamount" class="input-xxlarge" style="width:80%;" readonly/></td>
            </tr>
            <tr> 
             <th>Currently Paid Amount</th>
            <td> <input type="text" name="payamt" id="payamt" class="input-xxlarge" style="width:80%;" onBlur="checkamount();"  />
            
            <br> <span id="error"  style="color:#F00;"> &nbsp; </span>
            
            </td>
            </tr>
            <tr> 
            <th>Payment Type</th> 
            <td><select name="payment_type" id="payment_type"  class="form-control" onChange="set_payment(this.value);" >
                <option value="">-Select-</option>
                <option value="cash">CASH</option>
                <option value="cheque">CHEQUE</option>
                <option value="neft">NEFT</option>
           </select></td>
            </tr>
             <tr id="cheque_td"> 
              <th>Cheque No</th> 
             <td><input type="text" name="chequeno" id="chequeno" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
             
             </tr>
             <tr id="ref_td">
              <th>Reference No</th>
            <td><input type="text" name="refno" id="refno" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            </tr>
            <tr id="bank_td"> 
              <th>Bank Name</th>
            <td><input type="text" name="bank_name" id="bank_name" class="input-xxlarge" style="width:80%;" autocomplete="off"  autofocus /></td>
            </tr>
             <tr>
             <th>Payment Date</th>
            <td><input type="text" class="input-xxlarge" style="width:80%;" name="paydate" id="paydate" 
                value="<?php if($paydate!='') echo $paydate; else echo date('d-m-Y'); ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask ></td>
            </tr>
             <tr>
             <th> Receipt No </th>
             <td><input type="text" name="receiptno" id="receiptno" class="input-xxlarge" style="width:80%;" autocomplete="off"  autofocus readonly /></td>
            </tr>
             <input type="hidden" name="saleidd" id="saleidd">
             <input type="hidden" name="suppartyidd" id="suppartyidd">
          </table>
            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" name="save" id="save" onClick="save_payment_data();">Save</button>
               <button data-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
    </div>
        
         
    <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal_product">
            <div class="modal-header alert-info">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Product</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Company Name <span style="color:#F00;"> * </span> </th>
             <th>Product Name <span style="color:#F00;"> * </span> </th> 
          
            </tr>
            <tr>
             <td><select name="s_pcatid" id="s_pcatid" class="chzn-select">
                    <option value="">--Choose Categary--</option>
                    <?php
                    $sql=mysqli_query($connection,"select * from m_product_category order by catname");
                    while($row=mysqli_fetch_assoc($sql))
                    {								
                    ?>
                    <option value="<?php echo $row['pcatid'];  ?>"> <?php echo $row['catname']; ?></option>
                    <?php } ?>
                </select></td>
                  <td><input type="text" name="s_prodname" id="s_prodname" class="input-xxlarge"  style="width:80%;"autocomplete="off" autofocus/></td>
           
            </tr>
             <!-- <tr> 
            <th>Batch No. <span style="color:#F00;"> * </span> </th> 
            <th>Expiry Date </th>
            </tr>
            <tr>
            <td><input type="text" name="s_batchno" id="s_batchno" class="input-xxlarge"  style="width:80%;"autocomplete="off" autofocus/></td>
            <td><input type="date" name="s_expiry_date" id="s_expiry_date" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus /> </td>
            </tr> -->
            
            <tr> 
             <th>Unit</th> 
            <th>Opening Stock </th>
            </tr>
            <tr>
            <td><select name="s_unitid" id="s_unitid" class="chzn-select">
                <option value="">--Choose Unit--</option>
                <?php
                $sql=mysqli_query($connection,"select * from m_unit order by unitid");
                while($row=mysqli_fetch_assoc($sql))
                {								
                ?>
                <option value="<?php echo $row['unitid'];  ?>"> <?php echo $row['unit_name']; ?></option>
                <?php } ?>
            </select></td>
            <td><input type="text" name="s_opening_stock" id="s_opening_stock" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus /> </td>
            </tr>
           
            <tr> 
            
            <th>Stock Date </th>
              <th colspan="2">Purchase Rate</th>
          
             
             </tr>
             
              
              <td><input type="text" name="s_stockdate" id="s_stockdate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" /></td>
                <td><input type="text" name="s_pur_rate" id="s_pur_rate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" onChange="settax();" /></td>
          <tr> 
           
                <th>Sale Rate</th> 
            </tr>
           <tr>
           <td> <input type="text" name="s_rate" id="s_rate" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus onChange="settax();" /></td>
           
         
            </tr>
            
             
            
        
             </table>
            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" name="s_save" id="s_save" onClick="save_product_data();">Save</button>
               <button data-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
    </div>
<div class="modal fade" id="myModal2"  role="dialog" aria-hidden="true" style="display:none;" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Product</h4>
                    </div>
                        <div class="modal-body">
							<table class="table table-bordered table-condensed">
										<tr>
                                            <th width="10%">Choose One &nbsp;<span style="color:#F00;">*</span></th>
                                            <th width="20%">
                                                    <select id="typesize" onChange="printbill(this.value);">
                                                    <option value="">Choose Format</option>
                                                    <option value="1">A4 Size</option>
                                                    <!-- <option value="2">A5 Size</option>                                                    -->
                                                    </select>  
                                                   <input type="hidden" id="type" >                                           
                                            </th>                                           
                                        </tr> 
                                        
                                        <tr>
                                            <th width="10%">Bill No &nbsp;<span style="color:#F00;">*</span></th>
                                            <th width="20%">
                                                 <input type="text" id="mbillno" readonly >   
                                                 <input type="hidden" name="msaleid" id="msaleid" >                                          
                                            </th>                                           
                                        </tr> 
                                        
                                             
                                    </table>
                        </div>
                        <div class="modal-footer clearfix">
                         <button type="button" class="btn btn-danger" data-dismiss="modal"   ><i class="fa fa-times"></i> Discard</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>

</body>
<script>
function getrecord(keyvalue){
//alert(keyvalue);
 var suppartyid = jQuery("#suppartyid").val();

		  jQuery.ajax({
		  type: 'POST',
		  url: 'show_salerecord.php',
		  data: "suppartyid="+suppartyid+'&saleid='+keyvalue,
		  dataType: 'html',
		  success: function(data){				  
		//	alert(data);
				jQuery('#showrecord').html(data);					
				setTotalrate();
				
			}
		  });//ajax close
}
function getproductfrombarcode(barcode)
    {
	jQuery.ajax({
					type: 'POST',
					url: 'searchproductbarcode.php',
					data: 'barcode='+barcode+'&process='+'purchase',
					dataType: 'html',
					success: function(data){	
					
					if(data !='0')
					{
					jQuery("#productid").val(data).trigger("liszt:updated");
					getproductinfo();
					document.getElementById('add_data_list').focus();
					}
					else
					{
						alert('No product found');	
					}
					
					}
				
			  });//ajax close
}

function save_supplier_data()
{
	//alert('hi');
        var supparty_name= document.getElementById('supparty_name').value;		
		// var gender = document.getElementById('gender').value;
		// var dob = document.getElementById('dob').value;
		// var age = document.getElementById('age').value;
		// var regdate = document.getElementById('regdate').value;
		// var disid = document.getElementById('disid').value;
		var mobile= document.getElementById('mobile').value;
		var address= document.getElementById('address').value;
		
		
		if(supparty_name == '')
		{
		    alert('Customer name can not be blank!');
			document.getElementById('supparty_name').focus();
			return false;
		}
		else
		{		
		
		  jQuery.ajax({
			  type: 'POST',
			  url: 'save_customer.php',
			  data: 'supparty_name='+supparty_name+'&mobile='+mobile+'&address='+address,
			  dataType: 'html',
			  success: function(data){				  
		   //  alert(data);
				jQuery('#supparty_name').val('');
				
				jQuery('#mobile').val(''); 
				jQuery('#address').val(''); 
				jQuery('#regdate').val(''); 
			
			    jQuery("#myModal1").modal('hide');
				jQuery('#suppartyid').html(data);			
				jQuery("#suppartyid").val('').trigger("liszt:updated");
				jQuery('#suppartyid').val('').trigger('chzn-single:updated');
				jQuery('#suppartyid').trigger('chzn-single:activate'); // for autofocus
				
				
				}
				
			  });//ajax close
				
		}
}
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#s_stockdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
	
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#prevbal_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
	
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#s_manu_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
	
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#s_exp_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });

function save_product_data()
     {
		 //alert('hi');
	var s_prodname = document.getElementById('s_prodname').value;
	var s_unitid =document.getElementById('s_unitid').value;
	var s_rate =document.getElementById('s_rate').value;
	var s_pur_rate =document.getElementById('s_pur_rate').value;
	var s_opening_stock =document.getElementById('s_opening_stock').value;
	var s_stockdate =document.getElementById('s_stockdate').value;
	// var s_expiry_date =document.getElementById('s_expiry_date').value;
	// var s_batchno =document.getElementById('s_batchno').value;

	var s_pcatid =document.getElementById('s_pcatid').value;
	
	
		if(s_pcatid == "")
		{
			alert('Please Fill Category Name');
			document.getElementById('s_pcatid').focus();
			return false;
		}
		
		if(s_prodname == "")
		{
			alert('Please Fill Product Name');
			document.getElementById('s_prodname').focus();
			return false;
		}
		
		else
		{
			//alert(s_prodname='+s_prodname+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc);
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_product.php',
			  data: 's_prodname='+s_prodname+'&s_unitid='+s_unitid+'&s_rate='+s_rate+'&s_pur_rate='+s_pur_rate+'&s_opening_stock='+s_opening_stock+'&s_stockdate='+s_stockdate+'&s_pcatid='+s_pcatid,
			  dataType: 'html',
			  success: function(data){				  
		     // alert(data);
					jQuery('#showallbtn').click();
					jQuery("#s_prodname").val('');
					jQuery("#s_rate").val('');
					jQuery("#s_pur_rate").val('');
					jQuery("#s_barcode").val('');
					jQuery("#s_opening_stock").val('');
					// jQuery("#s_expiry_date").val('');
					// jQuery("#s_batchno").val('');
					jQuery("#s_stockdate").val('');
					jQuery("#s_wholeseller_rate").val('');					
					jQuery("#myModal_product").modal('hide');
					jQuery('#productid').html(data);
					jQuery("#productid").val('').trigger("liszt:updated");
					jQuery('#productid').val('').trigger('chzn-single:updated');
					jQuery('#productid').trigger('chzn-single:activate'); // for autofocus
					getproductinfo();
					
					
				}
				
			  });//ajax close
				
		}
}
function getstock()
   {
	//alert('hi');
	var productid = jQuery("#productid").val();
	//alert(productid1);
	jQuery.ajax({
			  type: 'POST',
			  url: 'getstock.php',
			  data: 'productid='+productid,
			  dataType: 'html',
			  success: function(data){
				  //alert(data);
				jQuery('#stock').val(data);
			
				}
				
			  });//ajax close
}
function getproductinfo()
   {
	//alert('ok');
	var productid = jQuery("#productid").val();
	jQuery.ajax({
			  type: 'POST',
			  url: 'getproductinfo.php',
			  data: 'productid='+productid,
			  dataType: 'html',
			  success: function(data){				  
		        //alert(data);
				var jsonobj = jQuery.parseJSON(data);
				jQuery('#unit_name').val(jsonobj.unit_name);
				jQuery('#unitid').val(jsonobj.unitid);
				if(jsonobj.rate=='0')
				{
					jsonobj.rate='';
				}		
				
				jQuery('#rate').val(jsonobj.rate);
				jQuery('#qty').val('');
				
				
				jQuery('#qty').focus();
				settotal();
			    //jQuery("#myModal_payment").modal('hide');
				}
				
			  });//ajax close
}


function save_payment_data()
     {
        var payamt= document.getElementById('payamt').value;
		var payment_type= document.getElementById('payment_type').value;
		var chequeno= document.getElementById('chequeno').value;
		var refno= document.getElementById('refno').value;
		var bank_name= document.getElementById('bank_name').value;
		var paydate= document.getElementById('paydate').value;		
		var receiptno= document.getElementById('receiptno').value;
		var suppartyid = document.getElementById('suppartyidd').value;
		var saleid= document.getElementById('saleidd').value;
		var pay_mode="received";
		
		
		if(payamt == '')
		{
		    alert('Payment Amount can not be blank!');
			document.getElementById('payamt').focus();
			return false;
		}
		
		if(payment_type == '')
		{
		    alert('Payment Type can not be blank!');
			document.getElementById('payment_type').focus();
			return false;
		}
		
		if(paydate == '')
		{
		    alert('Payment date can not be blank!');
			document.getElementById('paydate').focus();
			return false;
		}
		
		else
		{
			
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_payment.php',
			  data: 'payamt='+payamt+'&payment_type='+payment_type+'&chequeno='+chequeno+'&bank_name='+bank_name+
			   '&paydate='+paydate+'&receiptno='+receiptno+'&suppartyid='+suppartyid+'&saleid='+saleid+'&pay_mode='+pay_mode,
			  dataType: 'html',
			  success: function(data){				  
		    //  alert(data);
				jQuery('#payamt').val('');
				jQuery('#payment_type').val('');
				jQuery('#chequeno').val('');
				jQuery('#suppartyid').val('');
				jQuery('#bank_name').val('');
				jQuery('#paydate').val('');
				jQuery('#ifsc_code').val('');
				jQuery('#receiptno').val('');
				jQuery('#pay_mode').val('');
				jQuery('#saleid').val(''); 
			   jQuery("#myModal_payment").modal('hide');
				}
				
			  });//ajax close
				
		}
}

function deleterecord(saledetail_id)
  {
	 	tblname = 'saleentry_detail';
		tblpkey = 'saledetail_id';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		
		
	if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_master.php',
			  data: 'id='+saledetail_id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				 getrecord('<?php echo $keyvalue; ?>');
				 setTotalrate();
				}
				
			  });//ajax close
		}//confirm close
	
  }

function updaterecord(prodname,productid,unit_name,unitid,rate,qty,disc_per,tax,total,saledetail_id)
  {	
	jQuery("#myModal").modal('show');
	jQuery("#saveitem").attr('value', 'Update');
	jQuery("#mprodname").val(prodname);
	jQuery("#mproductid").val(productid);
	jQuery("#munit_name").val(unit_name);
	jQuery("#munitid").val(unitid);
	jQuery("#mrate").val(rate);
	jQuery("#mqty").val(qty);
	jQuery("#mdisc_per").val(disc_per);
	jQuery("#mtax").val(tax);

	jQuery("#ktotal").val(total);
    jQuery("#saledetail_id").val(saledetail_id);
	settotal();
	jQuery("#qty").focus();	
}
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

function checkamount()
  {
	var balanceamount=parseInt(document.getElementById('balanceamount').value);
	var payamt=parseInt(document.getElementById('payamt').value);
	
	if(!isNaN(payamt))
	{
		if(balanceamount < payamt)
		{
			//alert("You cant pay more than Balance Amount");
			document.getElementById('error').innerHTML="You cant pay more than Balance Amount";
			jQuery('#payamt').val('');
			return false;
		}
		else if(balanceamount >= payamt)
		{
			document.getElementById('error').innerHTML="";
		}
		
	}
}

function set_payment(payment_type)
   {
	if(payment_type != "")
	{
		if(payment_type == 'cash')
		{
			jQuery("#chequeno").val('');
			jQuery("#refno").val('');
			jQuery("#bank_name").val('');
			
			jQuery("#cheque_td").hide();
			jQuery("#bank_td").hide();
			jQuery("#ref_td").hide();
		}
		else if(payment_type=='cheque' || payment_type=='neft' )
		{
			jQuery("#chequeno").val('');
			jQuery("#refno").val('');
			jQuery("#bank_name").val('');
			
			jQuery("#cheque_td").show();
			jQuery("#bank_td").show();
			jQuery("#ref_td").show();
			
		}
	}
}

function setTotalrate()
  {
	var disc= parseFloat(jQuery('#disc').val());
	
	var tot_amt= parseFloat(jQuery('#hidtot_amt').val());
	var tot_tax= parseFloat(jQuery('#tax').val());
	//alert(tot_tax);
	
	if(!isNaN(tot_amt))
	{
	
		
		tot_amt= tot_amt;
	}
	
	if(! isNaN(disc) && !isNaN(tot_amt))
	{
	
		
		tot_amt= tot_amt+disc;
	}
	
	jQuery('#tot_amt').val(tot_amt);
	
	//alert(tot_tax);
	
	if(!isNaN(tot_tax))
	{
		tot_amt = tot_amt + tot_tax;
	}
	//alert(tot_amt);
	jQuery('#netamt').val(tot_amt.toFixed(2));
	
  }  
  
   jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#billdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});               
                jQuery("[data-mask]").inputmask();
		 }); 
   
   function add()
	{		
	//jQuery("#new").toggle(); 
	jQuery("#list").toggle();
	jQuery("#new2").toggle();
	var button_name=jQuery("#addnew").val();
	
	if(button_name =="Show List")
	{
		jQuery("#addnew").val("+ Add New");
	}
	else
	{
		jQuery("#addnew").val("Show List");
	}
		
	}	

	function updatelist()
{
	var  productid= document.getElementById('mproductid').value;
    var  tax= document.getElementById('mtax').value;
	var  unitid= document.getElementById('munitid').value;
	var  qty= document.getElementById('mqty').value;
	var  rate= document.getElementById('mrate').value;
	var  disc_per= document.getElementById('mdisc_per').value;
	var saledetail_id = document.getElementById('saledetail_id').value;	
	var keyvalue = '<?php echo $keyvalue; ?>';
	
		
	if(qty =='' && rate == '')
	{
		alert('Quantity & Rate cant be blank');	
		return false;
		
	}
	else
	{
		jQuery.ajax({
		  type: 'POST',
		  url: 'save_saleproduct.php',
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc_per='+disc_per+'&tax1='+tax+'&saledetail_id='+saledetail_id+'&saleid='+keyvalue,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
			getrecord('<?php echo $keyvalue; ?>');
			
			jQuery('#mproductid').val('');
			
			jQuery('#mqty').val('');
			jQuery('#munit_name').val('');
			jQuery('#munitid').val('');
			jQuery('#mrate').val('');	
			jQuery("#mprodname").val('');
			jQuery("#mtotal").val('');
			jQuery("#mdisc_per").val('');
			jQuery("#mtax").val('');

			jQuery("#myModal").modal('hide');
			getrecord(keyvalue);
			}
			
		  });//ajax close
			
	}
	
}
function addlist()
{
	
	var  productid= document.getElementById('productid').value;
	var  unitid= document.getElementById('unitid').value;
//	var  qty= document.getElementById('qty').value;
	var  rate= document.getElementById('rate').value;
	var  tax1= document.getElementById('tax').value;
//	var  stock= document.getElementById('stock').value;
	var  disc_per= document.getElementById('disc_per').value;
    var qty=parseInt(document.getElementById('qty').value);
    var stock=parseInt(document.getElementById('stock').value);
 
	var saledetail_id = 0;
	var keyvalue = '<?php echo $keyvalue; ?>';
	
	if(qty =='')
	{
		alert('Quantity cant be blank');	
		return false;
	}
	if(rate=='')
	{
		alert('Rate Cant be Zero');
		jQuery("#rate").focus();
		return false;
	}
//	if(stock<=0)
//	{
//		alert('Stock is Empty');
//		jQuery("#stock").focus();
//		return false;
//	}
	
	//	if(stock < qty)
//	{
	//	alert('Stock is not greater then Qty');
	//	jQuery("#stock").focus();
	//	return false;
//	}

	else
	{
		
		jQuery.ajax({
		  type: 'POST',
		  url: 'save_saleproduct.php',		  
		  data: 'tax1='+tax1+'&productid='+productid+'&qty='+qty+'&unitid='+unitid+'&rate='+rate+'&disc_per='+disc_per+'&stock='+stock+'&saledetail_id='+saledetail_id+'&saleid='+keyvalue,		
		  dataType: 'html',
		  success: function(data){	
		 // alert(data);
			getrecord('<?php echo $keyvalue; ?>');
			jQuery('#qty').val('');
			jQuery('#unit_name').val('');
			jQuery('#unitid').val('');
			jQuery('#rate').val('');
			jQuery('#tax').val('');
			jQuery("#productbarcode").val('');
			jQuery('#mtotal').val('');
			jQuery('#stock').val('');
			jQuery('#disc_per').val('');
			jQuery('#taxamt').val('');
			getrecord(keyvalue);
			
			jQuery("#productid").val('').trigger("liszt:updated");
			document.getElementById('productid').focus();
			jQuery(".chzn-single").focus();
		       			
			}
		  });//ajax close
			
	}
	
}
function addproduct(productid,prodname,unit_name,unitid,rate,tax)
{
	var search_supplier = document.getElementById('search_supplier').value;	
	//alert(search_supplier);
	if(search_supplier=='')
	{
		alert('Please Select Customer Name');
		jQuery("#productbarcode").val('');
		return false;
	}
	jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/check_rate.php',
			  data: 'search_supplier='+search_supplier+'&productid='+productid,
			  dataType: 'html',
			  success: function(data){
		      //alert(data);
		    jQuery("#myModal").modal('show');			
			jQuery("#prodname").val(prodname);
			jQuery("#productid").val(productid);
			jQuery("#unit_name").val(unit_name);
			jQuery("#unitid").val(unitid);
			jQuery("#rate").val(data);
			jQuery("#tax").val(tax);
			jQuery("#disc").val('0');
			jQuery("#qty").val('1');
			jQuery("#saveitem").attr('value', 'Add');
			jQuery("#saledetail_id").val('0');
			settotal();
			
			jQuery("#qty").focus();
			 }
						
		 });//ajax close		
}
function settotal()
{
		var qty=parseFloat(jQuery('#qty').val());		
	var rate=parseFloat(jQuery('#rate').val());	
	var disc_per=parseFloat(jQuery('#disc_per').val());
	var tax=parseFloat(jQuery('#tax').val());

	
	if(!isNaN(rate) && !isNaN(qty))
	{
	
		total=	qty * rate;
	
	}
	
	if(!isNaN(disc_per))
	{
	
		discamt=	total * disc_per/100;
		total=	total - discamt;
	
	}

	if(!isNaN(tax))
	{
	
		taxamt =	total * tax/100;
		total=	total + taxamt;
		jQuery('#taxamt').val(taxamt.toFixed(2));
	
	}

	
	
	
	jQuery('#mtotal').val(total.toFixed(2));
	
}	

function settotalupdate()
{
	var qty=parseFloat(jQuery('#mqty').val());	
	var rate=parseFloat(jQuery('#mrate').val());
	var disc_per=parseFloat(jQuery('#mdisc_per').val());
	var tax=parseFloat(jQuery('#mtax').val());
//alert(tax);

		total=	qty * rate;
		if(!isNaN(disc_per))
	{
	
		discamt=	total * disc_per/100;
		total=	total - discamt;
	
	}
	if(!isNaN(tax))
	{
	
		taxamt=	total * tax/100;
		total=	total + taxamt;
		jQuery('#mtax').val(tax.toFixed(2));
	}
	
	
	jQuery('#ktotal').val(total.toFixed(2));
}


  function addqty()
  {
  	var qty = parseInt(document.getElementById('mqty').value);
	
	var addqty1;
	//alert(qty);
	if(!isNaN(qty))
		{
			 addqty1 = parseInt(qty)+1;
		}
 		document.getElementById('mqty').value=addqty1;
		settotalupdate();				
		
  }
  function minusqty()
  {
	  
  	var qty = parseInt(document.getElementById('mqty').value);	
	var addqty1;
	
	if(!isNaN(qty) && qty > 1)
	{
		 addqty1 = parseInt(qty)-1;
		 document.getElementById('mqty').value=addqty1;
		 settotalupdate();
				 
	}else
	alert("Quntity can not be less than 1");
 	
  }
function funDel(id)
	{  
		
		
		// alert(fromdate); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_sale.php',
			  data: 'id='+id,
			  dataType: 'html',
			  success: function(data){
				 
				  //alert(pagename+'?action=3&fromdate='+fromdate+'&todate='+todate);
				   location='saleentry.php?action=3';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close

jQuery(document).ready(function(){
jQuery('#menues').click();
});

function showData(data){
	//alert(data);
	if(data==4){
         jQuery("#remark").show();   
         }else{
			jQuery("#remark").hide();  
		 }
}
		
</script>


</html>
