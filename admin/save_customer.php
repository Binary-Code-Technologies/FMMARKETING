<?php
include("../adminsession.php");
		$supparty_name= addslashes($_REQUEST['supparty_name']);  
		// $gender= trim(addslashes($_REQUEST['gender']));
		// $dob= trim(addslashes($_REQUEST['dob']));
		// $age= trim(addslashes($_REQUEST['age']));
		// $regdate= trim(addslashes($_REQUEST['regdate']));
		// $disid= trim(addslashes($_REQUEST['disid']));
		$mobile= addslashes($_REQUEST['mobile']);
		$address= trim(addslashes($_REQUEST['address']));
 $enable='enable';
  $type_supparty ='party';
  
if($supparty_name !='')
{
	$form_data = array('supparty_name'=>$supparty_name,'address'=>$address,'type_supparty'=>$type_supparty,'mobile'=>$mobile,'enable'=>$enable,'createdate'=>$createdate);
  dbRowInsert($connection,'m_supplier_party', $form_data);
					
}
$res = mysqli_query($connection,"select * from m_supplier_party where type_supparty='party'");

while($row = mysqli_fetch_array($res))
{
?>
	<option value="<?php echo $row['suppartyid']; ?>"><?php echo $row['supparty_name']; ?></option>
<?php
}
?>