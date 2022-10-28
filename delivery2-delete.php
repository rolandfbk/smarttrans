<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from delivery_two where delivery_two.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: delivery-point2.php?act=delivery2delete");
}
else
{
	header("location: delivery-point2.php?act=delivery2deletefail");
}

?>