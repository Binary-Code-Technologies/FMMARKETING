<?php   error_reporting(0);                                                                                                include("../adminsession.php");
$pagename = "purchasereturn.php";
$module = "Add Purchase Return Entry";
$submodule = "Purchase Return Entry";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "purreturn_entry";
$tblpkey = "pretentry_id";
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
if(isset($_GET['pretentry_id']))
$keyvalue = $_GET['pretentry_id'];
else
$keyvalue = 0;

if(isset($_GET['purchaseid']))
{
$purchaseid = $_GET['purchaseid'];
}
else
{
	$purchaseid=0;
}



if(isset($_POST['save']))
{
	//echo $purchaseid=trim(addslashes($_POST['purchaseid']));
	 $orderno = trim(addslashes($_POST['orderno']));
	$ret_date = $cmn->dateformatusa(trim(addslashes($_POST['ret_date'])));
//	$suppartyid = trim(addslashes($_POST['suppartyid']));
	
	
	if($purchaseid!=0)
	{
		$form_data = array('purchaseid'=>$purchaseid,'orderno'=>$orderno,'ret_date'=>$ret_date,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
		dbRowInsert($connection,"purreturn_entry",$form_data);
		$action=1;
		$process = "insert";
		$keyvalue = mysqli_insert_id($connection);
		mysqli_query($connection,"update pur_return set pretentry_id='$keyvalue' where pretentry_id='0'");	
		$cmn->InsertLog($connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
		
	}
	else
	{
		$form_data = array('purchaseid'=>$purchaseid,'orderno'=>$orderno,'ret_date'=>$ret_date,'suppartyid'=>$suppartyid,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
		dbRowUpdate($connection,"purreturn_entry", $form_data,"WHERE $tblpkey = '$keyvalue'");
		$keyvalue = mysqli_insert_id($connection);
		$action=2;
		$process = "updated";
	}
	echo "<script>location='$pagename?action=$action'</script>";
		
	}




if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 //echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	 $sqledit    = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit    = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $keyvalue 	 = $rowedit['pret_id'];
	 $billno     =  $rowedit['billno'];
	 $saledate   =  $rowedit['saledate'];
	 $saletype   =  $rowedit['saletype'];
	$billtype    =  $rowedit['billtype'];
	$disc  		 =  $rowedit['disc'];
	$suppartyid  =  $rowedit['suppartyid'];
	
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

<body onLoad="getretproduct('<?php echo $purchaseid; ?>')">

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
                <form action="" method="post" >
                
                <div class="row-fluid">
                	<table class="table table-condensed table-bordered">
							  
							  <tr>
                              <td width="25%" ><strong>Bill No : <span style="color:#F00;">*</span> </strong></td>
                               <td width="25%" ><strong>Return Order No : <span style="color:#F00;">*</span> </strong></td>
                                 <td width="15%" ><strong>Return Date: <span style="color:#F00;">*</span> </strong></td>
							   
						      </tr>
                              
							  <tr>
							     <td>
                                    <select name="purchaseid" id="purchaseid" class="chzn-select" autofocus tabindex="1" onChange="getsuppitemlist(this.value);">
                                      <option value="">-select-</option>
                                      <?php
												$sql = mysqli_query($connection,"Select *  from purchaseentry order by purchaseid desc");
												if($sql)
												{
													while($row = mysqli_fetch_assoc($sql))
													{
												$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$row[suppartyid]'");
												
												
												?>
                                      <option value="<?php echo $row['purchaseid']; ?>"><?php echo $row['billno'] .' / ' .$supparty_name; ?></option>
                                      <?php
													}
												}
												?>
                                    </select>
									<script>document.getElementById('purchaseid').value = '<?php echo $purchaseid; ?>';</script>
                                            </td>
                                    <td> <input type="text" name="orderno" id="orderno" class="form-control text-red"  value="<?php echo $orderno ;?>"  style="font-weight:bold;">   
                                            </td>
                                  <td> <input type="text" name="ret_date" id="ret_date" class="form-control text-red"  value="<?php echo $ret_date ;?>"  style="font-weight:bold;" placeholder="dd-mm-yyyy"  tabindex="4" autocomplete="off"  >   
                                            </td>
							   </tr>
                            </table>
                           
                    </div>
                    
                      <br>
                <div class="row-fluid">
                	<div class="span6">
                    	<h4 class="widgettitle nomargin"> <span style="color:#00F;" >Product Details : <span id="inentryno" > <?php //echo $inentry_no; ?> </span>
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
                <p align="center"> <input type="submit" class="btn btn-danger" value="Save" name="save"  >  &nbsp; &nbsp; 
      <input type="hidden" name="purchaseid" value="<?php echo $purchaseid; ?>"  />
      <a href="purchasereturn.php" class="btn btn-primary" > Reset </a>
       </p>  
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
                            <th width="16%" class="head0" >Bill No</th>
                             <th width="11%" class="head0">Return Date</th>
                              <th width="16%" class="head0" >Customer Name</th>
                                    <th width="26%" class="head0" style="text-align:center;">Print </th>
                             <th width="14%" class="head0" >Action</th>                          
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									//echo "Select distinct purchaseid from pur_return order by pret_id desc";die;
									$sql_get = mysqli_query($connection,"Select * from purreturn_entry order by pretentry_id desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									
										$purchaseidl =$row_get['purchaseid'];
										$orderno =$row_get['orderno'];
										$billno = $cmn->getvalfield($connection,"purchaseentry","billno","purchaseid='$purchaseidl'");
										$suppartyid = $cmn->getvalfield($connection,"purchaseentry","suppartyid","purchaseid='$purchaseidl'");
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										 
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $orderno; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['ret_date']); ?></td>
                                                 <td><?php echo $supparty_name; ?></td>                                               
                                                 <td><a class="btn btn-success" href="pdf_purches_retuinvoice.php?pretentry_id=<?php echo  $row_get['pretentry_id']; ?>" target="_blank" > Invoice A4</a></td>
                                                   <td>                                                  
                                                <a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['pretentry_id']; ?>);' style='cursor:pointer'></a>                                        </td>
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
                                        
                                    <tr> <th width="18%">Pur. Qty &nbsp;<span style="color:#F00;">*</span></th>
                                    <th width="18%">Previouse Ret. Qty &nbsp;<span style="color:#F00;">*</span></th>
                                    </tr>
                                    <tr>
                                    <td>                                           
                                    <input class="form-control" name="pur_qty" id="pur_qty"  value="" autocomplete="off" autofocus="" type="text" readonly >
                                    
                                    </td>
                                    
                                    <td>                                           
                                    <input class="form-control" name="ret_qty" id="ret_qty"  value="" autocomplete="off" autofocus="" type="text" readonly >
                                    
                                    </td>
                                    
                                    </tr>
                                        
                                    <tr>
                                      <th width="18%">Bal Qty &nbsp;<span style="color:#F00;">*</span></th>
                                      <th width="22%">Return Qty &nbsp;<span style="color:#F00;">*</span></th>
                                    </tr>
                                    <tr>  
                                      <td>                                           
                     <input class="form-control" name="bal_qty" id="bal_qty"  value="" autocomplete="off" autofocus="" type="text" style="color:#00F;"  readonly >                    
                                     </td>
                                                                             
                                        <td> 
               <input class="form-control" name="qty" id="qty"  value="1" autocomplete="off" autofocus="" type="text"  placeholder="Enter Quantity" style="width:45%" onChange="checkqty(this.value);settotalupdate();">  
               <input type="button" style="font-size:16px;" class="btn-sm btn btn-success btn-plus" id="add" value="+" onClick="addqty()" >  
              <input type="button"  style="font-size:16px;" class="btn-sm btn btn-danger" id="minus" value="--" onClick="minusqty();" >                                        
                                       </td>
                                       
                                      
                                     
                                    </tr>
                                       <tr>
                                 <th width="18%">Rate &nbsp;<span style="color:#F00;">*</span></th>
                                <th width="18%">Tax &nbsp;<span style="color:#F00;">*</span></th>
                             
                               </tr>
                               <tr>
                                       
                                       
                                         
 <td>                                           
                         <input class="form-control" name="retrate" id="retrate"  value="" autocomplete="off" autofocus="" type="text" readonly>
                                          <td>                                           
                           <select name="mtax_id" id="mtax_id"  disabled>
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
                               <th width="18%"><strong>Disc &nbsp;</strong><span style="color:#F00;">*</span></th>
                            <th width="18%" style="color:#00F;"><strong>Total &nbsp;</strong><span style="color:#F00;">*</span></th>
                           
                             </tr>   
                              <tr>
                              <td>
                          
      <input class="form-control" id="m_disc_per"  value="" autocomplete="off" autofocus="" type="text" readonly onChange="settotalupdate();" >
                        
                        </td>
                              <td>                                           
                        <input class="form-control" name="total" id="mtotal"  value="" autocomplete="off" autofocus="" type="text" readonly >
                        
                        </td>
                        
                      
                             </tr>
                                         
                                    </table>
                        </div>
                        <div class="modal-footer clearfix">
                        <input type="hidden" name="purdetail_id" id="purdetail_id">
                           <input type="submit" class="btn btn-primary" name="submit" value="Add" onClick="addlist();"  >
                           <button type="button" class="btn btn-danger" data-dismiss="modal"   ><i class="fa fa-times"></i> Discard</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>
        
<script>

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
		settotalupdate();	
  }
  
  
  function minusqty()
  {
	  
  	var qty = parseInt(document.getElementById('qty').value);	
	var addqty1;
	
	if(!isNaN(qty) && qty > 1)
	{
		 addqty1 = parseInt(qty)-1;
		 document.getElementById('qty').value=addqty1;
		settotalupdate();	
				 
	}else
	alert("Quntity can not be less than 1");
 	
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

 function settotalupdate()
{
	var qty=parseFloat(jQuery('#qty').val());	
	var rate=parseFloat(jQuery('#retrate').val());
	var disc=parseFloat(jQuery('#m_disc_per').val());
	
	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}
	
	if(!isNaN(disc))
	{
		total= total - (total * disc)/100;
	}
	
	jQuery('#mtotal').val(total.toFixed(2));
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
	
	

function getsuppitemlist(purchaseid)
{
	
	if(!isNaN(purchaseid) && purchaseid !='')
	{
		window.location.href='purchasereturn.php?purchaseid='+purchaseid;	
	}
}

   jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#ret_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});               
                jQuery("[data-mask]").inputmask();
		 });

function getretproduct(purchaseid)
{

	var tblname='purchasentry_detail';
	var tblkey='purchaseid';

	if(!isNaN(purchaseid) && purchaseid !=0)
	{
		
		 jQuery.ajax({
			  type: 'POST',
			  url: 'ajax_getretproductlist.php',
			  data: "id="+purchaseid+'&tblname='+tblname+'&tblkey='+tblkey,
			  dataType: 'html',
			  success: function(data){				  
			//	alert(data);
					document.getElementById('productnamelist').innerHTML=data;
				
				}
				
			  });//ajax close
	
	}
	
}

	

	function addproduct(productid,purdetail_id,prodname,unit_name,unitid,pur_qty,ret_qty,rate,disc,tax_id,bal_qty)	
	{
		var purchaseid= document.getElementById('purchaseid').value;	
		if(bal_qty==0)
		{
			alert('You cant return this product');	
			return false;
		}
		
		if(purchaseid=='')
		{
			alert('Please Select Bill No');
			return false;
		}
		
		jQuery("#myModal").modal('show');			
		jQuery("#prodname").val(prodname);
		jQuery("#productid").val(productid);
		jQuery("#unit_name").val(unit_name);
		jQuery("#unitid").val(unitid);
		jQuery("#pur_qty").val(pur_qty);
		jQuery("#ret_qty").val(ret_qty);
		jQuery("#bal_qty").val(bal_qty);
		jQuery("#retrate").val(rate);
		jQuery("#m_disc_per").val(disc);
		jQuery("#purdetail_id").val(purdetail_id);
		jQuery("#mtax_id").val(tax_id);
		jQuery("#qty").val('1');
		jQuery("#qty").focus();
		
	}


function checkqty(qty)
{
	var bal_qty=document.getElementById('bal_qty').value;
	
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
			var  rate= document.getElementById('retrate').value;
			var tax_id= document.getElementById('mtax_id').value;
			var disc = document.getElementById('m_disc_per').value
				var purdetail_id = document.getElementById('purdetail_id').value
			var purchaseid = '<?php echo $purchaseid; ?>';
		//alert(purdetail_id);
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
			  url: 'save_purreturn.php',
			  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&tax_id='+tax_id+'&disc='+disc+'&purdetail_id='+purdetail_id,
			  dataType: 'html',
			  success: function(data){				  
			//    alert(data);
				getrecord(purchaseid);
				getretproduct(purchaseid);
				
				jQuery('#productid').val('');
				jQuery('#prodname').val('');
				jQuery('#qty').val('');
				jQuery('#unit_name').val('');
				jQuery('#unitid').val('');
				jQuery('#retrate').val('');
				jQuery('#mtax_id').val('');
				jQuery('#m_disc_per').val('');
				jQuery('#mtotal').val('');
				jQuery("#myModal").modal('hide');
				
				
				}
				
			  });//ajax close
				
		}
		
	}
	
	function getrecord(purchaseid){
	
		var keyvalue = '<?php echo $keyvalue; ?>';
	 if(purchaseid !='0' && !isNaN(purchaseid))
	  {
	
			  jQuery.ajax({
			  type: 'POST',
			  url: 'show_saleretrecord.php',
			  data: "purchaseid="+purchaseid+'&pretentry_id='+keyvalue,
			  dataType: 'html',
			  success: function(data){				  
				//alert(data);
					jQuery('#showrecord').html(data);
				
				}
				
			  });//ajax close
	  }
								
		
							  
	} 
	
	
	getrecord(<?php echo $purchaseid; ?>);
	
	
	 function deleterecord(pret_id)
  {
	 	tblname = 'pur_return';
		tblpkey = 'pret_id';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		
		
	if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_master.php',
			  data: 'id='+pret_id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				 getrecord('<?php echo $purchaseid; ?>');
				 getretproduct('<?php echo $purchaseid; ?>');
				 
				}
				
			  });//ajax close
		}//confirm close
	
  }
  jQuery(document).ready(function(){
   jQuery('#menues').click();
  
   });
   function funDel(pretentry_id)
  {
	 	tblname = 'purreturn_entry';
		tblpkey = 'pretentry_id';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		
		
	if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_purchasereturn.php',
			  data: 'id='+pretentry_id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				 location='<?php echo $pagename;?>'+'?action=3';
				 getrecord('<?php echo $purchaseid; ?>');
				 getretproduct('<?php echo $purchaseid; ?>');
				 
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
	
	
	
</script>
</body>

</html>
