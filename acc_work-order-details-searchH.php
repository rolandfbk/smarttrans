<?php  
ob_start();
session_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];

$sql="update work_order set STATUS='account',UPDATED_AT=now() where work_order.ID=$id";
$result=ExecuteNonQuery ($sql);

$user = $_SESSION["name"];

$sql1="select * from work_order where work_order.ID=$id";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];

if($result)
{
	$sql4=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','Work Order returned to Account',now(),now(),'$user',now())";
	$result4=ExecuteNonQuery ($sql4);
	
	header("location: con_search.php?id=$id&act=returnvalid");
}
else
{
	header("location: con_search.php?id=$id&act=returninvalid");
}

?>