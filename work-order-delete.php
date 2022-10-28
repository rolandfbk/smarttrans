<?php  
ob_start();
session_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];

$sql6="select * from work_order where work_order.ID=$id";
$result6 = ExecuteQuery($sql6);
$row6 = mysqli_fetch_array($result6);
$on = $row6['WORK_ORDER_NUMBER'];

$user = $_SESSION["name"];

$sql7="update truck set STATUS='' where truck.REFERENCE='$on'";
$result7=ExecuteNonQuery ($sql7);

$sql6="update trailer set STATUS='' where trailer.REFERENCE='$on'";
$result6=ExecuteNonQuery ($sql6);

$sql8="update trailer_2 set STATUS='' where trailer_2.REFERENCE='$on'";
$result8=ExecuteNonQuery ($sql8);

$sql9="update tanker set STATUS='' where tanker.REFERENCE='$on'";
$result9=ExecuteNonQuery ($sql9);

$sql10="update tanker_2 set STATUS='' where tanker_2.REFERENCE='$on'";
$result10=ExecuteNonQuery ($sql10);



$sql="delete from work_order where work_order.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	$sql3=" INSERT INTO deleted (WORK_ORDER_NUMBER,TIME,USER,CREATED_AT) values ('$on',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	header("location: work-order-manage.php?on=$on&act=workorderdelete");
}
else
{
	header("location: work-order-manage.php?on=$on&act=workorderdeletefail");
}

?>