<?php  
ob_start();
session_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];
$truck = $_GET['truck'];
$trailer = $_GET['trailer'];
$trailer2 = $_GET['trailer2'];
$tanker = $_GET['tanker'];
$tanker2 = $_GET['tanker2'];
$client = $_GET['cl'];
$type = $_GET['tp'];

$shipment_reference1 = (strip_tags(stripslashes($_POST['shipment_reference'])));
$import_reference1 = (strip_tags(stripslashes($_POST['import_reference'])));
$container_number1 = (strip_tags(stripslashes($_POST['container_number'])));
// $job_detail1 = ucfirst(strip_tags(stripslashes($_POST['job_detail'])));
$product_type1 = ucfirst(strip_tags(stripslashes($_POST['product_type'])));
$quantity11 = (strip_tags(stripslashes($_POST['quantity1'])));
$quantity21 = (strip_tags(stripslashes($_POST['quantity2'])));
$tonnage1 = (strip_tags(stripslashes($_POST['tonnage'])));
$pickup_point1 = ucfirst(strip_tags(stripslashes($_POST['pickup_point'])));
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$delivery_point11 = ucfirst(strip_tags(stripslashes($_POST['delivery_point1'])));
$delivery_point21 = ucfirst(strip_tags(stripslashes($_POST['delivery_point2'])));
$truck_allocation1 = ucfirst(strip_tags(stripslashes($_POST['truck_allocation'])));
$trailer_allocation1 = ucfirst(strip_tags(stripslashes($_POST['trailer_allocation'])));
$trailer_allocation21 = ucfirst(strip_tags(stripslashes($_POST['trailer_allocation2'])));
$tanker_allocation1 = ucfirst(strip_tags(stripslashes($_POST['tanker_allocation'])));
$tanker_allocation21 = ucfirst(strip_tags(stripslashes($_POST['tanker_allocation2'])));
$driver_assigned1 = ucfirst(strip_tags(stripslashes($_POST['driver_assigned'])));



$shipment_reference = filter_var($shipment_reference1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$import_reference = filter_var($import_reference1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$container_number = filter_var($container_number1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
//$job_detail = filter_var($job_detail1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$product_type = filter_var($product_type1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity1 = filter_var($quantity11, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity2 = filter_var($quantity21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$tonnage = filter_var($tonnage1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pickup_point = filter_var($pickup_point1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$delivery_point1 = filter_var($delivery_point11, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$delivery_point2 = filter_var($delivery_point21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$truck_allocation = filter_var($truck_allocation1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$trailer_allocation = filter_var($trailer_allocation1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$trailer_allocation2 = filter_var($trailer_allocation21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$tanker_allocation = filter_var($tanker_allocation1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$tanker_allocation2 = filter_var($tanker_allocation21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$driver_assigned= filter_var($driver_assigned1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);



$time = date("d-m-Y")."-".time();
$attachment = $_FILES['attachment']['name'];
$picture = $time.$attachment;
$temp = $_FILES['attachment']['tmp_name'];
move_uploaded_file($temp,"attachment/".$picture);

$url = "attachment/$picture";


$user = $_SESSION["name"];

$sql4="select WORK_ORDER_NUMBER from work_order where work_order.ID=$id";
$result4 = ExecuteQuery($sql4);
$row4 = mysqli_fetch_array($result4);
$orderNumber = $row4['WORK_ORDER_NUMBER'];

$sql5="update truck set STATUS='',REFERENCE='' where truck.VEHICLE_REG='$truck'";
$result5=ExecuteNonQuery ($sql5);

$sql6="update trailer set STATUS='',REFERENCE='' where trailer.VEHICLE_REG='$trailer'";
$result6=ExecuteNonQuery ($sql6);

$sql7="update trailer_2 set STATUS='',REFERENCE='' where trailer_2.VEHICLE_REG='$trailer2'";
$result7=ExecuteNonQuery ($sql7);

$sql11="update tanker set STATUS='',REFERENCE='' where tanker.VEHICLE_REG='$tanker'";
$result11=ExecuteNonQuery ($sql11);

$sql12="update tanker_2 set STATUS='',REFERENCE='' where tanker_2.VEHICLE_REG='$tanker2'";
$result12=ExecuteNonQuery ($sql12);

if($url == "attachment/$time")
{
	$sql2=" update work_order set SHIPMENT_REFERENCE='$shipment_reference',IMPORT_REFERENCE='$import_reference',CONTAINER_NUMBER='$container_number',BILL_CLIENT='$client',CARGO_TYPE='$type',PRODUCT_TYPE='$product_type',QUANTITY_1='$quantity1',QUANTITY_2='$quantity2',TONNAGE='$tonnage',PICKUP_POINT='$pickup_point',PICKUP_DATE='$pickup_date',PICKUP_TIME='$pickup_time',DELIVERY_POINT_1='$delivery_point1',DELIVERY_POINT_2='$delivery_point2',TRUCK_ALLOCATION='$truck_allocation',TRAILER_ALLOCATION='$trailer_allocation',TRAILER_ALLOCATION_2='$trailer_allocation2',TANKER_ALLOCATION='$tanker_allocation',TANKER_ALLOCATION_2='$tanker_allocation2',DRIVER_ASSIGNED='$driver_assigned',UPDATED_BY='$user',UPDATED_AT=now() where work_order.ID=$id";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','work order updated',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		$sql8="update truck set STATUS='out',REFERENCE='$orderNumber' where truck.VEHICLE_REG='$truck_allocation'";
		$result8=ExecuteNonQuery ($sql8);
		
		$sql9="update trailer set STATUS='out',REFERENCE='$orderNumber' where trailer.VEHICLE_REG='$trailer_allocation'";
		$result9=ExecuteNonQuery ($sql9);
		
		$sql10="update trailer_2 set STATUS='out',REFERENCE='$orderNumber' where trailer_2.VEHICLE_REG='$trailer_allocation2'";
		$result10=ExecuteNonQuery ($sql10);
		
		$sql13="update tanker set STATUS='out',REFERENCE='$orderNumber' where tanker.VEHICLE_REG='$tanker_allocation'";
		$result13=ExecuteNonQuery ($sql13);
		
		$sql14="update tanker_2 set STATUS='out',REFERENCE='$orderNumber' where tanker_2.VEHICLE_REG='$tanker_allocation2'";
		$result14=ExecuteNonQuery ($sql14);
		
		header("location: acc_work-order-details.php?id=$id&act=editvalid");
	}
	else
	{
		header("location: acc_work-order-details.php?id=$id&act=editinvalid");
	}
}
else
{
	$sql2=" update work_order set ATTACHMENT='$url',SHIPMENT_REFERENCE='$shipment_reference',IMPORT_REFERENCE='$import_reference',CONTAINER_NUMBER='$container_number',BILL_CLIENT='$client',CARGO_TYPE='$type',PRODUCT_TYPE='$product_type',QUANTITY_1='$quantity1',QUANTITY_2='$quantity2',TONNAGE='$tonnage',PICKUP_POINT='$pickup_point',PICKUP_DATE='$pickup_date',PICKUP_TIME='$pickup_time',DELIVERY_POINT_1='$delivery_point1',DELIVERY_POINT_2='$delivery_point2',TRUCK_ALLOCATION='$truck_allocation',TRAILER_ALLOCATION='$trailer_allocation',TRAILER_ALLOCATION_2='$trailer_allocation2',TANKER_ALLOCATION='$tanker_allocation',TANKER_ALLOCATION_2='$tanker_allocation2',DRIVER_ASSIGNED='$driver_assigned',UPDATED_BY='$user',UPDATED_AT=now() where work_order.ID=$id";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','work order updated',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		$sql8="update truck set STATUS='out',REFERENCE='$orderNumber' where truck.VEHICLE_REG='$truck_allocation'";
		$result8=ExecuteNonQuery ($sql8);
		
		$sql9="update trailer set STATUS='out',REFERENCE='$orderNumber' where trailer.VEHICLE_REG='$trailer_allocation'";
		$result9=ExecuteNonQuery ($sql9);
		
		$sql10="update trailer_2 set STATUS='out',REFERENCE='$orderNumber' where trailer_2.VEHICLE_REG='$trailer_allocation2'";
		$result10=ExecuteNonQuery ($sql10);
		
		$sql13="update tanker set STATUS='out',REFERENCE='$orderNumber' where tanker.VEHICLE_REG='$tanker_allocation'";
		$result13=ExecuteNonQuery ($sql13);
		
		$sql14="update tanker_2 set STATUS='out',REFERENCE='$orderNumber' where tanker_2.VEHICLE_REG='$tanker_allocation2'";
		$result14=ExecuteNonQuery ($sql14);
		
		header("location: acc_work-order-details.php?id=$id&act=editvalid");
	}
	else
	{
		header("location: acc_work-order-details.php?id=$id&act=editinvalid");
	}
}



?>