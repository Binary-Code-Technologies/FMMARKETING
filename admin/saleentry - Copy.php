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
                              <td width="25%" ><strong>Customer Name: <span style="color:#F00;">*</span> </strong></td>
                                 <td width="15%" ><strong>Bill No.: <span style="color:#F00;">*</span> </strong></td>
							    <td width="15%" ><strong>Date <span style="color:#F00;">*</span> </strong> </td>
                               <td width="15%"><strong>Bill Type: <span style="color:#F00;">*</span></strong></td>
						      </tr>
                              
							  <tr>
							     <td>
                                        	  <select name="suppartyid" id="suppartyid" class="form-control chosen-select" autofocus tabindex="1">
                                      <option value="">-select-</option>
                                      <?php
												$sql = mysqli_query($connection,"Select suppartyid,supparty_name from m_supplier_party where type_supparty = 'supplier' ");
												if($sql)
												{
													while($row = mysqli_fetch_assoc($sql))
													{
												?>
                                      <option value="<?php echo $row['suppartyid']; ?>"><?php echo $row['supparty_name']; ?></option>
                                      <?php
													}
												}
												?>
                                    </select>
									<script>document.getElementById('suppartyid').value = '<?php echo $suppartyid; ?>';</script>
                                            </td>
                                   
                                  <td>                                           
                                            <input type="text" name="billno" id="billno" class="form-control text-red"  value="<?php echo $billno ;?>"  style="font-weight:bold; "  tabindex="4" autocomplete="off" readonly >   
                                            </td>
							   
							    <td>                                           
                                            <input type="text" name="saledate" id="billdate" class="form-control text-red" value="<?php echo $cmn->dateformatindia($saledate);?>" tabindex="5" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask >                                           	
                                            </td>
                                            
                                 <td>
                      <select  name="billtype"   class="chosen-select form-control " id="billtype" tabindex="6" >
                      						<option value="">-Select-</option>
                                                <option value="withouttax">Invoice</option>
                                                <option value="withtax">Challan</option>
                                           </select>
                                           <script>document.getElementById('billtype').value = '<?php echo $billtype ; ?>';</script></td>
                                
						      </tr>
                              
                                <tr>
                              <td width="25%" ><strong>Disc %:</strong></td>
                                 <td width="15%" ><strong>Sale Type:<span style="color:#F00;">*</span></strong></td>
							    <td width="15%" colspan="2" >&nbsp;</td>
                             
							    
							   
						      </tr>
							  <tr>
							      
                                   
                                  <td>                                           
                                            <input type="text" name="disc" id="disc" class="form-control text-red"  value="<?php echo $disc;?>"  style="font-weight:bold;"  tabindex="7" autocomplete="off" onChange="setTotalrate();" >   
                                            </td>
							   
							   <td>
                                               <select  name="saletype"  class="chosen-select form-control " id="saletype" tabindex="8">
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
                    
                <div class="row-fluid">
                	<div class="span6">
                    	<h4 class="widgettitle nomargin"> <span style="color:#00F;" >  Product Details : 
                        </span></h4>
                    
                        <div class="widgetcontent bordered" id="showrecord">
                        	
                        </div><!--widgetcontent-->
                   
                        
                      
                    </div>
                    
                    
                    
                    <!--span8-->
                    <div class="span6">

                    		 <div class="alert alert-success" >
                             <input type="text" id="myInput" onKeyUp="myFunction()" placeholder="Search for names or serial number.." title="Type in a name">
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
                
                <!--<p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_bill_report.php?fromdate=<?php/ echo $fromdate;?>&todate=<?php/ echo $todate;?>" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>-->  
                <!--widgetcontent-->
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
										$suppartyid =$row_get['suppartyid'];
										$disc =$row_get['disc'];
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										 $total = $cmn->getTotalBillAmt($row_get['saleid']);										 
										 $disc_amt= ($total * $disc)/100;
										 $total = $total - $disc_amt;
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td>                                               
                                                 <td><?php echo number_format(round($total),2); ?></td>
                                                  <td><?php echo $supparty_name; ?></td>
                                                 
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
                                        
                               <tr> <th width="18%">Disc &nbsp;<span style="color:#F00;">*</span></th>
                               <th width="18%">Total &nbsp;<span style="color:#F00;">*</span></th>
                               </tr>
                               <tr>
                                        <td>                                           
                         <input class="form-control" name="disc" id="disct"  value="" autocomplete="off" autofocus="" type="text" onChange="settotal();" >
                        
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
	data: 'pcatid='+pcatid,
	dataType: 'html',
	success: function(data){
	
	document.getElementById('productnamelist').innerHTML=data;
	}
	
	});//ajax close
	}		
	}
	
	
	function addproduct(productid,prodname,unit_name,unitid,rate)
	
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
		jQuery("#disc").val('0');
		jQuery("#qty").val('1');
		settotal();
		jQuery("#qty").focus();
		
	}
	
	
	function settotal()
{
	var qty=parseFloat(jQuery('#qty').val());	
	var rate=parseFloat(jQuery('#rate').val());	
	var disc=parseFloat(jQuery('#disct').val());	
	
	//alert(disc);
	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}	
	if(!isNaN(disc))
	{
		discamount= (total * disc)/100;
		total= total - discamount;
	}
	//alert(total);
	jQuery('#total').val(total);
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
		var disc= document.getElementById('disct').value;
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
			  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc+'&saleid='+keyvalue,
			  dataType: 'html',
			  success: function(data){				  
			//alert(data);
				getrecord('<?php echo $keyvalue; ?>');
				setTotalrate();
				jQuery('#productid').val('');
				jQuery('#prodname').val('');
				jQuery('#qty').val('');
				jQuery('#unit_name').val('');
				jQuery('#unitid').val('');
				jQuery('#disct').val('');
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
	//alert(td);
    if(td1 || td2) {
      if(td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
	var disc= parseFloat(jQuery('#disc').val());  
	var tot_amt= parseFloat(jQuery('#hidtot_amt').val());
	
	if(! isNaN(disc) && !isNaN(tot_amt))
	{
		var discamt= (tot_amt * disc)/100;	
		
		tot_amt= tot_amt-discamt;
	
		jQuery('#tot_amt').val(tot_amt.toFixed(2));
	}	  
  }  
  
   jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#billdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});               
                jQuery("[data-mask]").inputmask();
		 });
   
   
   setTotalrate();
   
   
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
	
	
<?php
if($_GET['action']==3)
{
?>
	
	add();
	
<?php } ?>
	
	
	
</script>

</html>
