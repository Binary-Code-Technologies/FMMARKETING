<?php error_reporting(0);                                                                                                   include("../adminsession.php");
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


if(isset($_POST['submit']))
{
	$purchaseid=trim(addslashes($_POST['purchaseid']));
	$billno = trim(addslashes($_POST['billno']));
	$purchasedate = $cmn->dateformatusa(trim(addslashes($_POST['purchasedate'])));
	$purchase_type = trim(addslashes($_POST['purchase_type']));
	$suppartyid = trim(addslashes($_POST['suppartyid']));
	$billtype = trim(addslashes($_POST['billtype']));
	$disc = trim(addslashes($_POST['disc']));
	$packing_charge = trim(addslashes($_POST['packing_charge']));
	$freight_charge = trim(addslashes($_POST['freight_charge']));
    $transport_date = $cmn->dateformatusa(trim(addslashes($_POST['transport_date'])));
	$transport_name  = trim(addslashes($_POST['transport_name']));
	$challan_no    =  trim(addslashes($_POST['challan_no']));
	
	if($purchaseid == 0)
	{
		$form_data = array('billno'=>$billno,'purchasedate'=>$purchasedate,'purchase_type'=>$purchase_type,'suppartyid'=>$suppartyid,'challan_no'=>$challan_no,'packing_charge'=>$packing_charge,'freight_charge'=>$freight_charge,'billtype'=>$billtype,'disc'=>$disc,'transport_name'=>$transport_name,'transport_date'=>$transport_date,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
		dbRowInsert($connection,"purchaseentry",$form_data);
		$action=1;
		$process = "insert";
		$keyvalue = mysqli_insert_id($connection);
		mysqli_query($connection,"update purchasentry_detail set purchaseid='$keyvalue' where purchaseid='0'");	
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		
	}
	else
	{
		$form_data = array('billno'=>$billno,'purchasedate'=>$purchasedate,'purchase_type'=>$purchase_type,'suppartyid'=>$suppartyid,'challan_no'=>$challan_no,'packing_charge'=>$packing_charge,'transport_date'=>$transport_date,'transport_name'=>$transport_name,'freight_charge'=>$freight_charge,'billtype'=>$billtype,'disc'=>$disc,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
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
	$packing_charge  =  $rowedit['packing_charge'];
	$freight_charge  =  $rowedit['freight_charge'];
	$search_supplier = trim($cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'"));
	$transport_name = $rowedit['transport_name'];
	$transport_date  = $rowedit['transport_date'];
	$challan_no      = $rowedit['challan_no'];
}
else
{
	$purchasedate=date('Y-m-d');
	$transport_date=date('Y-m-d');
	$search_supplier="";
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
           <!--<div style="float:left; margin:10px;">
      <input type="text"  id="productbarcode" placeholder="Search From Barcode" onChange="getproductfrombarcode(this.value);" >
           </div>-->
      <div style="float:right;">
 
     
            <input type="button" class="btn btn-primary" style="float:right; margin-top:10px" name="addnew" id="addnew" onClick="add();" 
            value="Show List">
           </div>
        <div class="maincontent">
        	 <div class="contentinner content-dashboard">
             
         
	  <select class="form-control chzn-select" name="test">
      <option>Test-1</option>
      <option>Test-2</option>
      </select>      
      
         
               <div id="new2">               
                <form action="" method="post" onSubmit="return checkinputmaster('suppartyid,billno,purchasedate,billtype,purchase_type');"   >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered">
							  <tr>
                              	
							    <td colspan="9"><strong style="color:#F00;"><?php echo $duplicate; ?></strong></td>
						      </tr>
							  <tr>
                              <td width="25%" ><strong>Supplier Name:<span style="color:#F00;"> * </span> </strong>  <a class="btn btn-success"
                               onClick="jQuery('#myModal_supplier').modal('show');" data-toggle="modal_supplier"><strong>+</strong></a></td>
                                 <td width="15%" ><strong>Bill No. <span style="color:#F00;"> * </span> :</strong></td>
							    <td width="15%" ><strong>Date <span style="color:#F00;"> * </span></strong></td>
                               <td width="15%"><strong>Bill Type : <span style="color:#F00;"> * </span> </strong></td>
						      </tr>
							  <tr>
							     <td>
                                   <select name="suppartyid" id="suppartyid" class="form-control chzn-select" >
                                    
                                    	 <option value="">-select-</option>
                                        <?php
											$sql = mysqli_query($connection,"Select suppartyid,supparty_name from m_supplier_party where type_supparty = 'supplier' order by supparty_name");
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
                                            <input type="text" name="billno" id="billno" class="form-control text-red"  value="<?php echo $billno ;?>"  style="font-weight:bold; text-align:center"  autocomplete="off" >   
                                            </td>
							   
							    <td>                                           
                                            <input type="text" name="purchasedate" id="purchasedate" class="form-control text-red" value="<?php echo $cmn->dateformatindia($purchasedate);?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" >                                           	
                                            </td>
                                            
                                 <td>
                      <select  name="billtype" class="chzn-select" id="billtype" >
                      						<option value="">-Select-</option>
                                                <option value="withouttax">Invoice</option>
                                                <option value="withtax">Challan</option>
                                           </select>
                                           <script>document.getElementById('billtype').value = '<?php echo $billtype ; ?>';</script></td>
                                
						      </tr>
                              
                                <tr>
                                 <td width="25%" ><strong>Discount(Rs):</strong></td>
                                 <td width="15%" ><strong>Purchase Type : <span style="color:#F00;"> * </span></strong></td>
							     <td width="15%" ><strong>Packing Charge</strong></td>
                                 <td width="15%"><strong>Freight Charge</strong></td>
                                
						     </tr>
							  <tr>
							     <td>                                           
                                            <input type="text" name="disc" id="disc" class="form-control text-red"  value="<?php echo $disc;?>"  style="font-weight:bold;"  autocomplete="off" onChange="setTotalrate();" >     
                                            </td>
							   
							          <td>
                                           <select name="purchase_type" class="chzn-select" id="purchase_type">
                                                 <option value="">-Select-</option>
                                                 <option value="cash">Cash</option>
                                                 <option value="credit">Credit</option>
                                               </select>
                                               <script>document.getElementById('purchase_type').value = '<?php echo $purchase_type ; ?>';</script>
                                               </td>
                                               <td>
                                               <input type="text" name="packing_charge" id="packing_charge" class="form-control text-red"  value="<?php echo $packing_charge;?>"  style="font-weight:bold;"  autocomplete="off" onChange="setTotalrate();" >
                                                </td>
                                               
                                               <td>
                                            <input type="text" name="freight_charge" id="freight_charge" class="form-control text-red"  value="<?php echo $freight_charge;?>"  style="font-weight:bold;"  autocomplete="off" onChange="setTotalrate();" >   
                                               </td>
                                              
						      </tr>
                              
                              <tr>
                               <th width="25%" ><strong>Transport Name :</strong></th>
                               <th width="15%"><strong>Transport Date :</strong></th>
                                <th width="15%" colspan="2"></th>
                               
                              </tr>
                               <tr>
                               <td> <input type="text" name="transport_name" id="transport_name" class="form-control text-red"  value="<?php echo $transport_name;?>"  style="font-weight:bold;"  autocomplete="off" > </td>
                                <td> <input type="text" name="transport_date" id="transport_date" class="form-control text-red" value="<?php echo $cmn->dateformatindia($transport_date);?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask autocomplete="off" ></td>
                                <td colspan="2">&nbsp;  </td>
                              </tr>
							  </table>
                    </div>
                     <br>
                     
                     <div >
                 	 <div class="alert alert-success">
                     <table width="100%" class="table table-bordered table-condensed">
                     <tr>
                     	<th width="25%">PRODUCT <a class="btn btn-success btn-small"onClick="jQuery('#myModal_product').modal('show');" data-toggle="modal_product" style="margin-left:20px;"><strong> + </strong></a> </th>
                        <th width="15%">UOM</th>
                        <th width="8%">RATE</th>
                        <th width="8%">QTY</th>
                        <th width="12%">GST %</th>
                        <th width="10%">Tax %</th>
                        <th width="8%">Total</th>
                        <th width="14%">Action</th>
                     </tr>
                     <tr>
                     	<td>
                         <select name="productid" id="productid" class="form-control chzn-select" onChange="getproductdetail(this.value);" >
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
                           <input class="input-mini form-control" type="hidden" name="unitid" id="unitid" value="" style="width:90%;">
                           </td>
                           <td><input class="input-mini" type="text" name="rate" id="rate" value="" style="width:90%;" onChange="settotal()" ></td>
                           <td><input class="input-mini" type="text" name="qty" id="qty" value="" style="width:90%;" onChange="settotal()"></td>
                           
                           <td>
                            <select name="tax_id" id="tax_id" class="form-control" onChange="update_tax(this.value)" >
                            	<option value="" >--choose tax--</option>
                         <?php
                         $restax = mysqli_query($connection,"select * from m_tax where enable='enable' order by tax_id"); 
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
                        <td><input class="input-mini" type="text" name="total" id="total" value="" style="width:90%;"></td> 
                          <td>
                           <input type="button" class="btn btn-success" onClick="addlist();" style="margin-left:20px;" value="Add Product">
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
           
            <div id="list" style="display:none;" >
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
                
            	<table class="table table-bordered" id="dyntable" >
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
                               <th width="9%" class="head0">Bill Type</th>
                            <th width="6%" class="head0" >Amount</th>
                            <th width="13%" class="head0" >Customer Name</th>
                            <th width="26%" colspan="2" style="text-align:center;">Print</th>
                             <th width="10%" class="head0" >Action</th>                          
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									
									$sql_get = mysqli_query($connection,"Select * from purchaseentry where purchaseid <> 0 order by purchaseid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid = $row_get['suppartyid'];
										$disc =$row_get['disc'];
										$packing_charge =$row_get['packing_charge'];
										$freight_charge =$row_get['freight_charge'];
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										$total = $cmn->getTotalPerchaseBillAmt($connection,$row_get['purchaseid']);	
										$gst = $cmn->getTotalGst_pur($connection,$row_get['purchaseid']);
										$total = $total - $disc+$packing_charge+$freight_charge;
										$billtype = $row_get['billtype'];
										
										if($billtype=="withouttax")
										{
											$billname="Invoice";
										}
										else
										{
											$billname="Challan";
										}
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['purchasedate']); ?></td>
                                                
                                                <td><?php echo $row_get['purchase_type']; ?></td>
                                                <td><?php echo $billname; ?></td>
                                                                                               
                                                 <td><?php echo number_format(round($total+$gst),2); ?></td>
                                                  <td><?php echo $supparty_name; ?></td>
                                                  
                                                   <td>  <?php if($billtype=="withtax"){ ?>&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-primary btn-sm" href="pdf_purchase_chalana5.php?purchaseid=<?php echo  $row_get['purchaseid']; ?>" target="_blank" >Challan </a> <?php }?> &nbsp;
                                                   
                                                    <?php if($billtype=="withouttax") {?><a class="btn btn-success" href="pdf_purchase_invoceta5.php?purchaseid=<?php echo  $row_get['purchaseid']; ?>" target="_blank" > Invoice A5</a> 
                                                   
                                                   </td>
                                                   <td>
												   
												  <a class="btn btn-danger" href="pdf_purches_invoice.php?purchaseid=<?php echo  $row_get['purchaseid']; ?>" target="_blank" > Invoice A4 </a><?php } ?></td>
                                                 
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
                   <input class="form-control" name="mqty" id="mqty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:60%" onChange="settotal();"  >  
                   <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
                  <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                                        
                                           </td>
                                           
                                            <td>                                           
                         <input class="form-control" name="mrate" id="mrate"  value="" autocomplete="off" autofocus="" type="text" onChange="settotal();" >
                        
                                         </td>
                                         
                                        </tr>
                                        
                               <tr>
                               
                                <th width="18%">Tax &nbsp;<span style="color:#F00;">*</span></th>
                              
                               </tr>
                               <tr>
                                       
                                       
                                         

                                          <td>                                           
                           <select name="mtax_id" id="mtax_id" onChange="getgst(this.value);" >
                        	<option value="">--Select Tax--</option>
                          <?php 						 
						  $sql=mysqli_query($connection,"select * from m_tax where enable='enable' order by taxname");
                           while($row=mysqli_fetch_assoc($sql))
						   {
						   ?>
                           	<option value="<?php echo $row['tax_id']; ?>"><?php echo $row['taxname']; ?></option>
                            <?php 
						   }
							?>
                        </select>
                          </td>
                             </tr>
                       
                        
                        <tr> 
                       
                        <th width="18%" style="color:#00F;"><strong>Total &nbsp;</strong><span style="color:#F00;">*</span></th>
                        </tr>
                        <tr>
                       
                      
                         <td>                                           
                        <input class="form-control" name="total" id="total"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        
                        </td>
                        
                        </tr>       
                       </table>
                        </div>
                        <div class="modal-footer clearfix">
                        <input type="hidden" id="saledetail_id" value="0" >
                         <input type="submit" class="btn btn-primary" name="submit" value="Add" onClick="addlist();" id="saveitem" >
                           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>
        
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" class="modal hide fade in" id="myModal_product">
            <div class="modal-header alert-info">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Product</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Category Name <span style="color:#F00;"> * </span> </th>
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
            <th>HSN No</th>
            </tr>
            <tr>
            <td><input type="text" name="s_prodname" id="s_prodname" class="input-xxlarge"  style="width:80%;"autocomplete="off" autofocus/></td>
            <td><input type="text" name="s_hsn_no" id="s_hsn_no" class="input-xxlarge"  style="width:80%;"autocomplete="off" autofocus/></td>
            </tr>
           
            <tr> 
            <th>Opening Stock </th>
            <th>Stock Date </th>
             </tr>
            <tr> 
              <td><input type="text" name="s_opening_stock" id="s_opening_stock" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus /> </td>
              
              <td><input type="text" name="s_stockdate" id="s_stockdate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" /></td>
             </tr>
             
          <tr> 
            <th>Retailer Rate</th> 
           <th>Purchase Rate</th>  
            </tr>
           <tr>
           
           <td> <input type="text" name="s_rate" id="s_rate" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus onChange="settax();" /></td>
            <td><input type="text" name="s_pur_rate" id="s_pur_rate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" onChange="settax();" /></td>
            </tr>
            
             <tr> 
            <th colspan="2">Tax</th>
            </tr>
            <tr>
            
            <td colspan="2"><select name="s_tax_id" id="s_tax_id"  class="chzn-select" onChange="settax();" >
            <option value="">--Choose Tax--</option>
            <?php 
            $sql_tax=mysqli_query($connection,"select * from m_tax where enable='enable' order by taxname");
            while($row_tax=mysqli_fetch_assoc($sql_tax))
            {
            ?>
            <option value="<?php echo $row_tax['tax_id'];  ?>" > <?php echo $row_tax['taxname'];  ?> </option>
            <?php } ?>
            
            </select>  </td>
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
            <td> <input type="text" name="supparty_name" id="supparty_name" class="input-xxlarge" style="width:80%;" autocomplete="off"  />
            </td>
            
            <td> <input type="text" name="mobile" id="mobile" class="input-xxlarge" style="width:80%;" autocomplete="off" maxlength="10" />
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
	

	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}	
	
	if(!isNaN(tax))
	{
		taxamt= (total * tax)/100;
		total= total + taxamt;
	}
	
	jQuery('#total').val(total.toFixed(2));
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
		   '&ifsc_code='+ifsc_code+'&bank_address='+bank_address+'&address='+address+'&prevbalance='+prevbalance
		  +'&prevbal_date='+prevbal_date,
		  dataType: 'html',
		  success: function(data){				  
		   //alert(data);			
			jQuery('#supparty_name').val('');
			jQuery('#mobile').val('');
			jQuery('#bank_name').val('');
			jQuery('#bank_ac').val('');
			jQuery('#ifsc_code').val('');
			jQuery('#bank_address').val('');
			jQuery('#address').val('');
			jQuery('#prevbalance').val(''); 
			jQuery('#prevbal_date').val('');
			jQuery('#tinno').val('');
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
	var s_unitid = document.getElementById('s_unitid').value;
	var s_rate = document.getElementById('s_rate').value;
	var s_pur_rate = document.getElementById('s_pur_rate').value;
	var s_opening_stock = document.getElementById('s_opening_stock').value;
	var s_stockdate = document.getElementById('s_stockdate').value;
	var s_tax_id = document.getElementById('s_tax_id').value;
	var s_pcatid = document.getElementById('s_pcatid').value;
	var s_hsn_no = document.getElementById('s_hsn_no').value;
			
			
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
			
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_product.php',
			  data: 's_prodname='+s_prodname+'&s_unitid='+s_unitid+'&s_rate='+s_rate+'&s_pur_rate='+s_pur_rate+'&s_opening_stock='+s_opening_stock+'&s_stockdate='+s_stockdate+'&s_tax_id='+s_tax_id+'&s_hsn_no='+s_hsn_no+'&s_pcatid='+s_pcatid,
			  dataType: 'html',
			  success: function(data){				  
		    //alert(data);
			 		
					jQuery('#showallbtn').click();
					jQuery("#s_prodname").val('');
					jQuery("#s_rate").val('');
					jQuery("#s_pur_rate").val('');
					jQuery("#s_opening_stock").val('');
					jQuery("#s_stockdate").val('');
					jQuery("#s_hsn_no").val('');
					jQuery("#myModal_product").modal('hide');
					jQuery('#productid').html(data);
					jQuery("#productid").val('').trigger("liszt:updated");
					jQuery('#productid').val('').trigger('chzn-single:updated');
					jQuery('#productid').trigger('chzn-single:activate'); // for autofocus
				}
				
			  });//ajax close
				
		}	
}


function getproductdetail(productid)
{
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
					rate=arr[2];
					tax_id=arr[3].trim();
					tax=arr[4].trim();
					
					jQuery('#unitid').val(unitid);						
					jQuery('#unit_name').val(unit_name);
					jQuery('#rate').val(rate);
					jQuery('#tax_id').val(tax_id);
					jQuery('#tax').val(tax);
					}
				
			  });//ajax close
	}
}



  
function addlist()
{
	var  productid= document.getElementById('productid').value;
	var  unitid= document.getElementById('unitid').value;
	var  qty= document.getElementById('qty').value;
	var  rate= document.getElementById('rate').value;
	var tax_id= document.getElementById('tax_id').value;
	var tax= document.getElementById('tax').value;
	
	
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
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+
		   '&tax_id='+tax_id+'&tax='+tax,
		  dataType: 'html',
		  success: function(data){				  
		 // alert(data);
			
			//setTotalrate();
			jQuery('#productid').val('');
			//jQuery('#prodname').val('');
			jQuery('#rate').val('');
			jQuery('#qty').val('');
			jQuery('#unit_name').val('');
			jQuery('#unitid').val('');
			jQuery('#tax_id').val('');
			jQuery('#tax').val('');
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
	
	if(!isNaN(disc) && !isNaN(tot_amt))
	{
		tot_amt= tot_amt-disc;
		jQuery('#tot_amt').val(tot_amt.toFixed(2));
	}
	
	jQuery('#tot_amt').val(tot_amt);
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
						arr=data.split('|');
						productid=arr[0];
						prodname=arr[1];
						unit_name=arr[2];
						unitid=arr[3];
						rate=arr[4];
						tax_id=arr[5].trim();
						
					addproduct(productid,prodname,unit_name,unitid,rate,tax_id);
					}
					else
					{
						alert('No product found');	
					}
					
					}
				
			  });//ajax close
}


function updaterecord(prodname,productid,unit_name,unitid,stock,rate,qty,tax_id,total,purdetail_id)
{

	var billtype = document.getElementById('billtype').value;
	if(billtype=='')
		{
			alert('Please select Bill Type');
			jQuery("#billtype").focus();
			return false;
		}
			jQuery("#myModal").modal('show');
			jQuery("#saveitem").attr('value', 'Update');
			jQuery("#prodname").val(prodname);
			jQuery("#productid").val(productid);
			jQuery("#unit_name").val(unit_name);
			jQuery("#unitid").val(unitid);
			jQuery("#rate").val(rate);
			jQuery("#tax_id").val(tax_id);
			jQuery("#mdisc").val(disc);
			jQuery("#qty").val(qty);
			jQuery("#m_stock").val(stock);
			jQuery("#purdetail_id").val(purdetail_id);
			settotal();	
			jQuery("#qty").focus();
		
}
</script>


</body>

</html>
