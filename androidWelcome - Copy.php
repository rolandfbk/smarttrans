<?php
    
    ob_start();
	require_once("utility.php");
	
	
	  // Innitialize Variable
	  $result='';
	  $username = $_POST['username'];
	  
	  // Query database for row exist or not
	  $sql="select * from controller_user where EMAIL='$username'"	;
		$result1 = ExecuteQuery($sql);
	  if (mysqli_num_rows($result1)==1)
	  {
		  $row = mysqli_fetch_array($result1);
		  $name = $row["FIRST_NAME"];
		  
		 $result= "Welcome ".$name;	
	  }  
	  else
	  {
			$result="Work Order";
	  }
	  
	  // send result back to android
	  echo "$result";
  	
	
?>