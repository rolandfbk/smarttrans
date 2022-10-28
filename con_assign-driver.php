<?php  
ob_start();
session_start();
require("utility.php"); ?>

<?php

$id = $_GET['id'];

$sql2="select * from work_order where work_order.ID=$id";
$result2=ExecuteQuery($sql2);
if (mysqli_num_rows($result2)==1)
{
	$row = mysqli_fetch_array($result2);
	$attachment = $row['ATTACHMENT'];
	$work_order_number = $row['WORK_ORDER_NUMBER'];
	$shipment_reference = $row['SHIPMENT_REFERENCE'];
	$import_reference = $row['IMPORT_REFERENCE'];
	$bill_client = $row['BILL_CLIENT'];
	$container_number = $row['CONTAINER_NUMBER'];
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
	$reject_reason = $row['REJECT_REASON'];
	$status = $row['STATUS'];
	$pastel = $row['PASTEL'];
	$gate_time = $row['GATE_TIME'];
	$security_name = $row['SECURITY_NAME'];
	$gate_signature = $row['GATE_SIGNATURE'];
	$type = $row['CARGO_TYPE'];
	$created = $row['CREATED_AT'];
	$quantity_1 = $row['QUANTITY_1'];
	$quantity_2 = $row['QUANTITY_2'];
	
}



$driver1 = ucfirst(strip_tags(stripslashes($_POST['driver'])));

$driver = filter_var($driver1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$user = $_SESSION["name"];

$sql4="select * from controller_user where controller_user.REFERENCE_NUMBER='$driver'";
$result4=ExecuteQuery($sql4);
$row4 = mysqli_fetch_array($result4);
$driver_first_name = $row4['FIRST_NAME'];
$driver_surname = $row4['SURNAME'];

$sql="update work_order set DRIVER_ASSIGNED='$driver',DRIVER_RESPONSE='',REJECT_REASON='',REJECTED_BY='',UPDATED_AT=now() where work_order.ID=$id";

$result=ExecuteNonQuery ($sql);

if($result)
{
	$sql27=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$work_order_number','work order re-assigned to driver $driver_first_name $driver_surname',now(),now(),'$user',now())";
	$result27=ExecuteNonQuery ($sql27);
			
	header("location: con_work-order-manage.php?act=drivervalid");
}
else
{
	header("location: con_work-order-manage.php?act=driverinvalid");
}
?>