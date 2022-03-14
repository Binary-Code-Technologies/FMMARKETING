<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "salereturn.php";
$module = "Add Sale Return Entry";
$submodule = "Sale Return Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "salereturn";
$tblpkey = "sale_returnid";
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_GET['sale_returnid']))
$keyvalue = $_GET['sale_returnid'];
else
$keyvalue = 0;
if(isset($_GET['saleid']))
$saleid = $_GET['saleid'];
else
$saleid=0;
if(isset($_POST['submit']))
{
	$saleid = trim(addslashes($_POST['saleid']));
    $productid =  trim(addslashes($_POST['productid']));
	$qty= trim(addslashes($_POST['qty']));
	$sale_retdate= $cmn->dateformatusa($_POST['sale_retdate']);
	
	if($keyvalue == 0 )
	{
		
			$form_data = array('saleid'=>$saleid,'productid'=>$productid,'qty'=>$qty,'sale_retdate'=>$sale_retdate,
							  'ipaddress'=>$ipaddress,'createdate'=>$createdate);
			dbRowInsert($connection,"salereturn", $form_data);
			$action=1;
			$process = "insert";
			$keyvalue = mysqli_insert_id($connection);
	     mysqli_query($connection,"update saleentry_detail set saleid='$saleid' where saleid='0'");	
	
	}
	else
	{
		$form_data = array('saleid'=>$saleid,'productid'=>$productid,'qty'=>$qty,'sale_retdate'=>$sale_retdate,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate);
			dbRowUpdate($connection,"salereturn", $form_data,"WHERE $tblpkey = '$keyvalue'");
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
	 $keyvalue 	 = $rowedit['sale_returnid'];
	 $saleid     =  $rowedit['saleid'];
	 $productid   =  $rowedit['productid'];
	 $qty   =  $rowedit['qty'];
	$sale_retdate    =  $rowedit['sale_retdate'];	
}
else
{
	$ret_date=date('d-m-Y');
}

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
</head>

<body onLoad="getproductlist('<?php echo $saleid; ?>');">

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
            	             
                              
                <form action="" method="post" onSubmit="return checkinputmaster('suppartyid');" >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered">
							  
							  <tr>
                              <td width="25%"><strong>Bill No :<span style="color:#F00;">*</span> </strong></td>
                               <td width="15%"><strong>Return Date <span style="color:#F00;">*</span> </strong> </td>
                               </tr>
                              
							  <tr>
							     <td>
                                        <select name="saleid" id="saleid" class="chzn-select"  onChange="get_supplier(this.value);" autofocus tabindex="1">
                                      <option value="">-select-</option>
                                      <?php
												$sql = mysqli_query($connection,"Select saleid,suppartyid,billno from saleentry order by saleid");
												if($sql)
												{
													while($row = mysqli_fetch_assoc($sql))
													{
														
														$billno = $row['billno'];
														$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid = '$row[suppartyid]'");
											?>
                                      <option value="<?php echo $row['saleid']; ?>"><?php echo $billno." / ".$supparty_name; ?></option>
                                        <?php
												  }
												}
												?>
                                    </select>
									  <script>document.getElementById('saleid').value = '<?php echo $saleid; ?>';</script>
                                            </td>
                                   
							            <td>                                           
                                            <input type="text"  name="sale_retdate" id="sale_retdate"  value="<?php if($sale_retdate!='') echo $sale_retdate; else echo date('d-m-Y'); ?>" tabindex="2" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask >                                           	
                                            </td>
                                    </tr>
                               
							 </table>
                       
                    </div>
                   <br>  
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
                             <th width="16%" class="head0">Bill No</th>
                             <th width="16%" class="head0">Product Name</th>
                             <th width="11%" class="head0">Return Date</th>
                             <th width="14%" class="head0">Action</th>                          
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									//echo "Select * from saleentry $crit order by saleid desc";die;
									$sql_get = mysqli_query($connection,"Select * from salereturn group by saleid order by sale_returnid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$saleidl = $row_get['saleid'];
										$billno = $cmn->getvalfield($connection,"saleentry","billno","saleid='$saleidl'");
										
										$productid = $row_get['productid'];
										$prodname = $cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
										
									   ?> <tr>
                                                 <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $billno; ?></td>
                                                 <td><?php echo $prodname; ?></td>
                                                 <td><?php echo $cmn->dateformatindia($row_get['sale_retdate']); ?></td>                                               
                                                   <td>
                                                
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
                                        
                                    <tr> <th width="18%">Sale. Qty &nbsp;<span style="color:#F00;">*</span></th>
                                    <th width="18%">Previouse Ret. Qty &nbsp;<span style="color:#F00;">*</span></th>
                                    </tr>
                                    <tr>
                                    <td>                                           
                                    <input class="form-control" name="sale_qty" id="sale_qty"  value="" autocomplete="off" autofocus="" type="text" readonly >
                                    
                                    </td>
                                    
                                    <td>                                           
                                    <input class="form-control" name="ret_qty" id="ret_qty"  value="" autocomplete="off" autofocus="" type="text" readonly >
                                    
                                    </td>
                                    
                                    </tr>
                                        
                                    <tr>
                                      <th>Bal Qty &nbsp;<span style="color:#F00;">*</span></th>
                                      <th width="18%">Return Qty &nbsp;<span style="color:#F00;">*</span></th>
                                    </tr>
                                    <tr>  
                                      <td>                                           
                     <input class="form-control" name="bal_qty" id="bal_qty"  value="" autocomplete="off" autofocus="" type="text" style="color:#00F;"  readonly >                    
                                     </td>
                                                                             
                                        <td> 
               <input class="form-control" name="qty" id="qty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:60%" onChange="checkqty(this.value);"   >  
               <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
              <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                                        
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
function getproductlist(saleid)
	{	
	//alert(saleid);
	if(saleid !=0 && !isNaN(saleid))
	{
	jQuery.ajax({
	type: 'POST',
	url: 'ajax_getreturnproductlist.php',
	data: 'saleid='+saleid,
	dataType: 'html',
	success: function(data){
	//alert(data);
	document.getElementById('productnamelist').innerHTML=data;
	}
	
	});//ajax close
	}		
	}
	
	function addproduct(productid,prodname,unit_name,unitid,sale_qty,ret_qty,bal_qty)
	{
		var saleid= document.getElementById('saleid').value;
		
		if(bal_qty==0)
		{
			alert('You cant return this product');	
			return false;
		}
		
		if(saleid=='0')
		{
			alert('Please Select Bill No');
			return false;
		}
		
		
		
		jQuery("#myModal").modal('show');			
		jQuery("#prodname").val(prodname);
		jQuery("#productid").val(productid);
		jQuery("#unit_name").val(unit_name);
		jQuery("#unitid").val(unitid);
		jQuery("#sale_qty").val(sale_qty);
		jQuery("#ret_qty").val(ret_qty);
		jQuery("#bal_qty").val(bal_qty);
		jQuery("#qty").val('1');
		jQuery("#qty").focus();
		
	}
	
	function checkqty(qty)
{
	var bal_qty=parseInt(document.getElementById('bal_qty').value);
	
	
	if(qty=='0')
	{
		alert('Quantity Cant be Zero');	
		jQuery('#qty').val('');
		return false;
	}
	
	if(qty !=0 && !isNaN(qty))
	{
		if(qty > bal_qty)
		{
			alert('Quantity Cant be Greater Than Balance Quantity');
			jQuery('#qty').val('');
			return false;
		}
	}
	
}
  
		function addlist()
	{
		var  productid= document.getElementById('productid').value;
		var  prodname= document.getElementById('prodname').value;
		var  unit_name= document.getElementById('unit_name').value;
		var  unitid= document.getElementById('unitid').value;
		var  qty= document.getElementById('qty').value;
		var  sale_retdate= document.getElementById('sale_retdate').value;
		var saleid='<?php echo $saleid; ?>';
		
		
		if(prodname=='')
		{
			alert('Product Name Cant be blank');
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
			  url: 'save_sale_return.php',
			  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&sale_retdate='+sale_retdate+'&saleid='+saleid,
			  dataType: 'html',
			  success: function(data){				  
			 // alert(data);
				getrecord(saleid);
				getproductlist(saleid);
				
				jQuery('#productid').val('');
				jQuery('#prodname').val('');
				jQuery('#qty').val('');
				jQuery('#unit_name').val('');
				jQuery('#unitid').val('');
				jQuery("#myModal").modal('hide');
			
				}
				
			  });//ajax close
				
		}
		
	}
	function getrecord(saleid){
		//alert(saleid);
		//alert("suppartyid="+suppartyid+'&pret_id='+keyvalue);
	  if(saleid !='0' && !isNaN(saleid))
	  {
	
			  jQuery.ajax({
			  type: 'POST',
			  url: 'saleretrecord_show.php',
			  data: "saleid="+saleid,
			  dataType: 'html',
			  success: function(data){				  
				//alert(data);
					jQuery('#showrecord').html(data);
				
				}
				
			  });//ajax close
	  }
							  
	} 
	getrecord(<?php echo $saleid; ?>);
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


 
  function deleterecord(sale_returnid)
  {
	 	tblname = 'salereturn';
		tblpkey = 'sale_returnid';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		
		
	if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_master.php',
			  data: 'id='+sale_returnid+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 //alert(data);
				 getrecord('<?php echo $saleid; ?>');
				 getproductlist('<?php echo $saleid; ?>');
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
		jQuery("#addnew").val(" + Add New");
	}
	else
	{
		jQuery("#addnew").val(" Show List");
	}
		
	}	
	
	
	function funDel(saleid)
	{
	tblname = 'salereturn';
	tblpkey = 'saleid';
	pagename = '<?php echo $pagename; ?>';
	submodule = '<?php echo $submodule; ?>';
	module = '<?php echo $module; ?>';
	
	
	if(confirm("Are you sure! You want to delete this record."))
	{
	jQuery.ajax({
	  type: 'POST',
	  url: 'ajax/delete_master.php',
	  data: 'id='+saleid+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
	  dataType: 'html',
	  success: function(data){
		 // alert(data);
		 location='<?php echo $pagename;?>'+'?action=3';
		getrecord('<?php echo $saleid; ?>');
		getproductlist('<?php echo $saleid; ?>');
		 
		}
		
	  });//ajax close
	}//confirm close
	
	}



	
<?php
if($_GET['action']==3)
{
?>
	
	add();
	
<?php } ?>
	
	
	//function getproductret(saleid)
	//{
		//if(saleid!='')
		//{
		//	location = '?saleid='+saleid;
		//}
      		
	//}	
   jQuery(document).ready(function(){
   jQuery('#menues').click();
   });
	
	function get_supplier(saleid)
	{
		//alert(saleid);
		if(saleid!=0)
		{
			location = '?saleid='+saleid;
		}
	}
</script>




</html>
