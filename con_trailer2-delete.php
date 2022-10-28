<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from trailer_2 where trailer_2.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: con_manage-vehicle.php?act=delete2");
}
else
{
	header("location: con_manage-vehicle.php?act=delete2fail");
}

?>