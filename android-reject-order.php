<?php
    
    ob_start();
	require_once("utility.php");
	
	// Check whether username or password is set from android	
     if(isset($_POST['ref_num']) && isset($_POST['reject']))
     {
		// Innitialize Variable
		$result='';
		$orderNumber = $_POST['ref_num'];
		$reject = $_POST['reject'];
		
		
		
		
		$sql3="select DRIVER_ASSIGNED from work_order where WORK_ORDER_NUMBER='$orderNumber'";
		$result3=ExecuteQuery($sql3);
		$row3 = mysqli_fetch_array($result3);
		$driver = $row3['DRIVER_ASSIGNED'];
		
		$sql4="select FIRST_NAME,SURNAME from controller_user where REFERENCE_NUMBER='$driver'";
		$result4=ExecuteQuery($sql4);
		$row4 = mysqli_fetch_array($result4);
		$first_name = $row4['FIRST_NAME'];
		$surname = $row4['SURNAME'];
		$user = $first_name." ".$surname;
		
		$reason1 = $reject;
		
		$reason = filter_var($reason1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		
		$rejected_by = "Rejected by $first_name $surname";
		
		  
		// Query database for row exist or not
		$sql2="update work_order set DRIVER_RESPONSE='no',REJECT_REASON='$reason',REJECTED_BY='$rejected_by',DRIVER_ASSIGNED='' where work_order.WORK_ORDER_NUMBER='$orderNumber'";
		$result2=ExecuteNonQuery ($sql2);

		if($result2)
		{
			$sql27=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','work order viewed and rejected  ==> $reason',now(),now(),'$user',now())";
			$result27=ExecuteNonQuery ($sql27);
			
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