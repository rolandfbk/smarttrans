<?php  
ob_start();
session_start();
require_once("utility.php");
 ?>

<?php 

$id = $_GET['id'];

$delivery_description1 = ucfirst(strip_tags(stripslashes($_POST['delivery_description'])));
$delivery_date = $_POST['delivery_date'];
$delivery_time = $_POST['delivery_time'];


$delivery_description = filter_var($delivery_description1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$user = $_SESSION["name"];

$sql1="select * from work_order where work_order.ID=$id";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];

$sql2=" INSERT INTO delivery (WORK_ORDER_NUMBER,DESCRIPTION,DATE,TIME,DELIVERED_BY,CREATED_AT) values ('$orderNumber','$delivery_description','$delivery_date','$delivery_time','$user',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	$sql7="update truck set STATUS='' where truck.REFERENCE='$orderNumber'";
	$result7=ExecuteNonQuery ($sql7);
	
	$sql6="update trailer set STATUS='' where trailer.REFERENCE='$orderNumber'";
	$result6=ExecuteNonQuery ($sql6);
	
	$sql5="update work_order set STATUS='delivered' where work_order.WORK_ORDER_NUMBER='$orderNumber'";
	$result5=ExecuteNonQuery ($sql5);
	
	$sql4=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','delivery confirmation','$delivery_time',now(),'$user',now())";
	$result4=ExecuteNonQuery ($sql4);
	
	$sql3="update work_order set STATUS='delivered' where work_order.ID=$id";
	$result3=ExecuteNonQuery ($sql3);
	header("location: work-order-details.php?id=$id&act=deliveryvalid");
}
else
{
	header("location: work-order-details.php?id=$id&act=deliveryinvalid");
}


?>

