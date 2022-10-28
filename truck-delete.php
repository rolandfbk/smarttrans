<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from truck where truck.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: truck.php?act=truckdelete");
}
else
{
	header("location: truck.php?act=truckdeletefail");
}

?>