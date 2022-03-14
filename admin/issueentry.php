<?php include("../adminsession.php");
$pagename = "issueentry.php";
$module = "Add Issue Entry";
$submodule = "Issue Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "saleentry";
$tblpkey = "saleid";

$fromdate=date('Y-m-d');
$todate=date('Y-m-d');



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
	$last_bill='';
}
if(isset($_GET['saleid']))
$keyvalue = $_GET['saleid'];
else
$keyvalue = 0;
if(isset($_POST['submit']))
{
    $billno = trim(addslashes($_POST['billno']));
	$saledate = $cmn->dateformatusa(trim(addslashes($_POST['saledate'])));
	$receivername =  trim(addslashes($_POST['receivername']));
	$branch_id = trim(addslashes($_POST['branch_id']));	
	$remark = trim(addslashes($_POST['remark']));
	
	if($keyvalue == 0 )
	{
	$billno = $cmn->getvalfield($connection,"saleentry","count(*)","sessionid='$sessionid'");
	if($billno=='0')
	{
		$billno = '18-19/'.$cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	else
	{
		$billno = $cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	
		$form_data = array('billno'=>$billno,'saledate'=>$saledate,'receivername'=>$receivername,'branch_id'=>$branch_id,'remark'=>$remark,'sessionid'=>$sessionid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
		dbRowInsert($connection,"saleentry", $form_data);
		$action=1;
		$process = "insert";
		$keyvalue = mysqli_insert_id($connection);
		mysqli_query($connection,"update saleentry_detail set saleid='$keyvalue' where saleid='0' && createdby='$loginid'");	
		
		echo "<script>window.open('pdf_sale_chalana5.php?saleid=$keyvalue', '_blank');</script>";
	}
	else
	{
		$form_data = array('billno'=>$billno,'saledate'=>$saledate,'receivername'=>$receivername,'branch_id'=>$branch_id,'remark'=>$remark,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
		dbRowUpdate($connection,"saleentry", $form_data,"WHERE $tblpkey = '$keyvalue'");
		$keyvalue = mysqli_insert_id($connection);
		$action=2;
		$process = "updated";
	}
	
	
	echo "<script>location='$pagename?action=$action&last_bill=$keyvalue'</script>";
}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 $sqledit    = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit    = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $keyvalue 	 = $rowedit['saleid'];
	 $branch_id =  $rowedit['branch_id'];
	 $billno     = $rowedit['billno'];
	 $saledate   = $rowedit['saledate'];
	 $receivername   = $rowedit['receivername'];
	  $remark = $rowedit['remark'];
}
else
{
	
	$billno = $cmn->getvalfield($connection,"saleentry","count(*)","sessionid='$sessionid'");	
	
	if($billno=='0')
	{
		$billno = '18-19/'.$cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	else
	{
		$billno = $cmn->getcode($connection,$tblname,"billno","sessionid='$sessionid'");	
	}
	
	$branch_id='';
	$saledate = date('Y-m-d');
	$remark='';
	$receivername='';
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
        
         
        
      <div style="float:right;">
      
            <input type="button" class="btn btn-primary" style="float:right; margin-top:10px" name="addnew" id="addnew" onClick="add();" 
            value="Show List">
          
           </div>
       <div class="maincontent">
        	 <div class="contentinner content-dashboard">
             <div id="new2">
                <form action="" method="post" onSubmit="return checkinputmaster('branch_id,billno,billdate,billtype,purchase_type');" >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered" style="background-color:#FFF">
							  
							  <tr>
                              <td width="25%" ><strong>Branch Name: <span style="color:#F00;">*</span> </strong><a class="btn btn-success"
                               onClick="jQuery('#myModal1').modal('show');" data-toggle="modal1"><strong>+</strong></a></td>
                               <td width="25%" ><strong>Name</strong></td>
                               <td width="15%" ><strong>Issue No.: <span style="color:#F00;">*</span> </strong></td>
							    <td width="15%" ><strong>Date <span style="color:#F00;">*</span> </strong> </td>
                               
						      </tr>
                              
							  <tr>
							     <td>
                                      <select id="branch_id" name="branch_id" class="chzn-select">
                                        <option value="">-select-</option>
                                        <?php
											$sql = mysqli_query($connection,"Select branch_id,branch_name from m_branch order by branch_name");
											if($sql)
											{
												while($row = mysqli_fetch_assoc($sql))
												{
											?>
											 		<option value="<?php echo $row['branch_id']; ?>"><?php echo strtoupper($row['branch_name']); ?></option>
											<?php
												}
											}
									   ?>
                                       </select>
                                       <script>
                                       document.getElementById('branch_id').value='<?php echo $branch_id; ?>';
                                       </script>
                                            </td>
                                            
                                            <td>                                           
                                            <input type="text" name="receivername" id="receivername" class="form-control text-red"  value="<?php echo $receivername;?>"  style="font-weight:bold;"   autocomplete="off">   
                                            </td>
                                   
                                  <td>                                           
                                            <input type="text" name="billno" id="billno" class="form-control text-red"  value="<?php echo $billno ;?>"  style="font-weight:bold; " autocomplete="off" readonly >   
                                            </td>
							   
							    <td>                                           
                                            <input type="text" name="saledate" id="saledate" class="form-control text-red" value="<?php echo $cmn->dateformatindia($saledate);?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask >                                           	
                                            </td>
                                            
                                 
                                
						      </tr>
                              
                                <tr>
                              
                                 
							    <td width="15%" colspan="4"><strong>Remark</strong></td>
                             </tr>
							  <tr>
							    
							   
                                  
                               <td colspan="4">                                           
                                            <input type="text" name="remark" id="remark" class="form-control text-red"  value="<?php echo $remark;?>"  style="font-weight:bold;"   autocomplete="off" >   
                                            </td>
						      </tr>
							  </table>
                                </div>
                            <br>
                             <!--span8-->
                    <div >
                 	 <div class="alert alert-success">
                     <table width="88%" class="table table-bordered table-condensed">
                     <tr style="font-weight:bold;">
                     	<td width="33%">PRODUCT
                         <a class="btn btn-success" onClick="jQuery('#myModal_product').modal('show');" data-toggle="modal_product" style="margin-left:20px;"><strong>+</strong></a>
                        </td>
                        <td width="24%">UOM</td>                        
                        <td width="8%">QTY</td>                        
                        <td width="35%">Add</td> 
                     </tr>
                     <tr>
                     	<td>
                         <select name="productid" id="productid" style="width:300px" onChange="getproductinfo();" class="form-control chzn-select">
                         <option value="">--Select--</option>
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
                           <td>
                            <input class="form-control" type="text" name="unit_name" id="unit_name" readonly>
                            <input class="form-control" type="hidden" name="unitid" id="unitid" readonly>
                           </td>
                           
                           <td><input class="form-control input-mini" type="text" name="qty" id="qty" value="" placeholder='qty'></td>
                            
                          <td width="35%">
                           <input type="button" name="add_data_list" id="add_data_list" onClick="addlist();" value="ADD">
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
                <h4 class="widgettitle"><?php echo $submodule; ?> List <a href="excel_issue_entry.php" class="btn btn-info" style="float:right;" >Excel</a></h4>
                
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
                            <th width="16%" class="head0" >Issue No</th>
                            <th width="11%" class="head0">Issue Date</th>
                            <th width="11%" class="head0" >Tot Item</th>
                             <th width="16%" class="head0" >Branch Name</th>
                            <th width="16%" class="head0" >Receiver Name</th>
                            <th width="16%" class="head0">Remark </th>
                            <th class="head0" >Challan </th>                                                      
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
										$saleid =$row_get['saleid'];	
										$branch_id =$row_get['branch_id'];										
										$disc =$row_get['disc'];
										$branch_name = $cmn->getvalfield($connection,"m_branch","branch_name","branch_id='$branch_id'");										
										$billtype = $row_get['billtype'];
										
										 
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                 <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td>                                                 <td><?php echo $cmn->getvalfield($connection,"saleentry_detail","count(*)","saleid='$saleid'") ?></td>
                                                  <td><?php echo $branch_name; ?></td>
                                                  <td><?php echo $row_get['receivername']; ?></td>
                                                  <td><?php echo $row_get['remark']; ?></td>
                                                  
                                                  
                                                    <td>  
											
												<a class="btn btn-primary btn-sm" href="pdf_sale_chalana5.php?saleid=<?php echo  $row_get['saleid']; ?>" target="_blank" >Print</a>
                                                   </td>
                                                                                                             
                                                   
                                                  <td>
                                                   <a class='icon-edit' title="Edit" href='issueentry.php?saleid=<?php echo  $row_get['saleid']; ?>' style='cursor:pointer'></a>
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
                                          <th></th>
                                        </tr>
                                        <tr>  
                                                                                 
                                            <td> 
                   <input class="form-control" name="qty" id="mqty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:60%" onChange="settotal();"  >  
                   <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
                  <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                     </td>
                   <td></td>
                                         
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
              <h3 id="myModalLabel">ADD New Branch</h3>
            </div>
            <div class="modal-body">
            <span style="color:#F00;" id="suppler_model_error"></span>
            <table class="table table-condensed table-bordered">
            <tr> 
            <th>Branch Name <span style="color:#F00;"> * </span> </th> 
            
            </tr>
            <tr>
            <td> <input type="text" id="branch_name" class="input-xxlarge" style="width:80%;" autocomplete="off"  />
            </td>
            
            
            </tr>
                    </table>
            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" name="save" id="save" onClick="save_supplier_data();">Save</button>
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
              <td><input type="text" name="s_opening_stock" id="s_opening_stock" class="input-xxlarge" autocomplete="off" style="width:80%;" autofocus /> </td>
              
              <td><input type="text" name="s_stockdate" id="s_stockdate" class="input-xxlarge" autocomplete="off" autofocus style="width:80%;" /></td>
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
			jQuery("#tax_id").val(tax_id);
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
	var qty=parseFloat(jQuery('#mqty').val());	
	var rate=parseFloat(jQuery('#mrate').val());	
	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
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
		settotal();				
		
  }
  function minusqty()
  {
	  
  	var qty = parseInt(document.getElementById('mqty').value);	
	var addqty1;
	
	if(!isNaN(qty) && qty > 1)
	{
		 addqty1 = parseInt(qty)-1;
		 document.getElementById('mqty').value=addqty1;
		 settotal();
				 
	}else
	alert("Quntity can not be less than 1");
 	
  }
  
function addlist()
{
	var  productid= document.getElementById('productid').value;
	var  unitid= document.getElementById('unitid').value;
	var  qty= document.getElementById('qty').value;
	
	var saledetail_id = 0;
	var keyvalue = '<?php echo $keyvalue; ?>';
	
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
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&saledetail_id='+saledetail_id+
		  '&saleid='+keyvalue,
		  dataType: 'html',
		  success: function(data){	
			getrecord('<?php echo $keyvalue; ?>');
			jQuery('#qty').val('');
			jQuery('#unit_name').val('');
			jQuery('#unitid').val('');
			
			getrecord(keyvalue);
			
			jQuery("#productid").val('').trigger("liszt:updated");
			document.getElementById('productid').focus();
			jQuery(".chzn-single").focus();
		       			
			}
		  });//ajax close
			
	}
	
}




function updatelist()
{
	var  productid= document.getElementById('mproductid').value;
	var  unitid= document.getElementById('munitid').value;
	var  qty= document.getElementById('mqty').value;

	var saledetail_id = document.getElementById('saledetail_id').value;
	var keyvalue = '<?php echo $keyvalue; ?>';
	
		
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
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&saledetail_id='+saledetail_id+'&saleid='+keyvalue,
		  dataType: 'html',
		  success: function(data){				  
		
			getrecord('<?php echo $keyvalue; ?>');
			
			jQuery('#mproductid').val('');
			
			jQuery('#mqty').val('');
			jQuery('#munit_name').val('');
			jQuery('#munitid').val('');		
			jQuery("#mprodname").val('');		
			jQuery("#myModal").modal('hide');
			getrecord(keyvalue);
			}
			
		  });//ajax close
			
	}
	
}
	
	
	
function getrecord(keyvalue){

		  jQuery.ajax({
		  type: 'POST',
		  url: 'show_salerecord.php',
		  data: 'saleid='+keyvalue,
		  dataType: 'html',
		  success: function(data){				  
		//	alert(data);
				jQuery('#showrecord').html(data);					
			
				
			}
		  });//ajax close
}
	
	
function myFunction()
{
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
if(isset($_GET['action'])==3)
{
?>
	
	add();
	
<?php } ?>

function save_supplier_data()
{
       var branch_name= document.getElementById('branch_name').value;
		
		
		if(branch_name == '')
		{
		    alert('Branch Name can not be blank!');
			document.getElementById('branch_name').focus();
			return false;
		}
		else
		{			
		
		  jQuery.ajax({
			  type: 'POST',
			  url: 'save_branch.php',
			  data: 'branch_name='+branch_name,
			  dataType: 'html',
			  success: function(data){				  
		    //  alert(data);
				jQuery('#branch_name').val('');
				jQuery('#myModal1').modal('hide');
				jQuery('#branch_id').html(data);			
				jQuery("#branch_id").val('').trigger("liszt:updated");
				jQuery('#branch_id').val('').trigger('chzn-single:updated');
				jQuery('#branch_id').trigger('chzn-single:activate'); // for autofocus
				
				
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
	var s_prodname = document.getElementById('s_prodname').value;
	var s_unitid =document.getElementById('s_unitid').value;
	var s_rate =document.getElementById('s_rate').value;
	var s_pur_rate =document.getElementById('s_pur_rate').value;
	var s_opening_stock =document.getElementById('s_opening_stock').value;
	var s_stockdate =document.getElementById('s_stockdate').value;
	var s_tax_id =document.getElementById('s_tax_id').value;
	var s_pcatid =document.getElementById('s_pcatid').value;
	var s_hsn_no =document.getElementById('s_hsn_no').value;
	
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
			  data: 's_prodname='+s_prodname+'&s_unitid='+s_unitid+'&s_rate='+s_rate+'&s_pur_rate='+s_pur_rate+'&s_opening_stock='+s_opening_stock+'&s_stockdate='+s_stockdate+'&s_tax_id='+s_tax_id+'&s_hsn_no='+s_hsn_no+'&s_pcatid='+s_pcatid,
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
					jQuery("#s_design_code").val('');
					jQuery("#s_hsn_no").val('');
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
function check_supplier_exist(supparty_name)
{
	//alert(supparty_name);
	jQuery.ajax({
					type: 'POST',
					url: 'ajax_check_supplier_exist.php',
					data: 'supparty_name='+supparty_name,
					dataType: 'html',
					success: function(data){				  
					//alert(data);
						if(data == 0 || data == "")
						{
							alert('Supplier name not found!')
							jQuery("#search_supplier").val('');
							jQuery("#search_supplier").focus();
						}
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






function show_model(saleid)
{
	
	if(!isNaN(saleid))
	{
		
		jQuery.ajax({
					type: 'POST',
					url: 'ajax_getinvoicedetail.php',
					data: 'saleid='+saleid,
					dataType: 'html',
					success: function(data){				  
					arr=data.split('|');
					paidamount=arr[0].trim();
					receiptno=arr[1].trim();
					tot_amt=arr[2].trim();
					var bal_amt=tot_amt-paidamount;
					
					jQuery("#saleidd").val(saleid);
					jQuery("#branch_idd").val(branch_id);
					jQuery("#myModal_payment").modal('show');
					jQuery("#cheque_td").hide();
					jQuery("#bank_td").hide();
					jQuery("#ref_td").hide();	
					jQuery('#error').html('');
					jQuery('#totalbillamount').val(tot_amt);
					jQuery('#prevamount').val(paidamount);
					jQuery('#receiptno').val(receiptno);
					jQuery('#balanceamount').val(bal_amt);
					
					}
				
			  });//ajax close
		
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

function save_payment_data()
{
	
        var payamt= document.getElementById('payamt').value;
		var payment_type= document.getElementById('payment_type').value;
		var chequeno= document.getElementById('chequeno').value;
		var refno= document.getElementById('refno').value;
		var bank_name= document.getElementById('bank_name').value;
		var paydate= document.getElementById('paydate').value;		
		var receiptno= document.getElementById('receiptno').value;
		var branch_id = document.getElementById('branch_idd').value;
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
			   '&paydate='+paydate+'&receiptno='+receiptno+'&branch_id='+branch_id+'&saleid='+saleid+'&pay_mode='+pay_mode,
			  dataType: 'html',
			  success: function(data){				  
		    //  alert(data);
				jQuery('#payamt').val('');
				jQuery('#payment_type').val('');
				jQuery('#chequeno').val('');
				jQuery('#branch_id').val('');
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

function updaterecord(prodname,productid,unit_name,unitid,qty,saledetail_id)
{
	
		
	jQuery("#myModal").modal('show');
	jQuery("#saveitem").attr('value', 'Update');
	jQuery("#mprodname").val(prodname);
	jQuery("#mproductid").val(productid);
	jQuery("#munit_name").val(unit_name);
	jQuery("#munitid").val(unitid);	
	jQuery("#mqty").val(qty);
    jQuery("#saledetail_id").val(saledetail_id);
	jQuery("#qty").focus();	
}


function getproductinfo()
{
	
	var productid = jQuery("#productid").val();
	jQuery.ajax({
			  type: 'POST',
			  url: 'getproductinfo.php',
			  data: 'productid='+productid,
			  dataType: 'html',
			  success: function(data){	
				var jsonobj = jQuery.parseJSON(data);
				jQuery('#unit_name').val(jsonobj.unit_name);
				jQuery('#unitid').val(jsonobj.unitid);				
				jQuery('#qty').val('1');
			
				jQuery('#qty').focus();
			
				}
				
			  });//ajax close
}




</script>

<?php if($last_bill !='' || $last_bill !='0')
{ ?>
<script>show_model(<?php echo $last_bill ?>);
<?php } ?>
</script>
</html>
