<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from delivery_one where delivery_one.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: delivery-point1.php?act=delivery1delete");
}
else
{
	header("location: delivery-point1.php?act=delivery1deletefail");
}

?>