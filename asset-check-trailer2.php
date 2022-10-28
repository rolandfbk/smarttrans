<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql6="update trailer_2 set STATUS='' where trailer_2.ID='$id'";
$result6=ExecuteNonQuery ($sql6);

if($result6)
{
	header("location: asset-check.php?act=trailer2valid&tab=1");
}
else
{
	header("location: asset-check.php?act=trailer2invalid&tab=1");
}

?>