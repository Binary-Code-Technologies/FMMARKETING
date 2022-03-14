<?php 
//error_reporting(0);
include("../adminsession.php");
$pagename = "purchaseentry.php";
$module = "Add Purchase Entry";
$submodule = "Purchase Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "purchaseentry";
$tblpkey = "purchaseid";
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_GET['purchaseid']))
 $keyvalue = $_GET['purchaseid'];
else
$keyvalue = 0;

$duplicate ='';
 $pur_t = $cmn->getvalfield($connection,"purchasentry_detail","sum(totalval)","purchaseid='$keyvalue'");

if(isset($_POST['submit']))
{
	$purchaseid=trim(addslashes($_POST['purchaseid']));
	$billno = trim(addslashes($_POST['billno']));
	$purchasedate = $cmn->dateformatusa(trim(addslashes($_POST['purchasedate'])));
	$purchase_type = trim(addslashes($_POST['purchase_type']));
	$suppartyid = trim(addslashes($_POST['suppartyid']));
	$billtype = trim(addslashes($_POST['billtype']));
	$disc = trim(addslashes($_POST['disc']));
	
	$truckNumber = trim(addslashes($_POST['truckNumber']));	
	$driverName  = trim(addslashes($_POST['driverName']));
	$driverMob  = trim(addslashes($_POST['driverMob']));
	
  
	
	
	if($purchaseid == 0)
	{
		$pur_t = $cmn->getvalfield($connection,"purchasentry_detail","sum(totalval)","purchaseid='0'");
	 $total_pur=round($pur_t);
		$form_data = array('billno'=>$billno,'purchasedate'=>$purchasedate,'purchase_type'=>$purchase_type,'suppartyid'=>$suppartyid,'total_pur'=>$total_pur,'billtype'=>$billtype,'disc'=>$disc,'ipaddress'=>$ipaddress,'truckNumber'=>$truckNumber,'driverName'=>$driverName,'driverMob'=>$driverMob,'sessionid'=>$sessionid,'createdate'=>$createdate,'createdby'=>$loginid);
		dbRowInsert($connection,"purchaseentry",$form_data);
		$action=1;
		$process = "insert";
		$keyvalue = mysqli_insert_id($connection);
		mysqli_query($connection,"update purchasentry_detail set purchaseid='$keyvalue' where purchaseid='0'");	
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		
	
	}
	else
	{
		  $pur_t = $cmn->getvalfield($connection,"purchasentry_detail","sum(totalval)","purchaseid='$keyvalue'");
		 $total_pur=round($pur_t);
		$form_data = array('billno'=>$billno,'purchasedate'=>$purchasedate,'purchase_type'=>$purchase_type,'suppartyid'=>$suppartyid,'total_pur'=>$total_pur,'billtype'=>$billtype,'disc'=>$disc,'ipaddress'=>$ipaddress,'truckNumber'=>$truckNumber,'driverName'=>$driverName,'driverMob'=>$driverMob,'lastupdated'=>$createdate,'createdby'=>$loginid);
		dbRowUpdate($connection,"purchaseentry", $form_data,"WHERE $tblpkey = '$keyvalue'");
		$keyvalue = mysqli_insert_id($connection);
		$action=2;
		$process = "updated";
	}

	echo "<script>location='$pagename?action=$action'</script>";
		
	}
if(isset($_GET[$tblpkey]))
{
	$btn_name = "Update";
	
	$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	$rowedit = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	$billno  =  $rowedit['billno'];
	$purchasedate  =  $rowedit['purchasedate'];
	$purchase_type  =  $rowedit['purchase_type'];
	$suppartyid  =  $rowedit['suppartyid'];
	$billtype  =  $rowedit['billtype'];
	$disc  =  $rowedit['disc'];	
	$truckNumber  =  $rowedit['truckNumber'];	
	$driverName  =  $rowedit['driverName'];	
	$driverMob  =  $rowedit['driverMob'];	
	
}
else
{
	$purchasedate=date('Y-m-d');
	$transport_date=date('Y-m-d');
	$billno  = '';	
	$purchase_type  = '';
	$suppartyid  = '';
	$billtype  = '';
	$disc  = '';	
	$freight_charge  = '';
	$transport_name = '';
	$challan_no      = '';
	$truckNumber  =  '';	
	$driverName  = '';	
	$driverMob  = '';
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
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
        <!-- <div style="float:left; margin:10px;" class="par control-group success input-prepend">
         <span class="add-on">BARCODE</span>
      <input type="text" style="height:26px;"  id="productbarcode" placeholder="Search From Barcode" onChange="getproductfrombarcode(this.value);" class="form-control span3" >
          </div>-->
      <div style="float:right;">
 
     
            <input type="button" class="btn btn-primary" style="float:right; margin-top:10px" name="addnew" id="addnew" onClick="add();" 
            value="Show List">
           </div>
        <div class="maincontent">
        	 <div class="contentinner content-dashboard">
       
         
               <div id="new2">               
                <form action="" method="post" onSubmit="return checkinputmaster('suppartyid,billno,purchasedate,purchase_type');"   >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered">
							  <tr>
                              	
							    <td colspan="9"><strong style="color:#F00;"><?php echo $duplicate; ?></strong></td>
						      </tr>
							  <tr>
                              <td width="10%" ><strong>Supplier Name:<span style="color:#F00;"> * </span> </strong>  <a class="btn btn-success" onClick="showmodel();"><strong>+</strong></a></td>
                                 <td width="10%" ><strong>Bill No. <span style="color:#F00;"> * </span> :</strong></td>
							    <td width="10%" ><strong>Date <span style="color:#F00;"> * </span></strong></td>
                                 <th width="10%"><strong>Truck Number :   </strong></th>
                                <th width="10%"><strong>Driver Name :</strong></th>
                               <th width="10%"><strong>Driver Mobile :</strong></th>
                            <td width="10%" ><strong>Purchase Type : <span style="color:#F00;"> * </span></strong></td>
                               
						      </tr>
							  <tr>
							     <td>
                                   <select name="suppartyid" id="suppartyid" class="form-control chzn-select" style="width:200px;" >
                                     <option value="">-select-</option>
                                        <?php
											$sql = mysqli_query($connection,"Select suppartyid,supparty_name from m_supplier_party where type_supparty = 'supplier' || type_supparty = 'cash' order by supparty_name");
											if($sql)
											{
												while($row = mysqli_fetch_assoc($sql))
												{
											?>
											 <option value="<?php echo $row['suppartyid']; ?>"><?php echo strtoupper($row['supparty_name']); ?></option>
											<?php
												}
											}
									   ?>
                                       
                                    </select>
                                    
                                  <script> document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>'; </script>  
                                  </td>
                                 <td>                                           
                                            <input type="text" name="billno" id="billno" class="form-control text-red"  value="<?php echo $billno ;?>"  style="font-weight:bold; text-align:center;width:100px;"  autocomplete="off" >   
                                            </td>
							   
							    <td>                                           
                                            <input type="text" name="purchasedate" id="purchasedate" class="form-control text-red" style="width:120px;" value="<?php echo $cmn->dateformatindia($purchasedate);?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" >                                           	
                                            </td>
                                               
									
                                   <td> <input type="text" name="truckNumber" id="truckNumber" class="form-control text-red"  value="<?php echo $truckNumber;?>"  style="font-weight:bold;width:120px;"  autocomplete="off"  > </td>
                                   
                                       <td> <input type="text" name="driverName" id="driverName" class="form-control text-red" value="<?php echo $driverName;?>" autocomplete="on" style="width:120px;"  ></td>                              
                                              <td> <input type="text" name="driverMob" id="driverMob" class="form-control text-red" value="<?php echo $driverMob;?>"  autocomplete="on" style="font-weight:bold;width:100px;" ></td> 
								  
                                            
                                 <td>
                                           <select name="purchase_type" class="chzn-select" id="purchase_type" style="width:120px;">
                                                 <option value="">-Select-</option>
                                                 <option value="Invoice">Invoice</option>
                            			 		<option value="Challan">Challan</option>
                                               </select>
                                               <script>document.getElementById('purchase_type').value = '<?php echo $purchase_type ; ?>';</script>
                                               </td>           
                                 
                                
						      </tr>       
                                            <input type="hidden" name="freight_charge" id="freight_charge" class="form-control text-red"  value="<?php echo $freight_charge;?>"  style="font-weight:bold;"  autocomplete="off" onChange="setTotalrate();" >   
                                                <input type="hidden" name="billtype" id="billtype" class="form-control text-red"  value="<?php echo $billtype;?>"  style="font-weight:bold;"  autocomplete="off" onChange="setTotalrate();" >  
                                                 <input type="hidden" name="disc" id="disc" class="form-control text-red"  value="<?php echo $disc;?>"  style="font-weight:bold;"  autocomplete="off" onChange="setTotalrate();" >   
                              
							  </table>
                    </div>
                     <br>
                     
                     <div >
                 	 <div class="alert alert-success">
                     <table width="100%" class="table table-bordered table-condensed">
                     <tr>
                     	<th width="15%">PRODUCT <a class="btn btn-success btn-small"onClick="jQuery('#myModal_product').modal('show');" data-toggle="modal_product" style="margin-left:20px;"><strong> + </strong></a> </th>
                         
                        <th width="9%">UOM</th>
                      
                           <th width="9%">QTY</th>
                            <!-- <th width="9%">Free Qty</th> -->
                        <th width="9%">RATE</th>
                       
                        <th width="9%">Disc(%)</th>
                      
                        <th width="10%">GST %</th>
                        <th width="9%">Tax %</th>
                      
                        <th width="12%">Total</th>
                        <th width="10%">Action</th>
                     </tr>
                     <tr>
                     	<td>
                         <select name="productid" id="productid" class="form-control chzn-select" onChange="getproductdetail();" >
                         	<option value="" >--Choose Product--</option>
                         <?php
                         $resprod = mysqli_query($connection,"select * from m_product order by prodname");
                         while($rowprod = mysqli_fetch_array($resprod))
                         {
                             $catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid=$rowprod[pcatid]");
                         ?>
                                <option value="<?php echo $rowprod['productid']; ?>"><?php echo "(".$rowprod['prod_code'].") ".$rowprod['prodname']." / ".$catname; ?></option>
                           <?php
                         }
                         ?>
                          </select>
                          </td>
                          
                              <td><input class="input-mini form-control" type="text" name="unit_name" id="unit_name" value="" style="width:90%;" readonly >
                             
                               <td><input class="input-mini" type="text" name="qty" id="qty" value="" style="width:90%;" onChange="settotal()"></td>
                                <!-- <td><input class="input-mini" type="text" name="disc_per" id="disc_per" value="" style="width:90%;" ></td> -->
                        
                           <input class="input-mini form-control" type="hidden" name="unitid" id="unitid" value="" style="width:90%;">
                           </td>
                           <td><input class="input-mini" type="text" name="rate" id="rate" value="" style="width:90%;" onChange="settotal()" ></td>
                         
                           <td><input class="input-mini" type="text" id="disc_per" value="" style="width:90%;" onChange="settotal()"></td>
                         
                           
                           <td>
                            <select name="tax_id" id="tax_id" onChange="update_tax(this.value)" style="width:200px;" >                            
                         <?php
                         $restax = mysqli_query($connection,"select * from m_tax where enable='enable' order by tax asc"); 
                         while($rowtax = mysqli_fetch_array($restax))
                         {
                            
                         ?>
                                <option value="<?php echo $rowtax['tax_id']; ?>"> <?php echo $rowtax['taxname']; ?></option>
                           <?php
                         }
                         ?>
                          </select>
                           </td>
                           
                           
                        <td><input class="input-mini" type="text" name="tax" id="tax" value="" style="width:90%;" readonly></td>
                        
                        <td><input class="input-mini" type="text" name="total" id="total" value="" style="width:90%;" readonly ></td> 
                          <td>
                           <input type="button" class="btn btn-success" onClick="addlist();" style="margin-left:20px;" value="Add">
                          </td>
                      </tr>
                    </table>
                      </div>
                    </div>
                    
                    
                <div class="row-fluid">
                	<div class="span12">
                    	<h4 class="widgettitle nomargin"> <span style="color:#00F;" > Product Details : <span id="inentryno" > </span>
                        
                        </span></h4>
                        
                    
                        <div class="widgetcontent bordered" id="showrecord">
                        	
                        </div><!--widgetcontent-->
                  </div>
                  <!--span8-->
                  
               
                </div>
                </form>
          
                
            </div>
            
            
            
           
            <div id="list" style="display:none;"  >
           <h4 class="widgettitle"><?php echo $submodule; ?> List <a href="excel_purchase_entry.php" class="btn btn-info" style="float:right;">Excel</a></h4>
                
                
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
                            <th width="5%" class="head0 nosort">S.No.</th>
                            <th width="8%" class="head0" >Purchase No</th>
                            <th width="10%" class="head0">Purchase Date</th>
                            <th width="13%" class="head0">Purchase Type</th>
                           
                            <th width="6%" class="head0" >Amount</th>
                            <th width="13%" class="head0" >Supplier Name</th>                        
                            <th width="26%" class="head0" style="text-align:center;">Print A4</th>
                            <th width="10%" class="head0" >Action</th>                          
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									
									$sql_get = mysqli_query($connection,"Select * from purchaseentry order by purchasedate desc,purchaseid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid = $row_get['suppartyid'];
										$disc =$row_get['disc'];
										$total_pur =$row_get['total_pur'];
										//$freight_charge =$row_get['freight_charge'];
										//$freight_tax=0;
										
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										
									//	$total = $cmn->getTotalPerchaseBillAmt($connection,$row_get['purchaseid']);	
										
										
										
									//	$gst = $cmn->getTotalGst_pur($connection,$row_get['purchaseid']);
									//	$total = $total - $disc+$packing_charge+$freight_charge;
									
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['purchasedate']); ?></td>
                                                <td><?php echo $row_get['purchase_type']; ?></td>
                                                   
                                                 <td><?php echo number_format(round($total_pur),2); ?></td>
                                                  <td><?php echo $supparty_name; ?></td>
                                                  
                                                 
                                                   <td>
										 
												  <a class="btn btn-danger" href="pdf_purchase_invoicea4.php?purchaseid=<?php echo  $row_get['purchaseid']; ?>" target="_blank" > Invoice A4 </a></td>
                                                 
                                                   <td>
                                                   <a class='icon-edit' title="Edit" href='purchaseentry.php?purchaseid=<?php echo  $row_get['purchaseid']; ?>' style='cursor:pointer'></a>
                                                   &nbsp;
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['purchaseid']; ?>);' style='cursor:pointer'></a>
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
                         <input class="form-control" name="munit_name" id="munit_name"  value="" autocomplete="off" autofocus="" type="text" readonly >
                         <input type="hidden" name="munitid" id="munitid" readonly > 
                         </td>
                                           
                                        </tr>
                                        
                                        <tr>
                                         
                                          <th>Quantity &nbsp;<span style="color:#F00;">*</span></th>
                                            <th width="18%">Rate &nbsp;<span style="color:#F00;">*</span></th>
                                         
                                       
                                        </tr>
                                        <tr>  
                                                                                  
                                            <td> 
                   <input class="form-control" name="mqty" id="mqty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:60%" onChange="settotalupdate();"  >  
                   <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
                  <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                                        
                                           </td>
                                             <td>                                           
                         <input class="form-control" name="mrate" id="mrate"  value="" autocomplete="off" autofocus="" type="text" onChange="settotalupdate();" >
                        
                                         </td>
                                          
                                           
                                          
                                         
                                        </tr>
                              
                             
                             <tr>
                               <th width="18%">Tax &nbsp;<span style="color:#F00;">*</span></th>
                             <th> Disc(%) &nbsp;  </th>
                                                  
                             </tr>
                             
                             <tr> 
                             <td>                                           
                           <select name="mtax_id" id="mtax_id" onChange="getgst(this.value);" >
                        	<option value="">--Select Tax--</option>
                          <?php 						 
						  $sql=mysqli_query($connection,"select * from m_tax where enable='enable' order by tax");
                           while($row=mysqli_fetch_assoc($sql))
						   {
						   ?>
                           	<option value="<?php echo $row['tax_id']; ?>"><?php echo $row['taxname']; ?></option>
                            <?php 
						   }
							?>
                        </select>
                          </td>                            
                             <td> 
                              <input class="form-control" id="m_disc_per"  value="" autocomplete="off" autofocus="" type="text" onChange="settotalupdate();" >    </td>
                              
                                                 
                             </tr>
                             
                             <tr>
                             
                             			<th width="18%" style="color:#00F;"><strong>Total &nbsp;</strong><span style="color:#F00;">*</span></th>
                             			<th>&nbsp;</th>
                             
                             </tr>
                             
                             <tr>
                                    <td>                                           
                                    <input class="form-control" name="total" id="mtotal"  value="" autocomplete="off" autofocus="" type="text" readonly >   </td>   
                                    <td>&nbsp; </td>
                             </tr>                      
                        
                        
                       </table>
                        </div>
                        <div class="modal-footer clearfix">
                        <input type="hidden" id="purdetail_id" value="0" >
                          <input type="hidden" id="mtax" value="0" >
                         <input type="submit" class="btn btn-primary" name="submit" value="Add" onClick="updatelist();" id="saveitem" >
                           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

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
            <th>Unit</th> 
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
            </tr>
             <tr> 
            <th>Product Name <span style="color:#F00;"> * </span> </th> 
            <th>Opening Stock </th>
            </tr>
            <tr>
            <td><input type="text" name="s_prodname" id="s_prodname" class="input-xxlarge"  style="width:80%;"autocomplete="off" autofocus/></td>
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
    
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" class="modal hide fade in" id="myModal_supplier">

            <div class="modal-header alert-info">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Supplier</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Supplier Name &nbsp;<span style="color:#F00">*</span></th> 
            <th>Mobile Number</th>
            </tr>
            <tr>
            <td> <input type="text" name="supparty_name" id="supparty_name" autofocus  class="input-xxlarge"  style="width:80%;"  />
            </td>
            
            <td> <input type="text" name="mobile" id="mobile" class="input-xxlarge"  style="width:80%;" autocomplete="off" maxlength="10" />
            </td>
            </tr>
             <tr> 
            <th>Bank Name</th> 
            <th>Bank A/c</th>
            </tr>
            <tr>
            <td> <input type="text" name="bank_name" id="bank_name" class="input-xxlarge" style="width:80%;"/></td>
            <td> <input type="text" name="bank_ac" id="bank_ac" class="input-xxlarge" style="width:80%;"  /></td>
            </tr>
            
           <tr> 
            <th>IFSC Code</th> 
            <th>Bank Address</th>
            </tr>
            
             <tr>
            <td><input type="text" name="ifsc_code" id="ifsc_code" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            <td><input type="text" name="bank_address" id="bank_address" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            </tr>
             <tr> 
              <th>Supplier Address</th> 
              <th>Opening Balance &nbsp;</th>
            </tr>
            <tr>
             <td><input type="text" name="address" id="address" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            <td><input type="text" name="prevbalance" id="prevbalance" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            </tr>
             <tr> 
              <th>Opening Balance Date &nbsp;</th> 
              <th>GSTIN No</th>
            </tr>
            <tr>
             <td><input type="text" name="prevbal_date" id="prevbal_date" class="input-xxlarge" style="width:80%;" autocomplete="off"  autofocus /></td>
            <td><input type="text" name="tinno" id="tinno" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            </tr>
            
            
             </table>
            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" name="save" id="save" onClick="save_supplier_data();">Save</button>
               <button data-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
    </div>       
        
<script>

function showmodel()
{	
	jQuery("#myModal_supplier").modal('show');
	jQuery("#supparty_name").focus();	
}




function funDel(id)
{  //alert(id);   
    ltblname = 'purchasentry_detail';
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



	

function update_tax(tax_id)
{
	var productid=jQuery('#productid').val();
	
		if(!isNaN(tax_id))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/get_tax.php',
			  data: 'tax_id='+tax_id+'&productid='+productid,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				// arr=data.split("|");
				jQuery('#tax').val(data);
				settotal();
				}
				
			  });//ajax close
		}	
	
}

function settotal()
{
	var qty=parseFloat(jQuery('#qty').val());		
	var rate=parseFloat(jQuery('#rate').val());	
  
	var tax=parseFloat(jQuery('#tax').val());		
	var disc=parseFloat(jQuery('#disc_per').val());	
	
	//alert(sale_unit);
		
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}	
	
	if(!isNaN(disc))
	{
		discamt= (total * disc)/100;
		total= total - discamt;
	}
	
	if(!isNaN(tax))
	{
		taxamt= (total * tax)/100;
		total= total + taxamt;
	}
	
		
	
	jQuery('#total').val(total.toFixed(2));
}	


function settotalupdate()
{
	var qty=parseFloat(jQuery('#mqty').val());	
	var rate=parseFloat(jQuery('#mrate').val());
	var disc=parseFloat(jQuery('#m_disc_per').val());
	var tax=parseFloat(jQuery('#mtax').val());
	
//alert(tax);

	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}	
	
	if(!isNaN(disc))
	{
		discamt= (total * disc)/100;
		total= total - discamt;
	}
	
	if(!isNaN(tax))
	{
		taxamt= (total * tax)/100;
		total= total + taxamt;
	}
	
	
	jQuery('#mtotal').val(total.toFixed(2));
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
	
	
</script>
 
<script>

	function getrecord(keyvalue){
	  var suppartyid=jQuery("#suppartyid").val();	
			  jQuery.ajax({
			  type: 'POST',
			  url: 'show_purchaserecord.php',
			   data: "suppartyid="+suppartyid+'&purchaseid='+keyvalue,
			  dataType: 'html',
			  success: function(data){				  
				//alert(data);
					jQuery('#showrecord').html(data);
					setTotalrate();				
				}				
			  });//ajax close								
	}




 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#exp_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});               
                jQuery("[data-mask]").inputmask();
		 });
 
 
  
 
 


jQuery(document).ready(function(){
   
   jQuery('#menues').click();
  
   });
	
function save_supplier_data()
{
	var supparty_name = document.getElementById('supparty_name').value;
	var mobile = document.getElementById('mobile').value;
	var bank_name = document.getElementById('bank_name').value;
	var bank_ac = document.getElementById('bank_ac').value;
	var ifsc_code = document.getElementById('ifsc_code').value;
	var bank_address = document.getElementById('bank_address').value;
	var stateid = document.getElementById('stateid').value;
	var address = document.getElementById('address').value;
	var prevbalance = document.getElementById('prevbalance').value;
	var prevbal_date = document.getElementById('prevbal_date').value;
	var tinno = document.getElementById('tinno').value;
	
	
	if(supparty_name == '')
	{
		alert('Supplier name can not be blank!');
		document.getElementById('supparty_name').focus();
		return false;
	}
	else
	{
		jQuery.ajax({
		  type: 'POST',
		  url: 'save_supplier.php',
		  data: 'tinno='+tinno+'&supparty_name='+supparty_name+'&mobile='+mobile+'&bank_name='+bank_name+'&bank_ac='+bank_ac+
		   '&ifsc_code='+ifsc_code+'&bank_address='+bank_address+'&address='+address+'&stateid='+stateid+'&prevbalance='+prevbalance
		  +'&prevbal_date='+prevbal_date,
		  dataType: 'html',
		  success: function(data){				  
		 //  alert(data);			
			jQuery('#supparty_name').val('');
			jQuery('#mobile').val('');
			jQuery('#bank_name').val('');
			jQuery('#bank_ac').val('');
			jQuery('#ifsc_code').val('');
			jQuery('#bank_address').val('');
			jQuery('#address').val('');
			jQuery('#prevbalance').val(''); 
			jQuery('#prevbal_date').val('');
			jQuery('#stateid').val('');
			jQuery('#tinno').val('');
			jQuery('#suppartyid').html(data);
			 jQuery("#myModal_supplier").modal('hide');
			jQuery("#suppartyid").val('').trigger("liszt:updated");
			jQuery('#suppartyid').val('').trigger('chzn-single:updated');
			jQuery('#suppartyid').trigger('chzn-single:activate'); // for autofocus
			
			}
		  });//ajax close
			
	}
}

jQuery(function() {
			//Datemask dd/mm/yyyy
			jQuery("#prevbal_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
			//Datemask2 mm/dd/yyyy
		 
			jQuery("[data-mask]").inputmask();
	 });


jQuery(function() {
			//Datemask dd/mm/yyyy
			jQuery("#s_stockdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
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
	var s_prodname = document.getElementById('s_prodname').value;
	var s_unitid =document.getElementById('s_unitid').value;
	var s_rate =document.getElementById('s_rate').value;
	var s_pur_rate =document.getElementById('s_pur_rate').value;
	var s_opening_stock =document.getElementById('s_opening_stock').value;
	var s_stockdate =document.getElementById('s_stockdate').value;

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

function getproductdetail(productid)
{
	//alert('hi');
	var productid=jQuery("#productid").val();
	if(!isNaN(productid))
	{
		jQuery.ajax({
					type: 'POST',
					url: 'ajaxgetproductdetail.php',
					data: 'productid='+productid+'&process='+'purchase',
					dataType: 'html',
					success: function(data){				  
					//alert(data);
					
					arr=data.split('|');
					unitid=arr[0].trim();						
					unit_name=arr[1];					
					if(arr[2]=='0')
					{
					arr[2]='';
					}						
					rate=arr[2];
					tax_id=arr[3].trim();
					tax=arr[4].trim();
					jQuery('#tax_type').val('exc');
					jQuery('#unitid').val(unitid);						
					jQuery('#unit_name').val(unit_name);
					jQuery('#rate').val(rate);
					jQuery('#tax_id').val(tax_id);
					jQuery('#tax').val(tax);
					jQuery('#qty').focus();
					
					}
				
			  });//ajax close
	}
}



  
function addlist()
{
	//alert('hi');
	var  productid= document.getElementById('productid').value;
	var  unitid= document.getElementById('unitid').value;
    var  qty= document.getElementById('qty').value;
	var  rate= document.getElementById('rate').value;
	var tax_id= document.getElementById('tax_id').value;
	var tax= document.getElementById('tax').value;
	var disc_per = document.getElementById('disc_per').value;
	var purdetail_id= 0;	
	var disc=jQuery('#disc_per').val();	
	
	var purchaseid='<?php echo $keyvalue; ?>';
	
		
	if(qty =='')
	{
		alert('Quantity cant be blank');	
		return false;
	}
	if(rate=='')
	{
		alert('Rate Cant be Zero');
		jQuery("#billtype").focus();
		return false;
	}
	else
	{
	
		jQuery.ajax({
		  type: 'POST',
		  url: 'save_purchaseproduct.php',
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&disc_per='+disc_per+'&rate='+rate+'&disc='+disc+'&tax_id='+tax_id+'&tax='+tax+'&purchaseid='+purchaseid+'&purdetail_id='+purdetail_id,
		  dataType: 'html',
		  success: function(data){				  
		// alert(data);	
		
			jQuery('#productid').val('');		
			jQuery('#rate').val('');
			jQuery('#qty').val('');
			jQuery('#unit_name').val('');
			jQuery('#unitid').val('');
			jQuery('#tax_id').val('');
			jQuery('#tax').val('');
			jQuery('#disc_per').val('');
			jQuery('#disc_per').val('');
			jQuery('#productbarcode').val('');
			jQuery('#total').val('');
			
			//jQuery("#myModal").modal('hide');
			getrecord('<?php echo $keyvalue ?>');
				
			
			jQuery("#productid").val('').trigger("liszt:updated");
			document.getElementById('productid').focus();
			jQuery(".chzn-single").focus();
				
		//	jQuery('#productid').focus();
	//	jQuery("#productid").val('').trigger("liszt:updated");
			
			}
			
		  });//ajax close
	}
}


function updatelist()
{
 	var  productid= document.getElementById('mproductid').value;
	var  unitid= document.getElementById('munitid').value;
	var  qty= document.getElementById('mqty').value;
	var  rate= document.getElementById('mrate').value;
	var tax_id= document.getElementById('mtax_id').value;
	var purdetail_id= document.getElementById('purdetail_id').value;	
	var disc = document.getElementById('m_disc_per').value;

	var keyvalue = '<?php echo $keyvalue; ?>';
	

	
	if(qty =='')
	{
		alert('Quantity cant be blank');	
		return false;
	}
	if(rate=='')
	{
		alert('Rate Cant be Zero');
		jQuery("#billtype").focus();
		return false;
	}
	else
	{
	
		jQuery.ajax({
		  type: 'POST',
		  url: 'save_purchaseproduct.php',
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc+
		   '&tax_id='+tax_id+'&purdetail_id='+purdetail_id+'&purchaseid='+keyvalue,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
			
			//setTotalrate();
			jQuery('#mproductid').val('');
			//jQuery('#prodname').val('');
			jQuery('#mrate').val('');
			jQuery('#m_disc_per').val('');
			jQuery('#mqty').val('');
			jQuery('#munit_name').val('');
			jQuery('#munitid').val('');
			jQuery('#mtax_id').val('');
				jQuery('#mtax').val('');
			jQuery('#mdisc_rs').val('');
			jQuery('#purdetail_id').val('');
			
			//jQuery('#productbarcode').val('');				
			jQuery("#myModal").modal('hide');
			getrecord(<?php echo $keyvalue ?>);
			
			}
			
		  });//ajax close
	}
}


function setTotalrate()
{
	var disc= parseFloat(jQuery('#disc').val());  
	var tot_amt= parseFloat(jQuery('#hidtot_amt').val());
	var tot_tax= parseFloat(jQuery('#tot_tax_gst').val());
	var packing_charge= parseFloat(jQuery('#packing_charge').val());  
	var freight_charge= parseFloat(jQuery('#freight_charge').val()); 
	var tot_disc_per=parseFloat(jQuery('#tot_disc_per').val())
	
		
	if(!isNaN(disc) && !isNaN(tot_amt))
	{
		tot_amt= tot_amt-disc;
		jQuery('#tot_amt').val(tot_amt.toFixed(2));
	}
	jQuery('#tot_amt').val(tot_amt);
	
	if(!isNaN(tot_disc_per) && !isNaN(tot_amt))
	{
		tot_amt=tot_amt-tot_disc_per;
	}
	
	if(!isNaN(tot_tax))
	{
		tot_amt = tot_amt + tot_tax;
	}
	//alert(tot_amt);
	
	if(!isNaN(packing_charge))
	{
		tot_amt = tot_amt+packing_charge 
	}
	if(!isNaN(freight_charge))
	{
		tot_amt=tot_amt+ freight_charge;
	}
	
	jQuery('#netamt').val(tot_amt.toFixed(2));
}  
  
 
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
	
	
	
 function deleterecord(purdetail_id)
  {
	 	tblname = 'purchasentry_detail';
		tblpkey = 'purdetail_id';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';		
	if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_master.php',
			  data: 'id='+purdetail_id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				 getrecord('<?php echo $keyvalue; ?>');
				 setTotalrate();
				}
				
			  });//ajax close
		}//confirm close
	
  }
   
function getproductfrombarcode(barcode)
{
	jQuery.ajax({
					type: 'POST',
					url: 'searchproductbarcode.php',
					data: 'barcode='+barcode+'&process='+'purchase',
					dataType: 'html',
					success: function(data){				  
					//alert(data);
					
					if(data !='0')
					{
						jQuery("#productid").val(data).trigger("liszt:updated");
						getproductdetail();
						document.getElementById('add_data_list').focus();
					}
					else
					{
						alert('No product found');	
					}
					
					}
				
			  });//ajax close
}

function updaterecord(prodname,productid,unit_name,unitid,rate,qty,tax_id,tax,total,purdetail_id,disc)
{

	
			jQuery("#myModal").modal('show');
			jQuery("#saveitem").attr('value', 'Update');
			jQuery("#mprodname").val(prodname);
			jQuery("#mproductid").val(productid);
			jQuery("#munit_name").val(unit_name);
			jQuery("#munitid").val(unitid);
			jQuery("#mrate").val(rate);
			jQuery("#mtax_id").val(tax_id);		
				jQuery("#mtax").val(tax);
			jQuery("#mqty").val(qty);
			jQuery("#m_disc_per").val(disc);				
			jQuery("#purdetail_id").val(purdetail_id);
		settotalupdate();
			jQuery("#qty").focus();
		
}
</script>


</body>

</html>
