<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "print_barcode.php";
$module = "";
$submodule = "Print Multiple Barcode";
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
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
<script language=JavaScript>
function addids()
{
	
	//alert('gfjdh');
    strids="";
    var cbs = document.getElementsByTagName('input');
	
    var len = cbs.length;
    for (var i = 1; i < len; i++)
    {
         if (document.getElementById("chk" + i)!=null)
         {
              if (document.getElementById("chk" + i).checked==true)
              {
                   if(strids=="")
                   strids=strids + document.getElementById("chk" + i).value;
                   else
                   strids=strids + "," + document.getElementById("chk" + i).value;
				   
				   //alert("chk" + i);
				   
               }
          }
     }
     document.getElementById("hiddenid").value=strids;
	 
}

function toggle(source)
{
//alert(source);
if(source == true)
{
//alert("hi");
var cbs = document.getElementsByTagName('input');
var cond_yes_or_no = "";
for (var i=0, len = cbs.length; i < len; i++)
{
if (cbs[i].type.toLowerCase() == 'checkbox')
{
cbs[i].checked = true;
}
}
addids()
}
else
{
//alert("hello");
var cbs = document.getElementsByTagName('input');
var cond_yes_or_no = "";
for (var i=0, len = cbs.length; i < len; i++)
{
if (cbs[i].type.toLowerCase() == 'checkbox')
{
cbs[i].checked = false;
}
}
addids()
}
}
</script>
<style>
.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('images/page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
}
</style>
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>

</head>

<body onLoad="getRec1();">

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
                  
                <!--widgetcontent-->
                <h4 class="widgettitle"><?php echo $submodule; ?> List</h4>
               
                    <form method="post" onSubmit="get_action(this);" action="get_barcode.php?productid=<?php echo  $row_get['productid'] ; ?>" target="_blank" >
    					<table width="100%" border="0" style="float:right">
                      <tr>
                        <td width="45%">
                        <fieldset style="width:335px;">
                         <legend style="margin-left:10px">Product  List</legend>
                        <div align="center" id="div" style="overflow:auto;width:100%;height:416px;border:0px solid #009">
                         <table id="myTable"  width="95%" border="0" cellspacing="1" cellpadding="1" class="gridtable">
                     <thead>
                        <tr>
                        	<th> <div align="center"><input type="checkbox"  id="chk0" onClick="toggle(this.checked)" /><strong>All</strong></div></th>
                            <th width="14%">Product Name</th>
                             <th width="14%" >Code</th>
                         </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_product where 1=1 order by productid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr class="data-content" data-table="<?php echo $row_get['prodname']; ?>" data-code="<?php echo $row_get['prod_code']; ?>">
                                                <td height='20' align='center'>
    <div align="center"><input type="checkbox" name="chk<?php echo $count; ?>" id="chk<?php echo $count; ?>" onclick="addids()" value="<?php echo $row_get['prod_code']; ?>"/></div></td>
                                                 <td><?php echo $row_get['prodname']; ?></td> 
                                                <td><?php echo $row_get['prod_code']; ?></td> 
                                                
                        </tr>
                        <?php
						}
						?>
                     </tbody>
                </table>
                        </div>
                        </fieldset>
                        </td>
                        <td width="55%" valign="top">
                <fieldset style="width:300px;">
                 <legend style="margin-left:15px">Product Codes</legend>
              		<table width="100%" style="margin:10px; padding-left:5px;">
                       <tr>
                        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#C00">Codes</span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><textarea name="hiddenid" id="hiddenid" style="width:280px;" rows="10"></textarea></td>                    
                    </tr>
                    
                       <tr>
                        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#C00">Select Page</span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><select  name="pageid" id="pageid" style="width:280px;">
                        				<option value="1">A4</option>
                                        <option value="2">Roller</option>
                                        </select>
                        </td>                    
                    </tr>
                    
                      
                      <tr>
                    	<td width="60%"><button type="submit" name="submit" id="submit" class="blue" >Print Barcode</button>                    	 &nbsp;
                        <button type="button" onClick="document.location='<?php echo $page_name; ?>'" >Reset</button>
                        </td>
                    	                    
                      </tr>
                    
                    </table>
				</fieldset></td>
                      </tr>
                    </table>
						</form>
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
	  </script>
   <script>
		
		 jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#manu_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
                jQuery("#exp_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
				
                //Money Euro
                jQuery("[data-mask]").inputmask();
		 });
		</script>

</div>

</body>

</html>
