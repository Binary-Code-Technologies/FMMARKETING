<?php session_start();
include("config.php");
 
include("lib/dboperation.php");
include_once("lib/getval.php");
$cmn = new Comman();
$ipaddress = $cmn->get_client_ip();


if(isset($_POST['login']))
{
	
	$admin_name = test_input($_POST['admin_name']);	
	$admin_pwd = test_input($_POST['admin_pwd']);
	$createdate = date('Y-m-d');
	//$admin_pwd =encrypt($admin_pwd,"trinitysolutions");
	
	
	if($admin_name != "" && $admin_pwd != "" )
	{
		//echo "hii" ;
	   
		$res = mysqli_query($connection,"select * from billuser where username='$admin_name' and password='$admin_pwd'");
		$count = mysqli_num_rows($res);
		
		if($count == 1)
		{
			$login_fetch = mysqli_fetch_assoc($res);
			$_SESSION['userid'] = $login_fetch['userid'];
			$_SESSION['usertype'] = $login_fetch['usertype'];
			
			mysqli_query($connection,"insert into loginlogoutreport set userid ='$_SESSION[userid]',usertype = '$_SESSION[usertype]', process = 'Login', loginlogouttime = now(), createdate = '$createdate', ipaddress = '$ipaddress'");
		
			
			echo "<script>location='admin/index.php' </script>" ;
		}
		else
		echo "<script>location='index.php?msg=error' </script>" ;
	}
	echo "<script>location='index.php?msg=blank' </script>" ;
}

?>