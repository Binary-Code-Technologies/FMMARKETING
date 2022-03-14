<?php
include("../adminsession.php");
  $tax_id=$_REQUEST['tax_id'];
  $amount=$_REQUEST['amount'];

if($tax_id !='')
{
$tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
$taxamt = $amount*$tax/100;
$total =$amount+$taxamt; 

echo $total;

}



?>