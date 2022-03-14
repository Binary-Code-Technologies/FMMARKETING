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
	$(document).ready(function(){
	$("#shortcut_prod_id").click(function(){
		$("#div_prod_id").toggle(1000);
	});
	});
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
            	<!--widgetcontent-->        
                <div class="widgetcontent  shadowed nopadding">
                    <form class="stdform stdform2" method="get" onSubmit="return checkinputmaster('productid,numofbarchode nu');" action="pdf_barcode.php" target="_blank">
                    <?php echo  $dup;  ?>
                       <div class="lg-12 md-12 sm-12">
                        <label> Product Name</label>
                        <span class="field"> 
                             <select name="productid" id="productid" style="width:80%;"  class="chzn-select">
                                   <option value="">--Choose Product--</option>
                                    <?php
									$sql=mysqli_query($connection,"select * from m_product order by prodname");
									while($row=mysqli_fetch_assoc($sql))
									{								
									?>
                                    <option value="<?php echo $row['productid'];  ?>"> <?php echo $cmn->getvalfield($connection,"m_product_category","catname","pcatid='$row[pcatid]'").' / ' .$row['prodname']; ?></option>
                                    <?php } ?>
                                </select>
                             </span>
                               </div>
                               <div class="lg-12 md-12 sm-12">
                                <label>Number Of Barcode<span class="text-error">*</span> </label>
                               <span class="field">
                                <input type="text" name="numofbarchode" id="numofbarchode" class="input-xxlarge" value="<?php echo $numofbarchode;?>" style="width:80%;"autocomplete="off" autofocus />
                      	</span>
                       </div>
                           <center> <p class="stdformbutton">
                                <button  type="submit" name="submit" class="btn btn-primary">
								Print Barcode</button>
                                <a href="generate_barcode.php"  name="reset" id="reset" class="btn btn-success">Reset</a>
                           </p> </center>
                        </form>
                    </div>
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