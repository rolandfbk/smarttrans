<?php
    
    ob_start();
	require_once("utility.php");
	
	$id = $_GET['id'];
	//$id = 'driver@test.com';
	
	//$id = "joelle@test.com";
	
	$stops2 = "";
	$wo2 = "";

	$number = "";
	
	$sql12="select * from controller_user where EMAIL='$id'"	;
	$result12 = ExecuteQuery($sql12);
	if (mysqli_num_rows($result12)==1)
	{
	  $row12 = mysqli_fetch_array($result12);
	  //$username = $row12["FIRST_NAME"];
	  $number = $row12["REFERENCE_NUMBER"];
	}
	 
	$sql3="select * from user where DRIVER='$number'";
	$result3=ExecuteQuery($sql3);
	if(mysqli_num_rows($result3)==1)
	{
		$row3 = mysqli_fetch_array($result3);
		$stops = $row3['STOPS'];
		$wo = $row3['WORK_ORDER_NUMBER'];
		
		if($stops == "")
		{
			$stops2 = "";
		}
		else{
			$stops2 = $stops;
		}
		
		if($wo == "")
		{
			$wo2 = "";
		}
		else{
			$wo2 = $wo;
		}
	}
	 
	  
	  // Query database for row exist or not
	  $sql1="select * from controller_user where EMAIL='$id'"	;
		$result1 = ExecuteQuery($sql1);
	  if (mysqli_num_rows($result1)==1)
	  {
		  $row1 = mysqli_fetch_array($result1);
		  $ref_number = $row1["REFERENCE_NUMBER"];
		  
			$sql2="select * from work_order where work_order.DRIVER_ASSIGNED='$ref_number' and STATUS!='archive' order by CREATED_AT desc";
			$result2 = ExecuteQuery($sql2);
			
			while($row2 = mysqli_fetch_array($result2))
			{
				//$order['id'] = $row2['ID'];
				//$order['subjects'] = $row2['WORK_ORDER_NUMBER'];
				
				$order[] = array(
					'id'  => $row2['QUANTITY'],
					'subjects'  => $row2['WORK_ORDER_NUMBER'],
					'driver'  => $row2['PRODUCT_TYPE'],
					'pickup'  => $row2['PICKUP_POINT'],
					'stops'  => $stops2,
					
					'wo'  => $wo2,
					'response'  => $row2['DRIVER_RESPONSE'],
					
					'work_order_number'  => $row2['WORK_ORDER_NUMBER'],
					'bill_client'  => $row2['BILL_CLIENT'],
					'product_type'  => $row2['PRODUCT_TYPE'],
					'quantity'  => $row2['QUANTITY'],
					'tonnage'  => $row2['TONNAGE'],
					'pickup_point'  => $row2['PICKUP_POINT'],
					'pickup_date'  => $row2['PICKUP_DATE'],
					'pickup_time'  => $row2['PICKUP_TIME'],
					'delivery_point1'  => $row2['DELIVERY_POINT_1'],
					'delivery_point2'  => $row2['DELIVERY_POINT_2'],
					
					'view'  => $row2['VIEW'],
					);
				
			}
		  
			$json = json_encode($order);	
	  }  
	  else
	  {
			$order['subjects'] = "No Work Order assigned";
			$json = json_encode(array($order));
	  }
	  
	  // send result back to android
	  echo $json;
  	
	
?>