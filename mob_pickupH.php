<?php  
ob_start();
session_start();
require_once("utility.php");
 ?>

<?php 

$id = $_GET['id'];

$pickup_description1 = ucfirst(strip_tags(stripslashes($_POST['pickup_description'])));
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];


$pickup_description = filter_var($pickup_description1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$user = $_SESSION["name"];

$sql1="select * from work_order where work_order.ID=$id";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];

$sql2=" INSERT INTO pickup (WORK_ORDER_NUMBER,DESCRIPTION,DATE,TIME,PICKED_UP_BY,CREATED_AT) values ('$orderNumber','$pickup_description','$pickup_date','$pickup_time','$user',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	$sql5="update work_order set STATUS='pickedup' where work_order.WORK_ORDER_NUMBER='$orderNumber'";
	$result5=ExecuteNonQuery ($sql5);
	
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','pickup confirmation','$pickup_time',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	header("location: mob_work-order-details.php?id=$id&act=pickupvalid");
}
else
{
	header("location: mob_work-order-details.php?id=$id&act=pickupinvalid");
}


?>

