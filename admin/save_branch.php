<?php
include("../adminsession.php");
  $branch_name= addslashes($_REQUEST['branch_name']);
 
  
if($branch_name !='')
{
	$form_data = array('branch_name'=>$branch_name,'enable'=>'enable','createdate'=>$createdate);
  dbRowInsert($connection,'m_branch', $form_data);
					
}
$res = mysqli_query($connection,"select branch_id,branch_name from m_branch order by branch_name");
echo "<option value=''>-select-</option>";
while($row = mysqli_fetch_array($res))
{
?>
	<option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></option>
<?php
}
?>