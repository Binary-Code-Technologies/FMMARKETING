<?php include("../adminsession.php");
mysqli_query($connection,"insert into loginlogoutreport set userid ='$loginid',usertype = '$usertype',process = 'Logout',loginlogouttime = now(),createdate = now(),ipaddress = '$ipaddress'");
session_destroy();

echo "<script>location='../index.php?msg=logout' </script>" ;

?>