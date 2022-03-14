<?php
include("../adminsession.php");
$pagename = "generate_barcode.php";
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

if(isset($_POST['submit']))
{  

 $pageid = trim(addslashes($_POST['pageid']));
 $hiddenid   = $_POST['hiddenid'];
}

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
	searchname=document.getElementById("searchname").value;
	//alert(course_id);
	if(navigator.appName=="Microsoft Internet Explorer")
	obj=new ActiveXObject("Msxml2.XMLHTTP")
	else
	obj=new XMLHttpRequest()
	obj.open("post","get_product_for_barcode.php?searchname=" + searchname,true)
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
							
                            <input type="hidden" name="searchname" id="searchname"  onKeyPress="return isAlphaKey(event)" style="width:200px"/><!--onKeyUp="getRec1()"-->
                            
						</fieldset>
                        <fieldset style="width:335px;; float:left; margin-left:5px"> 
							
                            <input type="hidden" name="searchcode" id="searchcode" style="width:200px"/><!--onKeyUp="getRec1()"-->
                            
						</fieldset>
                        <br>
                       <!-- <form method="post" onSubmit="get_action(this);" action="pdf_barcode.php" target="_blank" >-->
                        <form method="post" onSubmit="get_action(this);" action="pdf_barcode.php" target="_blank" >
    					<table width="100%" border="0" style="float:right">
                      <tr>
                        <td width="45%">
                        <fieldset style="width:335px;">
                         <legend style="margin-left:10px">Product  List</legend>
                        <div align="center" id="div1" style="overflow:auto;width:100%;height:416px;border:0px solid #009"></div>
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
                   <td>&nbsp; </td>
                   </tr>
                     <tr>
                    	<td width="60%"><button type="submit" name="submit" id="submit" class="btn btn-primary" >Print Barcode</button>  &nbsp;
                        <button type="button" onClick="document.location='<?php echo $pagename;?>'" class="btn btn-success">Reset</button>
                        </td>
                    	                    
                      </tr>
                    
                    </table>
				</fieldset></td>
                      </tr>
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
<script>
 function get_action(form) {
	 pageid = $("#pageid").val();
	 if(pageid == '1')
        form.action = "pdf_barcode.php";
	else if(pageid == '2')
        form.action = "pdf_barcode_single.php";
    }
    $(document).ready(function() { 
        $('#searchname').keyup(function() { 
								//	alert('g');
            var searchterm = $('#searchname').val().toLowerCase(); 
			 var searchcode = $('#searchcode').val().toLowerCase(); 
            $('.data-content').each(function() { 
                var custname = $(this).attr('data-table').toLowerCase(); 
				 var custcode = $(this).attr('data-code').toLowerCase(); 
				 
				 if(custname != "" && custcode != "")
				 {
                    if (custname.indexOf(searchterm) == 0 && custcode.indexOf(searchcode) == 0) { 
                        $(this).show(); 
                    } 
                    else { 
                        $(this).hide(); 
                    }
				 }
				 else if(custname != "" && custcode == "")
				 {
                    if (custname.indexOf(searchterm) == 0) { 
                        $(this).show(); 
                    } 
                    else { 
                        $(this).hide(); 
                    }
				 }
				 else if(custname == "" && custcode != "")
				 {
                    if (custcode.indexOf(searchcode) == 0) { 
                        $(this).show(); 
                    } 
                    else { 
                        $(this).hide(); 
                    }
				 }
            }); 
        }); 
		 $('#searchcode').keyup(function() { 
								//	alert('g');
           						//	alert('g');
            var searchterm = $('#searchname').val().toLowerCase(); 
			 var searchcode = $('#searchcode').val().toLowerCase(); 
            $('.data-content').each(function() { 
                var custname = $(this).attr('data-table').toLowerCase(); 
				 var custcode = $(this).attr('data-code').toLowerCase(); 
				 
				 if(custname != "" && custcode != "")
				 {
                    if (custname.indexOf(searchterm) == 0 && custcode.indexOf(searchcode) == 0) { 
                        $(this).show(); 
                    } 
                    else { 
                        $(this).hide(); 
                    }
				 }
				 else if(custname != "" && custcode == "")
				 {
                    if (custname.indexOf(searchterm) == 0) { 
                        $(this).show(); 
                    } 
                    else { 
                        $(this).hide(); 
                    }
				 }
				 else if(custname == "" && custcode != "")
				 {
                    if (custcode.indexOf(searchcode) == 0) { 
                        $(this).show(); 
                    } 
                    else { 
                        $(this).hide(); 
                    }
				 }
            }); 
        }); 
    });
</script>
</body>

</html>