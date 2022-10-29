<?php
    
    ob_start();
	require_once("utility.php");
	
	// Check whether username or password is set from android	
     if(isset($_POST['username']) && isset($_POST['password']))
     {
		  // Innitialize Variable
		  $result='';
	   	  $username = $_POST['username'];
          $password = $_POST['password'];
		  
		  // Query database for row exist or not
          $sql="select * from controller_user where EMAIL='$username' and PASSWORD='$password' and USER_TYPE='mobile'"	;
			$result1 = ExecuteQuery($sql);
          if (mysqli_num_rows($result1)==1)
          {
			 $result="true";	
          }  
          else
          {
			  	$result="false";
          }
		  
		  // send result back to android
   		  echo "$result";
  	}
	
?>