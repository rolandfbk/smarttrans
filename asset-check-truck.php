<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql7="update truck set STATUS='' where truck.ID=$id";
$result7=ExecuteNonQuery ($sql7);

if($result7)
{
	header("location: asset-check.php?act=truckvalid&tab=1");
}
else
{
	header("location: asset-check.php?act=truckinvalid&tab=1");
}

?>