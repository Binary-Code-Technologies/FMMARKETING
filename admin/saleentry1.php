<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "saleentry.php";
$module = "Add Sale Entry";
$submodule = "Sale Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "saleentry";
$tblpkey = "saleid";
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_GET['saleid']))
$keyvalue = $_GET['saleid'];
else
$keyvalue = 0;
if(isset($_POST['submit']))
{

    $billno = trim(addslashes($_POST['billno']));
	$saledate = $cmn->dateformatusa(trim(addslashes($_POST['saledate'])));
	$saletype =  trim(addslashes($_POST['saletype']));
	$suppartyid= trim(addslashes($_POST['suppartyid']));
	$billtype=trim(addslashes($_POST['billtype']));
	$disc=trim(addslashes($_POST['disc']));
	if($keyvalue == 0 )
	{
		
			$form_data = array('billno'=>$billno,'saledate'=>$saledate,'saletype'=>$saletype,'suppartyid'=>$suppartyid,
							   'billtype'=>$billtype,'disc'=>$disc,'ipaddress'=>$ipaddress,'createdate'=>$createdate);
			dbRowInsert($connection,"saleentry", $form_data);
			$action=1;
			$process = "insert";
			$keyvalue = mysqli_insert_id($connection);
			
	mysqli_query($connection,"update saleentry_detail set saleid='$keyvalue' where saleid='0'");	
			
			
	}
	else
	{
		$form_data = array('billno'=>$billno,'saledate'=>$saledate,'saletype'=>$saletype,'suppartyid'=>$suppartyid,
							   'billtype'=>$billtype,'disc'=>$disc,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate);
			dbRowUpdate($connection,"saleentry", $form_data,"WHERE $tblpkey = '$keyvalue'");
			$keyvalue = mysqli_insert_id($connection);
			$action=2;
			$process = "updated";
		
	}
		
	
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		
		/*if($action==1)
		{
		echo "<script> window.open('pdf_inentry_recipt.php?saleid=$keyvalue','_blank');</script>";
		}
*/
		echo "<script>location='$pagename?action=$action'</script>";
	}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 //echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit    = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit    = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $keyvalue 	 = $rowedit['saleid'];
	 $billno     =  $rowedit['billno'];
	 $saledate   =  $rowedit['saledate'];
	 $saletype   =  $rowedit['saletype'];
	$billtype    =  $rowedit['billtype'];
	$disc  		 =  		$rowedit['disc'];
	$suppartyid  =  $rowedit['suppartyid'];
	
}
else
{
	$billno=$cmn->getcode($connection,$tblname,$tblpkey,"1=1");	
}

?>
<!DOCTYPE html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
 
<link rel="stylesheet" href="../chosen/docsupport/style.css">
  <link rel="stylesheet" href="../chosen/docsupport/prism.css">
  <link rel="stylesheet" href="../chosen/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
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
        
         <div>
        
          <select data-placeholder="Choose a Country..." class="chosen-select" style="width:350px;" tabindex="2">
            <option value=""></option>
            <option value="United States">United States</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Western Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
          </select>
        </div>
        
      <div style="float:right;">
            <input type="button" class="btn btn-primary" style="float:right; margin-top:10px" name="addnew" id="addnew" onClick="add();" 
            value="Show List">
           </div>
       <div class="maincontent">
        	 <div class="contentinner content-dashboard">
             
             <div id="new2">
            	             
                              
                <form action="" method="post" onSubmit="return checkinputmaster('suppartyid,billno,billdate,billtype,purchase_type');" >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered">
							  
							  <tr>
                              <td width="25%" ><strong>Customer Name: <span style="color:#F00;">*</span> </strong><a class="btn btn-success"
                               onClick="jQuery('#myModal1').modal('show');" data-toggle="modal1"><strong>+</strong></a></td>
                                 <td width="15%" ><strong>Bill No.: <span style="color:#F00;">*</span> </strong></td>
							    <td width="15%" ><strong>Date <span style="color:#F00;">*</span> </strong> </td>
                               <td width="15%"><strong>Bill Type: <span style="color:#F00;">*</span></strong></td>
						      </tr>
                              
							  <tr>
							     <td>
                                     <!--   	  <select name="suppartyid" id="suppartyid" class="chzn-select" autofocus tabindex="1">
                                      <option value="">-select-</option>
                                      <?php
										/*$sql = mysqli_query($connection,"Select suppartyid,supparty_name from m_supplier_party where type_supparty = 'party'");
												if($sql)
												{
													while($row = mysqli_fetch_assoc($sql))
													{
											*/	?>
                                      <option value="<?php echo $row['suppartyid']; ?>"><?php echo $row['supparty_name']; ?></option>
                                      <?php
												//	}
											//	}
												?>
                                    </select>-->
									<script>document.getElementById('suppartyid').value = '<?php // echo $suppartyid; ?>';</script>
                                            </td>
                                   
                                  <td>                                           
                                            <input type="text" name="billno" id="billno" class="form-control text-red"  value="<?php echo $billno ;?>"  style="font-weight:bold; "  tabindex="4" autocomplete="off" readonly >   
                                            </td>
							   
							    <td>                                           
                                            <input type="text" name="saledate" id="billdate" class="form-control text-red" value="<?php echo $cmn->dateformatindia($saledate);?>" tabindex="5" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask >                                           	
                                            </td>
                                            
                                 <td>
                      <select  name="billtype"  class="chzn-select" id="billtype" tabindex="6" >
                      						<option value="">-Select-</option>
                                                <option value="withouttax">Invoice</option>
                                                <option value="withtax">Challan</option>
                                           </select>
                                           <script>document.getElementById('billtype').value = '<?php echo $billtype ; ?>';</script></td>
                                
						      </tr>
                              
                                <tr>
                              <td width="25%" ><strong>Disc (Rs):</strong></td>
                                 <td width="15%" ><strong>Sale Type:<span style="color:#F00;">*</span></strong></td>
							    <td width="15%" colspan="2" >&nbsp;</td>
                             
							    
							   
						      </tr>
							  <tr>
							      
                                   
                                  <td>                                           
                                            <input type="text" name="disc" id="disc" class="form-control text-red"  value="<?php echo $disc;?>"  style="font-weight:bold;"  tabindex="7" autocomplete="off" onChange="setTotalrate();" >   
                                            </td>
							   
							           <td>
                                            <select  name="saletype" class="chzn-select" id="saletype" tabindex="8">
                                                 <option value="">-Select-</option>
                                                 <option value="cash">Cash</option>
                                                 <option value="credit">Credit</option>
                                               </select>
                                               <script>document.getElementById('saletype').value = '<?php echo $saletype ; ?>';</script>
                                               </td>
                                               <td colspan="2">&nbsp;</td>
						      </tr>
							  </table>
                    </div>
                    <br>
                    <div class="row-fluid">
                        <div class="span7">
                            <h4 class="widgettitle nomargin"> <span style="color:#00F;" >  Product Details : 
                            </span></h4>
                        
                            <div class="widgetcontent bordered" id="showrecord">
                                
                            </div><!--widgetcontent-->
                         
                        </div>
                
                    <!--span8-->
                    <div class="span5">

                    		 <div class="alert alert-success" >
                             <input type="text" id="myInput" onKeyUp="myFunction()" placeholder="Search for names or serial number.." title="Type in a name"><a class="btn btn-success"onClick="jQuery('#myModal_product').modal('show');" data-toggle="modal_product" style="margin-left:20px;"><strong>Add Product</strong></a>
                             </div>
                 			 <div class="widgetcontent  padding" id="productnamelist" style="overflow:scroll; height:400px;">
                             
                        	 </div>
                    </div><!--span4-->
                </div>
                
                </form>
                
                
                <!--row-fluid-->
                
                <div class="alert alert-info">
                <input type="button" class="btn btn-warning" value="Show All" onClick="getproductlist('0');" style="margin-bottom:3px;font-size:14px;" />
                
                  <?php 
					  $sqlget=mysqli_query($connection,"select * from m_product_category order by catname");
					  while($rowget=mysqli_fetch_assoc($sqlget))
					  {
						  $pcatid=$rowget['pcatid'];
						  $catname=$rowget['catname'];
					  ?>
                	<input type="button" class="btn btn-inverse" value="<?php echo $catname; ?>" onClick="getproductlist('<?php echo $pcatid; ?>');" style="margin-bottom:3px;font-size:14px;" />
                     <?php 
					  }	
					   ?>
                </div>
                
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
                            <th width="11%" class="head0" >Amount</th>
                            <th width="16%" class="head0" >Customer Name</th>
                             <th width="16%" class="head0" >Print </th>
                             <th width="14%" class="head0" >Action</th>                          
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									//echo "Select * from saleentry $crit order by saleid desc";die;
									$sql_get = mysqli_query($connection,"Select * from saleentry  order by saleid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid =$row_get['suppartyid'];
										$disc =$row_get['disc'];
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										$total = $cmn->getTotalBillAmt($row_get['saleid']);
										 $gst = $cmn->getTotalGst($row_get['saleid']);
										$total = $total - $disc;
										$billtype = $row_get['billtype'];
										
										
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td>                                               
                                                 <td><?php echo number_format(round($total+$gst),2); ?></td>
                                                  <td><?php echo $supparty_name; ?></td>
                                                  <td> <?php if($billtype=="withtax"){ ?><a class="btn btn-primary btn-sm" onClick="funprint('c','<?php echo $row_get['billno']; ?>','<?php echo $row_get['saleid']; ?>');" > Challan </a> <?php }?>&nbsp; &nbsp;<?php if($billtype=="withouttax") {?> <a class="btn btn-success" onClick="funprint('i','<?php echo $row_get['billno']; ?>','<?php echo $row_get['saleid']; ?>');" > Invoice </a><?php }?> </td>
                                                 
                                                   <td>
                                                   <a class='icon-edit' title="Edit" href='saleentry.php?saleid=<?php echo  $row_get['saleid']; ?>' style='cursor:pointer'></a>
                                                   &nbsp;
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['saleid']; ?>);' style='cursor:pointer'></a>
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

<div class="modal fade" id="myModal"  role="dialog" aria-hidden="true" style="display:none;" >
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
                      <input class="form-control" name="mprodname" id="prodname" value="" autofocus="" type="text" readonly style="z-index:-44;" >
                      <input type="hidden" name="mproductid" id="productid"  readonly >                              
                      						 </td>
                                             <td>                                           
                         <input class="form-control" name="unit_name" id="unit_name"  value="" autocomplete="off" autofocus="" type="text" readonly >
                         <input type="hidden" name="unitid" id="unitid" readonly > 
                                         </td>
                                           
                                        </tr>
                                        
                                        <tr>
                                          <th>Quantity &nbsp;<span style="color:#F00;">*</span></th>
                                          <th width="18%">Rate &nbsp;<span style="color:#F00;">*</span></th>
                                        </tr>
                                        <tr>  
                                                                                 
                                            <td> 
                   <input class="form-control" name="qty" id="qty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:60%" onChange="settotal();"  >  
                   <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
                  <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                                        
                                           </td>
                                           
                                            <td>                                           
                         <input class="form-control" name="rate" id="rate"  value="" autocomplete="off" autofocus="" type="text" onChange="settotal();" >
                        
                                         </td>
                                         
                                        </tr>
                                        
                               <tr>
                                <th width="18%">Disc(Rs) &nbsp;</th>
                                <th width="18%">Tax &nbsp;<span style="color:#F00;">*</span></th>
                              
                               </tr>
                               <tr>
                                       
                                         <td>                                           
                         <input class="form-control" name="mdisc" id="mdisc"  value="" autocomplete="off" autofocus="" type="text" onChange="settotal();"  >                        
                                         </td>
                                         
                                          <td>                                           
                           <select name="tax_id" id="tax_id" onChange="getgst(this.value);" >
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
                              
                              
                              
                              
                                         
                                         
                        <tr> <th width="18%">CGST(%) &nbsp;</th>
                        <th width="18%">SGST(%) &nbsp;</th>
                        </tr>
                        <tr>
                        <td>                                           
                        <input class="form-control" name="cgst" id="cgst"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        
                        </td>
                        
                        <td>                                           
                        <input class="form-control" name="sgst" id="sgst"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        
                        </td>
                        
                        </tr>
                        
                        <tr> 
                        <th width="18%">IGST(%) &nbsp;  </th>
                        <th width="18%" style="color:#00F;"><strong>Total &nbsp;</strong><span style="color:#F00;">*</span></th>
                        </tr>
                        <tr>
                       
                        <td>                                           
                        <input class="form-control" name="igst" id="igst"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        
                        </td>
                         <td>                                           
                        <input class="form-control" name="total" id="total"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        
                        </td>
                        
                        </tr>       

                                    </table>
                        </div>
                        <div class="modal-footer clearfix">
                         <input type="submit" class="btn btn-primary" name="submit" value="Add" onClick="addlist();"  >
                           <button type="button" class="btn btn-danger" data-dismiss="modal"   ><i class="fa fa-times"></i> Discard</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>
        
        <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal1">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Customer</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Customer Name</th> 
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
              <th>Opening Balance</th>
            </tr>
            <tr>
             <td><input type="text" name="address" id="address" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            <td><input type="text" name="prevbalance" id="prevbalance" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            </tr>
             <tr> 
              <th>Opening Balance Date</th> 
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
        
       <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal_supplier">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Customer</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Customer Name</th> 
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
              <th>Opening Balance</th>
            </tr>
            <tr>
             <td><input type="text" name="address" id="address" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            <td><input type="text" name="prevbalance" id="prevbalance" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
            </tr>
             <tr> 
              <th>Opening Balance Date</th> 
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
    
    
    
    
    <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal_product">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h3 id="myModalLabel">ADD New Product</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Category Name</th>
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
                <option value="">--Choose Categary--</option>
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
            <th>Product Name</th> 
            <th>Tax</th>
            </tr>
            <tr>
            <td><input type="text" name="s_prodname" id="s_prodname" class="input-xxlarge"  style="width:80%;"autocomplete="off" autofocus/></td>
            <td><select name="s_tax_id" id="s_tax_id"  class="chzn-select" onChange="settax();" >
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
            <tr> 
            <th>Manufacture Date</th>
            <th>Expiry Date</th>
            </tr>
            <tr>
             <td><input type="text" name="s_manu_date" id="s_manu_date" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus placeholder="mm-yyyy" /></td>
            <td> <input type="text" name="s_exp_date" id="s_exp_date" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus placeholder="mm-yyyy" /></td>
            </tr>
            <tr> 
            <th>Batch No </th>
            <th>Opening Stock </th>
             </tr>
              <td><input type="text" name="s_batch_no" id="s_batch_no" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus /> </td>
              <td><input type="text" name="s_opening_stock" id="s_opening_stock" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus /> </td>
          <tr> 
             <th>Stock Date</th> 
            <th>Purchase Rate</th>
            </tr>
           <tr>
            <td><input type="text" name="s_stockdate" id="s_stockdate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" /></td>
            <td><input type="text" name="s_pur_rate" id="s_pur_rate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" onChange="settax();" /></td>
            </tr>
            <tr> 
              <th>Sale Rate</th> 
              <th>Barcode Code</th>
            </tr>
            <tr>
             <td> <input type="text" name="s_rate" id="s_rate" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus onChange="settax();" /></td>
            <td><input type="text" name="s_barcode" id="s_barcode" class="input-xxlarge" style="width:80%;" autocomplete="off" autofocus /></td>
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
                                                    <option value="2">A5 Size</option>                                                   
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

function getproductlist(pcatid)
	{
		
		
	//alert(pcatid);
	if(pcatid !='' && !isNaN(pcatid))
	{
	jQuery.ajax({
	type: 'POST',
	url: 'ajax_getproductlist.php',
	data: 'pcatid='+pcatid+'&process=sale',
	dataType: 'html',
	success: function(data){
	document.getElementById('productnamelist').innerHTML=data;
	}
	
	});//ajax close
	}		
	}
	
	 function getgst(tax_id)
{
	//alert(tax_id);
		jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/get_tax.php',
			  data: 'tax_id='+tax_id,
			  dataType: 'html',
			  success: function(data){
				  //alert(data);
				 arr=data.split("|");
				 jQuery('#igst').val(arr[0]);
				 jQuery('#sgst').val(arr[1]);
				 jQuery('#cgst').val(arr[2]);
				  jQuery('#vat').val(arr[3]);
				
				}
				
			  });//ajax close
	
}
	
	function addproduct(productid,prodname,unit_name,unitid,rate,tax_id)
	
	{
		var suppartyid= document.getElementById('suppartyid').value;	
		if(suppartyid=='')
		{
			alert('Please Select Supplier Name');
			return false;
		}
		
		jQuery("#myModal").modal('show');			
		jQuery("#prodname").val(prodname);
		jQuery("#productid").val(productid);
		jQuery("#unit_name").val(unit_name);
		jQuery("#unitid").val(unitid);
		jQuery("#rate").val(rate);
		jQuery("#tax_id").val(tax_id);
		jQuery("#disc").val('0');
		jQuery("#qty").val('1');
		settotal();
		getgst(tax_id);
		jQuery("#qty").focus();
		
	}
	
	
	function settotal()
{
	var qty=parseFloat(jQuery('#qty').val());	
	var rate=parseFloat(jQuery('#rate').val());	
	var disc=parseFloat(jQuery('#mdisc').val());	
	var igst=parseFloat(jQuery('#igst').val());
	var gst=parseFloat(jQuery('#cgst').val())+ parseFloat(jQuery('#sgst').val());
	
	//alert(disc);
	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}	
	
	

	
	if(!isNaN(disc))
	{
		
		total= total - disc;
	}
	
	//alert(total);
	jQuery('#total').val(total.toFixed(2));
	
}	


getproductlist('0');

	
  function addqty()
  {
  	var qty = parseInt(document.getElementById('qty').value);
	
	var addqty1;
	//alert(qty);
	if(!isNaN(qty))
		{
			 addqty1 = parseInt(qty)+1;
		}
 		document.getElementById('qty').value=addqty1;
		settotal();				
		
  }
  function minusqty()
  {
	  
  	var qty = parseInt(document.getElementById('qty').value);	
	var addqty1;
	
	if(!isNaN(qty) && qty > 1)
	{
		 addqty1 = parseInt(qty)-1;
		 document.getElementById('qty').value=addqty1;
		 settotal();
				 
	}else
	alert("Quntity can not be less than 1");
 	
  }
  
  
		function addlist()
	{
		var  productid= document.getElementById('productid').value;
		var  prodname= document.getElementById('prodname').value;
		var  unit_name= document.getElementById('unit_name').value;
		var  unitid= document.getElementById('unitid').value;
		var  qty= document.getElementById('qty').value;
		var  rate= document.getElementById('rate').value;
		var disc= document.getElementById('mdisc').value;
		
		var tax_id= document.getElementById('tax_id').value;
		var cgst= document.getElementById('cgst').value;
		var sgst= document.getElementById('sgst').value;
		var igst= document.getElementById('igst').value;
		
		var keyvalue='<?php echo $keyvalue; ?>';
		
		if(suppartyid=='')
		{
			alert('Please Select Supplier Name');
			return false;
		}
		
		if(qty =='')
		{
			alert('Quantity cant be blank');	
			return false;
			
		}
		else
		{
			
			
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_saleproduct.php',
			  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc+
			  '&tax_id='+tax_id+'&cgst='+cgst+'&sgst='+sgst+'&igst='+igst+'&saleid='+keyvalue,
			  dataType: 'html',
			  success: function(data){				  
			//alert(data);
				getrecord('<?php echo $keyvalue; ?>');
				
				jQuery('#productid').val('');
				jQuery('#prodname').val('');
				jQuery('#qty').val('');
				jQuery('#unit_name').val('');
				jQuery('#unitid').val('');
				jQuery('#rate').val('');
				jQuery('#mdisc').val('');
				jQuery('#cgst').val('');
				jQuery('#sgst').val('');
				jQuery('#igst').val('');
				jQuery('#tax_id').val('');
				
				jQuery("#myModal").modal('hide');
				
				
				}
				
			  });//ajax close
				
		}
		
	}
	
	
	function getrecord(keyvalue){
		//alert("suppartyid="+suppartyid+'&saleid='+keyvalue);
	  var suppartyid=jQuery("#suppartyid").val();
	
			  jQuery.ajax({
			  type: 'POST',
			  url: 'show_salerecord.php',
			  data: "suppartyid="+suppartyid+'&saleid='+keyvalue,
			  dataType: 'html',
			  success: function(data){				  
				//alert(data);
					jQuery('#showrecord').html(data);					
					setTotalrate();
				
				}
				
			  });//ajax close
								
		
							  
	}
	
	
	function myFunction() {
  //alert('hi');
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0];
	td2 = tr[i].getElementsByTagName("td")[1];
	td3 = tr[i].getElementsByTagName("td")[2];
	td4 = tr[i].getElementsByTagName("td")[3];
	
	//alert(td);
    if(td1 || td2 || td3 || td4) {
      if(td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
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
  function setTotalrate()
  {
	 disc= parseFloat(jQuery('#disc').val());  
	var tot_amt= parseFloat(jQuery('#hidtot_amt').val());
	var tot_tax= parseFloat(jQuery('#tot_tax_gst').val());
	//alert(tot_tax);
	
	if(! isNaN(disc) && !isNaN(tot_amt))
	{
	
		
		tot_amt= tot_amt-disc;
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
	
	function funDel(id)
	{  //alert(id);   
	

		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		fromdate = '<?php echo $cmn->dateformatindia($fromdate); ?>';
		todate = '<?php echo $cmn->dateformatindia($todate); ?>';
		// alert(fromdate); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_sale.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				  //alert(pagename+'?action=3&fromdate='+fromdate+'&todate='+todate);
				   location=pagename+'?action=3';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
jQuery(document).ready(function(){
						   
						   jQuery('#menues').click();
						  
						   });


/*jQuery(document).ready(function(){
								 setTotalrate();
								},10000);*/




function funprint(a,billno,saleid)
{
	jQuery("#myModal2").modal('show');
	jQuery('#mbillno').val(billno);
	jQuery('#msaleid').val(saleid);
	
	if(a=='c')
	{
		jQuery('#type').val('c');	
	}
	
	if(a=='i')
	{
		jQuery('#type').val('i');	
	}
	
}

function printbill(size)
{
	var type = jQuery('#type').val();
	var saleid=jQuery('#msaleid').val();
	if(type=='i')
	{
		if(size=='1')
		{
			window.open("pdf_sale_details.php?saleid="+saleid); 
		}
		
		if(size=='2')
		{
			window.open("pdf_sale_details_prnita5.php?saleid="+saleid); 
		}
		
	}
	
	if(type=='c')
	{
		if(size=='1')
		{
			window.open("pdf_sale_challan_details.php?saleid="+saleid); 
		}
		
		if(size=='2')
		{
			window.open("pdf_sale_chalana5.php?saleid="+saleid); 
		}
	}
	
	jQuery(typesize).val('');
	
}
	
<?php
if($_GET['action']==3)
{
?>
	
	add();
	
<?php } ?>

function save_supplier_data()
{
var supparty_name= document.getElementById('supparty_name').value;
		var mobile= document.getElementById('mobile').value;
		var bank_name= document.getElementById('bank_name').value;
		var bank_ac= document.getElementById('bank_ac').value;
		var ifsc_code= document.getElementById('ifsc_code').value;
		var bank_address= document.getElementById('bank_address').value;
		
		var address= document.getElementById('address').value;
		var prevbalance = document.getElementById('prevbalance').value;
		var prevbal_date= document.getElementById('prevbal_date').value;
		
		if(supparty_name == '')
		{
		    alert('Customer name can not be blank!');
			document.getElementById('supparty_name').focus();
			return false;
		}
		
		if(prevbalance == '')
		{
		    alert('Previous balance can not be blank!');
			document.getElementById('prevbalance').focus();
			return false;
		}
		
		if(prevbal_date == '')
		{
		    alert('Previous balance date can not be blank!');
			document.getElementById('prevbal_date').focus();
			return false;
		}
		
		else
		{
			//alert(productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc);
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_customer.php',
			  data: 'suppartyid='+suppartyid+'&supparty_name='+supparty_name+'&mobile='+mobile+'&bank_name='+bank_name+'&bank_ac='+bank_ac+
			   '&ifsc_code='+ifsc_code+'&bank_address='+bank_address+'&address='+address+'&prevbalance='+prevbalance
			  +'&prevbal_date='+prevbal_date,
			  dataType: 'html',
			  success: function(data){				  
		      //alert(data);
				jQuery('#suppartyid').val('');
				jQuery('#supparty_name').val('');
				jQuery('#mobile').val('');
				jQuery('#address').val('');
				jQuery('#bank_name').val('');
				jQuery('#bank_ac').val('');
				jQuery('#ifsc_code').val('');
				jQuery('#bank_address').val('');
				jQuery('#prevbalance').val(''); 
				jQuery('#ifsc_code').val('');
				jQuery('#prevbal_date').val('');
				jQuery("#myModal1").modal('hide');
				
				//$("#div_par_id").hide(1000);
				    jQuery("$suppartyid").val('').trigger("liszt:updated");
					//$('#suppartyid').val('').trigger('chzn-single:updated');
					//$('#suppartyid').trigger('chzn-single:activate'); // for autofocus
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
	var s_prodname =document.getElementById('s_prodname').value;
	var s_unitid =document.getElementById('s_unitid').value;
	var s_rate =document.getElementById('s_rate').value;
	var s_pur_rate =document.getElementById('s_pur_rate').value;
	var s_barcode =document.getElementById('s_barcode').value;
	var s_opening_stock =document.getElementById('s_opening_stock').value;
	var s_stockdate =document.getElementById('s_stockdate').value;
	var s_tax_id =document.getElementById('s_tax_id').value;
	var s_pcatid =document.getElementById('s_pcatid').value;
	var s_batch_no =document.getElementById('s_batch_no').value;
	var s_exp_date =document.getElementById('s_exp_date').value;
	var s_manu_date =document.getElementById('s_manu_date').value;
		
		//alert(s_prodname);
		//alert(s_unitid);
		//alert(s_pcatid);
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
		
		
		if(s_manu_date == "")
		{
			alert('Please Fill Manufacture Date');
			document.getElementById('s_manu_date').focus();
			return false;
		}
		
		if(s_exp_date == "")
		{
			alert('Please Fill Expire Date');
			document.getElementById('s_exp_date').focus();
			return false;
		}
		
		else
		{
			//alert(s_prodname='+s_prodname+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc);
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_product.php',
			  data: 's_prodname='+s_prodname+'&s_unitid='+s_unitid+'&s_rate='+s_rate+'&s_pur_rate='+s_pur_rate+'&s_barcode='+s_barcode+'&s_opening_stock='+s_opening_stock+'&s_stockdate='+s_stockdate+'&s_tax_id='+s_tax_id+'&s_manu_date='+s_manu_date+'&s_exp_date='+s_exp_date+'&s_batch_no='+s_batch_no+'&s_pcatid='+s_pcatid,
			  dataType: 'html',
			  success: function(data){				  
		     // alert(data);
			 		//alert('hi');
					jQuery('#showallbtn').click();
					jQuery("#s_prodname").val('');
					jQuery("#s_rate").val('');
					jQuery("#s_pur_rate").val('');
					jQuery("#s_barcode").val('');
					jQuery("#s_opening_stock").val('');
					jQuery("#s_stockdate").val('');
					jQuery("#s_manu_date").val('');
					jQuery("#s_exp_date").val('');
					jQuery("#s_batch_no").val('');
					jQuery("#myModal_product").modal('hide');
				    //$("#myModal").hide(1000);
					//$('#s_pcatid').trigger('chosen:updated');
					//$('#s_tax_id').trigger('chosen:updated');
					//$('#s_unitid').trigger('chosen:updated');
					//$('#productid').trigger('chosen:activate'); // for autofocus
					
					
					
				}
				
			  });//ajax close
				
		}
		
}
	
	
</script>
 

</html>
