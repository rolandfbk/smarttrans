<?php
    
    ob_start();
	require_once("utility.php");
	
	// Check whether username or password is set from android	
     if(isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['email']))
     {
		// Innitialize Variable
		$result='';
		$longitude = $_POST['longitude'];
		$latitude = $_POST['latitude'];
		$email = $_POST['email'];
		
		
		
		$sql4="select REFERENCE_NUMBER from controller_user where EMAIL='$email'";
		$result4=ExecuteQuery($sql4);
		$row4 = mysqli_fetch_array($result4);
		$ref = $row4['REFERENCE_NUMBER'];
		
		
		  
		// Query database for row exist or not
		if($ref != "")
		{
			$sql2="INSERT INTO gps (NAME,LONGTITUDE,LATITUDE,DATE,CREATED_AT) values ('$ref','$longitude','$latitude',now(),now())";
			$result2=ExecuteNonQuery ($sql2);
		}
		// if($result2)
		// {
			
			// $result="true";
		// }
		// else
		// {
			// $result="false";
		// }
		  
		// // send result back to android
   		// echo "$result";
  	}
	
?>