<?php error_reporting(0);
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
$stateid=trim(addslashes($_REQUEST['stateid']));
$prevbal_date = $cmn->dateformatusa($_REQUEST['prevbal_date']);
$type_supparty ='supplier';


if($supparty_name !='')
{
	$form_data = array('supparty_name'=>$supparty_name,'address'=>$address,'type_supparty'=>$type_supparty,'mobile'=>$mobile, 'prevbalance'=>$prevbalance,'enable'=>$enable,'bank_name'=>$bank_name,'bank_ac'=>$bank_ac,'stateid'=>$stateid,'ifsc_code'=>$ifsc_code,'bank_address'=>$bank_address,'tinno'=>$tinno,'prevbal_date'=>$prevbal_date,'createdate'=>$createdate);
			    dbRowInsert($connection,'m_supplier_party', $form_data);
		
}

$res = mysqli_query($connection,"select * from m_supplier_party where type_supparty='supplier' order by supparty_name");
echo "<option value=''>-select-</option>";
while($row = mysqli_fetch_array($res))
{
?>
	<option value="<?php echo $row['suppartyid']; ?>"><?php echo strtoupper($row['supparty_name']); ?></option>
<?php
}
?>