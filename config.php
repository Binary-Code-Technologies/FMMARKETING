<?php
		//database configuration
		if($_SERVER["SERVER_NAME"]=="localhost" || $_SERVER["SERVER_NAME"]=="ghanshyam" || $_SERVER["SERVER_NAME"]=="trinityhome" || $_SERVER["SERVER_NAME"]=="trinitypc2-pc")
		{
			$host_name="localhost";
			$db_name="fm_marketing";
			$db_user="root";
			$db_pwd="";
		}
		else
		{
			$host_name="localhost";
			$db_name="rashmfyw_tilesbill";
			$db_user="rashmfyw_tilesbill";
			$db_pwd="z~&RDP&Y}xH)";
			//https://p3nlmysqladm002.secureserver.net/grid55/287/index.php
			
			
			
			
			
			
		}
		
		//connect databse
		$connection=mysqli_connect("$host_name","$db_user","$db_pwd",$db_name);
		
		if(!$connection){
			die("Failed to connect ");
		}
	
?>
