<?php error_reporting(0);
include("../adminsession.php");
$tblname = "m_product";
$tblpkey = "productid";
 $dob = $_REQUEST['data']; 
 $currentdate=date('Y-m-d');

$date1 = strtotime($currentdate); 
$date2 = strtotime($dob); 
  
// Formulate the Difference between two dates
 $diff = abs($date1 - $date2); 
echo $years = floor($diff / (365*60*60*24)); 

?>