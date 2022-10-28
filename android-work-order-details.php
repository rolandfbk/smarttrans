  <?php 
	ob_start();
	
	require("utility.php");
?>

<?php

	$id = $_GET['id'];

?>
<?php
	$sql="select * from work_order where work_order.WORK_ORDER_NUMBER='$id'";
	$result=ExecuteQuery($sql);
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		$attachment = $row['ATTACHMENT'];
		$work_order_number = $row['WORK_ORDER_NUMBER'];
		$shipment_reference = $row['SHIPMENT_REFERENCE'];
		$import_reference = $row['IMPORT_REFERENCE'];
		$container_number = $row['CONTAINER_NUMBER'];
		$bill_client = $row['BILL_CLIENT'];
		$cargo_type = $row['CARGO_TYPE'];
		$product_type = $row['PRODUCT_TYPE'];
		$quantity = $row['QUANTITY'];
		$tonnage = $row['TONNAGE'];
		$pickup_point = $row['PICKUP_POINT'];
		$pickup_date = $row['PICKUP_DATE'];
		$pickup_time = $row['PICKUP_TIME'];
		$delivery_point1 = $row['DELIVERY_POINT_1'];
		$delivery_point2 = $row['DELIVERY_POINT_2'];
		$truck_allocation = $row['TRUCK_ALLOCATION'];
		$trailer_allocation = $row['TRAILER_ALLOCATION'];
		$trailer_allocation2 = $row['TRAILER_ALLOCATION_2'];
		$tanker_allocation = $row['TANKER_ALLOCATION'];
		$tanker_allocation2 = $row['TANKER_ALLOCATION_2'];
		$driver_assigned = $row['DRIVER_ASSIGNED'];
		$status = $row['STATUS'];
		
	}
	
	$sql2="select * from truck where truck.VEHICLE_REG='$truck_allocation'";
	$result2=ExecuteQuery($sql2);
	$row2 = mysqli_fetch_array($result2);
	$truck_vehicle_make = $row2['VEHICLE_MAKE'];
	$truck_vehicle_reg = $row2['VEHICLE_REG'];
	$truck_vehicle_fleet_no = $row2['VEHICLE_FLEET_NO'];
	$truck_vin_no = $row2['VIN_NO'];
	
	
	$sql3="select * from trailer where trailer.VEHICLE_REG='$trailer_allocation'";
	$result3=ExecuteQuery($sql3);
	$row3 = mysqli_fetch_array($result3);
	$trailer_vehicle_make = $row3['VEHICLE_MAKE'];
	$trailer_vehicle_reg = $row3['VEHICLE_REG'];
	$trailer_vin_no = $row3['VIN_NO'];
	
	$sql21="select * from trailer_2 where trailer_2.VEHICLE_REG='$trailer_allocation2'";
	$result21=ExecuteQuery($sql21);
	$row21 = mysqli_fetch_array($result21);
	$trailer2_vehicle_make = $row21['VEHICLE_MAKE'];
	$trailer2_vehicle_reg = $row21['VEHICLE_REG'];
	$trailer2_vin_no = $row21['VIN_NO'];
	
	$sql24="select * from tanker where tanker.VEHICLE_REG='$tanker_allocation'";
	$result24=ExecuteQuery($sql24);
	$row24 = mysqli_fetch_array($result24);
	$tanker_vehicle_make = $row24['VEHICLE_MAKE'];
	$tanker_vehicle_reg = $row24['VEHICLE_REG'];
	$tanker_vin_no = $row24['VIN_NO'];
	
	$sql25="select * from tanker_2 where tanker_2.VEHICLE_REG='$tanker_allocation2'";
	$result25=ExecuteQuery($sql25);
	$row25 = mysqli_fetch_array($result25);
	$tanker2_vehicle_make = $row25['VEHICLE_MAKE'];
	$tanker2_vehicle_reg = $row25['VEHICLE_REG'];
	$tanker2_vin_no = $row25['VIN_NO'];
	
	$sql4="select * from controller_user where controller_user.REFERENCE_NUMBER='$driver_assigned'";
	$result4=ExecuteQuery($sql4);
	$row4 = mysqli_fetch_array($result4);
	$driver_first_name = $row4['FIRST_NAME'];
	$driver_surname = $row4['SURNAME'];
	$driver_reference_number = $row4['REFERENCE_NUMBER'];
	
	$sql5="select * from pickup where pickup.WORK_ORDER_NUMBER='$id'";
	$result5=ExecuteQuery($sql5);
	
	$pickup_confirm = "no";
	
	if(mysqli_num_rows($result5)==1)
	{
		$pickup_confirm = "yes";
	}
	
	$sql7="select * from delivery where delivery.WORK_ORDER_NUMBER='$id'";
	$result7=ExecuteQuery($sql7);
	
	$delivery_confirm1 = "no";
	
	if(mysqli_num_rows($result7)==1)
	{
		$delivery_confirm1 = "yes";
	}
	
	
	$sql26="select * from delivery2 where delivery2.WORK_ORDER_NUMBER='$id'";
	$result26=ExecuteQuery($sql26);
	
	$delivery_confirm2 = "no";
	
	if(mysqli_num_rows($result26)==1)
	{
		$delivery_confirm2 = "yes";
	}
	
	
	
	$StringCount = strlen($attachment);
	if($StringCount <= 33)
	{
		$attach = "";
	}
	else
	{
		$attach = $attachment;
	}
	
	
	$order[] = array(
		'attachment'  => $attach,
		'work_order_number'  => $work_order_number,
		'shipment_reference'  => $shipment_reference,
		'import_reference'  => $import_reference,
		'container_number'  => $container_number,
		'bill_client'  => $bill_client,
		'product_type'  => $product_type,
		'quantity'  => $quantity,
		'tonnage'  => $tonnage,
		'pickup_point'  => $pickup_point,
		'pickup_date'  => $pickup_date,
		'pickup_time'  => $pickup_time,
		'delivery_point1'  => $delivery_point1,
		'delivery_point2'  => $delivery_point2,
		'truck_allocation'  => $truck_allocation,
		'trailer_allocation'  => $trailer_allocation,
		'trailer_allocation2'  => $trailer_allocation2,
		'tanker_allocation'  => $tanker_allocation,
		'tanker_allocation2'  => $tanker_allocation2,
		'driver_assigned'  => $driver_assigned,
		'status'  => $status,
		'cargo_type'  => $cargo_type,
		
		'truck_vehicle_make'  => $truck_vehicle_make,
		'truck_vehicle_reg'  => $truck_vehicle_reg,
		'truck_vehicle_fleet_no'  => $truck_vehicle_fleet_no,
		'truck_vin_no'  => $truck_vin_no,
		
		'trailer_vehicle_make'  => $trailer_vehicle_make,
		'trailer_vehicle_reg'  => $trailer_vehicle_reg,
		'trailer_vin_no'  => $trailer_vin_no,
		
		'trailer2_vehicle_make'  => $trailer2_vehicle_make,
		'trailer2_vehicle_reg'  => $trailer2_vehicle_reg,
		'trailer2_vin_no'  => $trailer2_vin_no,
		
		'tanker_vehicle_make'  => $tanker_vehicle_make,
		'tanker_vehicle_reg'  => $tanker_vehicle_reg,
		'tanker_vin_no'  => $tanker_vin_no,
		
		'tanker2_vehicle_make'  => $tanker2_vehicle_make,
		'tanker2_vehicle_reg'  => $tanker2_vehicle_reg,
		'tanker2_vin_no'  => $tanker2_vin_no,
		
		'driver_first_name'  => $driver_first_name,
		'driver_surname'  => $driver_surname,
		'driver_reference_number'  => $driver_reference_number,
		
		'pickup_confirm' => $pickup_confirm,
		'delivery_confirm1' => $delivery_confirm1,
		'delivery_confirm2' => $delivery_confirm2
		);
		
	$json = json_encode($order);
	
	echo $json;
?>
