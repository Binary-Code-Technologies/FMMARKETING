<?php
include("../adminsession.php");
  $supparty_name= addslashes($_REQUEST['supparty_name']);
  $mobile= addslashes($_REQUEST['mobile']);
  $prevbalance= trim(addslashes($_REQUEST['prevbalance']));
  $address= trim(addslashes($_REQUEST['address']));
  $bank_name=trim(addslashes($_REQUEST['bank_name']));
  $bank_ac=trim(addslashes($_REQUEST['bank_ac']));
  $ifsc_code=trim(addslashes($_REQUEST['ifsc_code']));
  $bank_address=trim(addslashes($_REQUEST['bank_address']));
  $tinno=trim(addslashes($_REQUEST['tinno']));
  $prevbal_date = $cmn->dateformatusa($_REQUEST['prevbal_date']);
  $cust_type=trim(addslashes($_REQUEST['cust_type']));
  $panno=trim(addslashes($_REQUEST['panno']));
  $stateid=trim(addslashes($_REQUEST['stateid']));
  $type_supparty ='party';
  
if($supparty_name !='')
{
	$form_data = array('supparty_name'=>$supparty_name,'address'=>$address,'type_supparty'=>$type_supparty,'mobile'=>$mobile,'stateid'=>$stateid,'cust_type'=>$cust_type,'panno'=>$panno,'prevbalance'=>$prevbalance,'enable'=>$enable,'bank_name'=>$bank_name,'bank_ac'=>$bank_ac,'bank_ac'=>$bank_ac,'ifsc_code'=>$ifsc_code,'bank_address'=>$bank_address,'tinno'=>$tinno,'prevbal_date'=>$prevbal_date,'createdate'=>$createdate);
  dbRowInsert($connection,'m_supplier_party', $form_data);
					
}
$res = mysqli_query($connection,"select * from m_supplier_party where type_supparty='party'");
echo "<option value=''>-select-</option>";
while($row = mysqli_fetch_array($res))
{
?>
	<option value="<?php echo $row['suppartyid']; ?>"><?php echo $row['supparty_name']; ?></option>
<?php
}
?>