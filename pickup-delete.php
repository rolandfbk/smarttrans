<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from pickup_point where pickup_point.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: pickup-point.php?act=pickupdelete");
}
else
{
	header("location: pickup-point.php?act=pickupdeletefail");
}

?>