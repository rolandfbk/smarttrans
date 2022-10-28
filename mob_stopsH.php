<?php  
ob_start();
session_start();
require_once("utility.php");
 ?>

<?php 

$id = $_GET['id'];

$stop_title1 = ucfirst(strip_tags(stripslashes($_POST['stop_title'])));
$stop_description1 = ucfirst(strip_tags(stripslashes($_POST['stop_description'])));
$stop_date = $_POST['stop_date'];
$stop_time = $_POST['stop_time'];


$stop_title = filter_var($stop_title1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$stop_description = filter_var($stop_description1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$user = $_SESSION["name"];

$sql1="select * from work_order where work_order.ID=$id";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];

$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,DESCRIPTION,DATE,TIME,POSTED_BY,CREATED_AT) values ('$orderNumber','$stop_title','$stop_description','$stop_date','$stop_time','$user',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','stop posted','$stop_time',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	header("location: mob_work-order-details.php?id=$id&act=stopsvalid");
}
else
{
	header("location: mob_work-order-details.php?id=$id&act=stopsinvalid");
}


?>

