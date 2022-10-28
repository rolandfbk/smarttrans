<?php  
ob_start();
session_start();
require("utility.php");
 ?>


<?php

$client = $_GET['cl'];
$type = $_GET['tp'];

$shipment_reference1 = (strip_tags(stripslashes($_POST['shipment_reference'])));
$import_reference1 = (strip_tags(stripslashes($_POST['import_reference'])));
$container_number1 = (strip_tags(stripslashes($_POST['container_number'])));
// $job_detail1 = ucfirst(strip_tags(stripslashes($_POST['job_detail'])));
$product_type1 = ucfirst(strip_tags(stripslashes($_POST['product_type'])));
$quantity1 = (strip_tags(stripslashes($_POST['quantity'])));
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
// $job_detail = filter_var($job_detail1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$product_type = filter_var($product_type1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity = filter_var($quantity1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
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



// $attachment = $_FILES['attachment']['name'];
// $temp = $_FILES['attachment']['tmp_name'];
// move_uploaded_file($temp,"attachment/".$attachment);

//$url = "attachment/$attachment";

$time = date("d-m-Y")."-".time();
$attachment = $_FILES['attachment']['name'];
$picture = $time.$attachment;
$temp = $_FILES['attachment']['tmp_name'];
move_uploaded_file($temp,"attachment/".$picture);

$url = "attachment/$picture";

$sql=" INSERT INTO table1 (PREFIX) values ('GTW')";
$result=ExecuteNonQuery ($sql);


$sql1="select * from table1 order by ID desc limit 1";
$result1 = ExecuteQuery($sql1);
if (mysqli_num_rows($result1)==1)
{
	$row = mysqli_fetch_array($result1);
	$id = $row['ID'];
	$prefix = $row['PREFIX'];

}

$orderNumber = $prefix . $id;

$user = $_SESSION["name"];


$sql2=" INSERT INTO work_order (ATTACHMENT,WORK_ORDER_NUMBER,SHIPMENT_REFERENCE,IMPORT_REFERENCE,CONTAINER_NUMBER,BILL_CLIENT,CARGO_TYPE,PRODUCT_TYPE,QUANTITY,TONNAGE,PICKUP_POINT,PICKUP_DATE,PICKUP_TIME,DELIVERY_POINT_1,DELIVERY_POINT_2,TRUCK_ALLOCATION,TRAILER_ALLOCATION,TRAILER_ALLOCATION_2,TANKER_ALLOCATION,TANKER_ALLOCATION_2,DRIVER_ASSIGNED,CREATED_BY,STATUS,CREATED_AT,UPDATED_AT,PRINT_FROM) values ('$url','$orderNumber','$shipment_reference','$import_reference','$container_number','$client','$type','$product_type','$quantity','$tonnage','$pickup_point','$pickup_date','$pickup_time','$delivery_point1','$delivery_point2','$truck_allocation','$trailer_allocation','$trailer_allocation2','$tanker_allocation','$tanker_allocation2','$driver_assigned','$user','created',now(),now(),now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	$sql5="update truck set STATUS='out',REFERENCE='$orderNumber' where truck.VEHICLE_REG='$truck_allocation'";
	$result5=ExecuteNonQuery ($sql5);
	
	$sql6="update trailer set STATUS='out',REFERENCE='$orderNumber' where trailer.VEHICLE_REG='$trailer_allocation'";
	$result6=ExecuteNonQuery ($sql6);
	
	$sql7="update trailer_2 set STATUS='out',REFERENCE='$orderNumber' where trailer_2.VEHICLE_REG='$trailer_allocation2'";
	$result7=ExecuteNonQuery ($sql7);
	
	$sql8="update tanker set STATUS='out',REFERENCE='$orderNumber' where tanker.VEHICLE_REG='$tanker_allocation'";
	$result8=ExecuteNonQuery ($sql8);
	
	$sql9="update tanker_2 set STATUS='out',REFERENCE='$orderNumber' where tanker_2.VEHICLE_REG='$tanker_allocation2'";
	$result9=ExecuteNonQuery ($sql9);
	
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','work order created',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	header("location: con_work-order-client.php?act=valid");
}
else
{
	header("location: con_work-order-client.php?act=invalid");
}






?>