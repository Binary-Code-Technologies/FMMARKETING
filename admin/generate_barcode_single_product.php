<?php
include("../adminsession.php");
$pagename = "generate_barcode_single_product.php";
$module = "";
$submodule = "Print Multiple Barcode";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "m_product";
$tblpkey = "productid";

if(isset($_GET['productid']))
$productid = $_GET['productid'];
else
$productid = 0;

if(isset($_REQUEST['a']))
$a=$_REQUEST['a'];
else
$a=0;
if(isset($_POST['cancel']))
{
	echo "<script>location='$pagename'</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>RIT- BARCODE</title>
	<?php include("inc/top_files.php"); ?>
<script>
function getRec1(page)
{
	document.getElementById('div1').innerHTML="<br><br><br><br><br><br><br><center><img src='images/loadingimage.gif'></center>";
	if(page==undefined)
	page=1;
	productid=document.getElementById("productid").value;
	//alert(course_id);
	if(navigator.appName=="Microsoft Internet Explorer")
	obj=new ActiveXObject("Msxml2.XMLHTTP")
	else
	obj=new XMLHttpRequest()
	obj.open("post","get_product_for_single_barcode.php",true)
	obj.send(null)
	obj.onreadystatechange=function(){
		if(obj.readyState==4)
		document.getElementById('div1').innerHTML=obj.responseText;
	}
}
function filltext(msg)
{
	document.getElementById("msg").value = msg;
}
</script>
<script language=JavaScript>


function addids()
{
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

	<?php include("inc/left_menu.php"); ?>
    
    
    <div class="rightpanel">
    	<?php include("inc/header.php"); ?>
        
        <div class="maincontent">
        	<div class="contentinner">
              <?php include("../include/alerts.php"); ?>
            	       
                  <fieldset style="width:335px;; float:left;"> 
							
                            <input type="hidden" name="productid" id="productid"  onKeyPress="return isAlphaKey(event)" style="width:200px"/><!--onKeyUp="getRec1()"-->
                            
						</fieldset>
                        <fieldset style="width:335px;; float:left; margin-left:5px"> 
							
                            <input type="hidden" name="searchcode" id="searchcode" style="width:200px"/><!--onKeyUp="getRec1()"-->
                            
						</fieldset>
                        <br>
                       <!-- <form method="post" onSubmit="get_action(this);" action="pdf_barcode.php" target="_blank" >-->
                        <form method="get" onSubmit="get_action(this);" action="pdf_barcode.php" target="_blank" >
    					   
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
                        	
                          	<th width="11%" class="head0 nosort">S.No.</th>
                            <th width="18%" class="head0">Product Code</th>
                            <th width="18%" class="head0">Product Name</th>
                            <th width="18%" class="head0">Rate</th>
                            <th width="9%" class="head0">Batch</th>
                       </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_product");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
									   ?> <tr>
                                               <td><?php echo $slno++; ?></td> 
                                               <td><?php echo $row_get['prod_code'];?></td> 
                                               <td><?php echo $row_get['prodname']; ?></td> 
                                               <td><?php echo $row_get['rate']; ?></td> 
                                               <td><?php echo $row_get['batch_no']; ?></td> 
                        </tr>
                      <?php
						}
						?>
                        
                        
                    </tbody>
                </table>
						</form>
                         
           
        </div><!--maincontent-->
        
    </div>
    <!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
     <?php include("inc/footer.php"); ?>
    <!--footer-->

    
</div>  

</body>

</html>