<?php error_reporting(0);                                                                                                   include("../adminsession.php");
 $pcatid  = $_REQUEST['pcatid']; 

?>
    <option value="">Select Category</option>
    <?php
	//echo "select * from m_product_category where pcatid='$pcatid'";
    $sql2 = mysqli_query($connection,"select * from m_product_category where pcatid='$pcatid'");
    while($row2 = mysqli_fetch_assoc($sql2))
     { 
	        $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$row2[unitid]'");
	 
  ?>
    <option value="<?php echo $row2['unitid']; ?>"><?php echo $unit_name ; ?></option>
    <?php
   }
   ?>