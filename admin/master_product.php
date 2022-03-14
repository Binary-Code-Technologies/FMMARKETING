<?php  include("../adminsession.php");
$pagename = "master_product.php";
$module = "Add Product";
$submodule = "Product Master";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_product";
$tblpkey = "productid";
if(isset($_GET['productid']))
$keyvalue = $_GET['productid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = addslashes(trim($_GET['action']));
else
$action = "";
$dup='';
if(isset($_POST['submit']))
{
	$prod_code = test_input($_POST['prod_code']);
	$prodname = test_input($_POST['prodname']);
	$rate = test_input($_POST['rate']);	
	$pur_rate = test_input($_POST['pur_rate']);
    $enable="enable";
	$pcatid=test_input($_POST['pcatid']);
	$unitid=test_input($_POST['unitid']);
	$opening_stock=	test_input($_POST['opening_stock']);
	$batchno=	test_input($_POST['batchno']);
	$expiry_date=	test_input($_POST['expiry_date']);
	
	$stockdate=$cmn->dateformatusa(test_input($_POST['stockdate']));

	
	$check='';
	//check Duplicate
	$check = check_duplicate($connection,$tblname,"(prodname = '$prodname') && $tblpkey <> $keyvalue");
	   if($check > 0)
			{
			/*$dup = " Error : Duplicate Record";*/
			$dup="<div class='alert alert-danger'>
			<strong>Error!</strong> Error : Duplicate Record.
			</div>";
			} 
			else {
			//insert
		 if($keyvalue == 0)
		{
			$form_data = array('prodname'=>$prodname,'unitid'=>$unitid,'prod_code'=>$prod_code,'rate'=>$rate,'pur_rate'=>$pur_rate,'stockdate'=>$stockdate,'enable'=>$enable,'pcatid'=>$pcatid,'opening_stock'=>$opening_stock,'ipaddress'=>$ipaddress,'createdate'=>$createdate,'createdby'=>$loginid);
			dbRowInsert($connection,$tblname, $form_data);
			$keyvalue = mysqli_insert_id($connection);
			$action=1;
			$process = "insert";
			
		}
		else
		{
			//update
			$form_data = array('prodname'=>$prodname,'unitid'=>$unitid,'prod_code'=>$prod_code,'rate'=>$rate,'pur_rate'=>$pur_rate,'stockdate'=>$stockdate,'enable'=>$enable,'pcatid'=>$pcatid,'opening_stock'=>$opening_stock,'ipaddress'=>$ipaddress,'lastupdated'=>$createdate,'createdby'=>$loginid);
			dbRowUpdate($connection,$tblname, $form_data,"WHERE $tblpkey = '$keyvalue'");
			$action=2;
			$process = "updated";
		}
		//insert into log report
	
		echo "<script>location='$pagename?action=$action'</script>";
		
		}
		
	}
if(isset($_GET[$tblpkey]))
{
	 $btn_name = "Update";
	 $sqledit       = "SELECT * from $tblname where $tblpkey = $keyvalue";
	 $rowedit       = mysqli_fetch_array(mysqli_query($connection,$sqledit));
	 $prod_code    =  $rowedit['prod_code'];
	 $prodname    =  $rowedit['prodname'];
	 $rate    =  $rowedit['rate'];
	 $pur_rate    =  $rowedit['pur_rate'];
	  $pcatid =  $rowedit['pcatid'];
	  $unitid =  $rowedit['unitid'];
	  $opening_stock =  $rowedit['opening_stock'];
	  $batchno =  $rowedit['batchno'];
	  $expiry_date =  $rowedit['expiry_date'];
	
	  $stockdate= $rowedit['stockdate'];
	 
	  $hsn_no  = $rowedit['hsn_no'];
}
else
{
	$prod_code=$cmn->getcode($connection,$tblname,$tblpkey,"1=1");	
	$prodname    =  '';
	$rate    =  '';
	$pur_rate    =  '';
	$pcatid =  '';
	$unitid =  '';
	$opening_stock =  '';
	
	$stockdate= date('Y-m-d');
	$barcode = '';
	$wholeseller_rate = '';
	$design_code   = '';
	$batchno =  '';
	  $expiry_date = '';
	
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
                                <label>Product Code<span class="text-error">*</span></label>
                                <span class="field">
                                <input type="text" name="prod_code" id="prod_code" class="input-xxlarge" value="<?php echo $prod_code;?>" style="width:80%;" autocomplete="off" autofocus readonly />
                      	</span>
                     </div>
                     
                     <div class="lg-12 md-12 sm-12">
                                <label>Categary Name <span class="text-error">*</span></label>
                                <span class="field">
                                <select name="pcatid" id="pcatid"  class="chzn-select" style="width:82%;" >
                                	<option value="">--Choose Categary--</option>
                                    <?php
									$sql=mysqli_query($connection,"select * from m_product_category order by catname");
									while($row=mysqli_fetch_assoc($sql))
									{								
									?>
                                    <option value="<?php echo $row['pcatid'];  ?>"> <?php echo $row['catname']; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('pcatid').value='<?php echo $pcatid; ?>'; </script>
                      </span>
                     </div>
                     <div class="lg-12 md-12 sm-12">
                                <label>Unit <span class="text-error">*</span></label>
                                <span class="field">
                                <select name="unitid" id="unitid" class="chzn-select" style="width:82%;" >
                                	<option value="">--Choose Unit--</option>
                                    <?php
									$sql=mysqli_query($connection,"select * from m_unit order by unitid");
									while($row=mysqli_fetch_assoc($sql))
									{								
									?>
                                    <option value="<?php echo $row['unitid'];  ?>"> <?php echo $row['unit_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('unitid').value='<?php echo $unitid; ?>'; </script>
                      </span>
                     </div>
                     
                       <div class="lg-12 md-12 sm-12">
                                <label>Product Name <span class="text-error">*</span></label>
                                <span class="field"><input type="text" name="prodname" id="prodname" class="input-xxlarge" value="<?php echo $prodname;?>" style="width:80%;" autocomplete="off" autofocus  /></span>
                     </div>
                      <div class="lg-12 md-12 sm-12">
                                <label>Opening Stock </label>
                                <span class="field">
                              <input type="text" name="opening_stock" id="opening_stock" class="input-xxlarge" value="<?php echo $opening_stock;?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                     
                     
                      <div class="lg-12 md-12 sm-12">
                                <label>Stock Date </label>
                                <span class="field">
                              <input type="text" name="stockdate" id="stockdate" class="input-xxlarge" value="<?php echo $cmn->dateformatindia($stockdate);?>" style="width:80%;" autocomplete="off" autofocus />
                                 </span>
                     </div>
                       <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>Batch No  </label>
                                <span class="field"> <input type="text" name="batchno" id="batchno" class="input-xxlarge" value="<?php echo $batchno;?>" style="width:80%;" autocomplete="off"  /> </span>
                     </div>
                       <div class="lg-12 md-12 sm-12" style="display: none;">
                                <label>Expiry Date  </label>
                                <span class="field"> <input type="text" name="expiry_date" id="expiry_date" class="input-xxlarge" value="<?php echo $expiry_date;?>" style="width:80%;" autocomplete="off" /> </span>
                     </div>
                     
                      <div class="lg-12 md-12 sm-12">
                                <label>Purchase Rate  </label>
                                <span class="field"> <input type="text" name="pur_rate" id="pur_rate" class="input-xxlarge" value="<?php echo $pur_rate;?>" style="width:80%;" autocomplete="off" autofocus onChange="settax();" /> </span>
                     </div>
                     
                     <div class="lg-12 md-12 sm-12">
                                <label>Sale Rate  </label>
                                <span class="field"> <input type="text" name="rate" id="rate" class="input-xxlarge" value="<?php echo $rate;?>" style="width:80%;" autocomplete="off" autofocus onChange="settax();" /> </span>
                     </div>
                    
                                          
                     
                      
                     
                     
                      
                    
                     <div>                            
                          <center> <p class="stdformbutton">
                    <button  type="submit" name="submit" class="btn btn-primary" onClick="return checkinputmaster('prod_code,pcatid,unitid,prodname,tax_id'); ">
								<?php echo $btn_name; ?></button>
                                <a href="master_product.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                                <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
                            </p> </center>
                       
                    </div>
                     </form>
                    <p align="right" style="margin-top:7px; margin-right:10px;"> 
                    <a href="excel_master_product.php" class="btn btn-info" >Excel</a>
                    <a href="pdf_product.php" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p>
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
                        <th width="6%" class="head0 nosort">S.No.</th>
                        <th width="14%" class="head0">Product Code</th>
                        <th width="11%" class="head0">Unit</th>
                         <th width="14%" class="head0">Categary</th>
                        <th width="15%" class="head0">Product Name</th>
                         <th width="15%" class="head0">Opening Stock</th>
                        <th width="10%" class="head0">Rate</th>
                      
                        <th width="11%" class="head0">Edit</th>
                        <th width="19%" class="head0">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_product where 1=1 order by productid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$pcatid=$row_get['pcatid'];
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['prod_code']; ?></td> 
                                                 <td><?php echo $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$row_get[unitid]'"); ?></td> 
                                                 <td><?php echo $cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'"); ?></td> 
                                                 <td><?php echo $row_get['prodname']; ?></td>
                                                 <td><?php echo $row_get['opening_stock']; ?></td>  
                                                 <td><?php echo $row_get['rate']; ?></td> 
                                               
                 									
                              					<td><a class='icon-edit' title="Edit" href='?productid=<?php echo  $row_get['productid'] ; ?>'></a></td>
                                   <td><a class='icon-remove' title="Delete" onclick='funDel(<?php echo  $row_get['productid']; ?>);' style='cursor:pointer'></a> </td>
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
			  url: 'ajax/delete_image_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 //alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
	
	

  </script>
  
  <script>
		
		 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#stockdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
			
                jQuery("[data-mask]").inputmask();
		 });
		 
		 
		  jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#exp_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
			
                jQuery("[data-mask]").inputmask();
		 });
		  
		  
		   jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#manu_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});  
			
                jQuery("[data-mask]").inputmask();
		 });
		 
		 
	function showcategory() 
 {
	var pcatid =document.getElementById("pcatid").value;
	//alert(pcatid);
	 jQuery.ajax({
			  type: 'POST',
			  url: 'show_category.php',
			  data: 'pcatid='+pcatid,
			  dataType: 'html',
			  success: function(data){
				//alert(data);  
				document.getElementById("unitid").innerHTML=data;
				  
				}
				
			  });//ajax close
}


		 
		 
		</script>
  



</body>

</html>
