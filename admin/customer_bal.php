<?php
//error_reporting(0);
include("../adminsession.php");
$pagename ="customer_bal.php"; 
$pageheading = "Customer Balance Report";
$module = "Customer Balance Report";
$submodule = "Customer Balance Report";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "saleentry";
$tblpkey = "saleid";
if(isset($_GET['saleid']))
$keyvalue = $_GET['saleid'];
else
$keyvalue = 0;
if(isset($_GET['action']))
$action = $_GET['action'];

$search_sql = "";
$suppartyid = $_GET['suppartyid'];

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
                    <form class="stdform stdform2" method="get" action="">
                    
                    <table id="mytable01" align="center" class="table table-bordered table-condensed"  >
                    <tr>    
                       <th>Customer </th> 
                    </tr>
                    <tr>
                     <td style="width:70%;">
                       <select id="suppartyid" name="suppartyid" class="form-control chzn-select" style="width:100%;">
                    <option value="">-select-</option>
                    <?php     
						    	    $sql = mysqli_query($connection,"select * from  m_supplier_party where type_supparty='party' order by supparty_name ") ;
                            while($row= mysqli_fetch_assoc($sql))
                            {
                            ?>
                                        <option value="<?php echo $row['suppartyid'];?>"><?php echo $row['supparty_name'];?></option>
                                          <?php 
                            }
                            ?>
                   </select>
                                    
                                  <script> document.getElementById('suppartyid').value='<?php echo $suppartyid; ?>'; </script>  
                    </td>
                    
                     
                    <td>&nbsp; <button  type="submit" name="search" class="btn btn-primary" onClick="return checkinputmaster('fromdate');"> Search 
                    </button></td>
                    <td>&nbsp; <a href="customer_bal.php"  name="reset" id="reset" class="btn btn-success">Reset</a></td>
                    
                    </tr>
                    </table>
                    
                    
                        </form>
                    </div>
                    <p align="right" style="margin-top:7px; margin-right:10px;"> <a href="pdf_customer_bal_report.php?suppartyid=<?php echo $suppartyid;?>" class="btn btn-info" target="_blank">
                    <span style="font-weight:bold;text-shadow: 2px 2px 2px #000; color:#FFF">Print PDF</span></a></p> 
               
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
                          	<th style="background-color:LightGray;" width="7%" class="head0 nosort">S.No.</th>
                            <th style="background-color:LightGray;" width="16%" class="head0" >Customer Name</th>
                            <th style="background-color:LightGray;" width="16%" class="head0" >Mobile No</th>
                            <th style="background-color:LightGray;" width="16%" class="head0" >Address</th>
                             <th style="background-color:LightGray;" width="11%" class="head0" >Balance Amount</th>
                        </tr> 
                    </thead>
                     
        <tbody id="record">
                </span>
                    <?php
                        $slno=1;
                        $cond=" where 1=1";
                                        if($suppartyid!='') 
                                        {
                                        $cond .=" and suppartyid='$suppartyid'"; 
                                        }
                        $sql_get = mysqli_query($connection,"select * from m_supplier_party $cond and type_supparty='party'  order by suppartyid desc");
                        while($row_get = mysqli_fetch_assoc($sql_get))
                        {
                                
                            $supparty_name =$row_get['supparty_name'];
                            $mobile =$row_get['mobile'];
                            $address =$row_get['address'];
                            $prevbalance =$row_get['prevbalance'];
                            $suppartyid =$row_get['suppartyid'];

                            $saleamt = $cmn->getvalfield($connection,"saleentry","sum(totalsale)","suppartyid='$suppartyid'");
                    
                            $payamt = $cmn->getvalfield($connection,"payment","sum(payamt)","suppartyid='$suppartyid'");

                            $balamt = $prevbalance + $saleamt - $payamt;
                            if($balamt!=0){

                            ?> <tr>
                                <td><?php echo $slno++; ?></td> 
                                <td><?php echo $supparty_name; ?></td>  
                                <td><?php echo $mobile; ?></td>      
                                <td><?php echo $address; ?></td>      

                                <td><?php echo number_format(round($balamt),2);  ?></td>
                                </tr>
            <?php
            }}
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
</script>

</body>

</html>
