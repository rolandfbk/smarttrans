<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql6="update tanker set STATUS='' where tanker.ID='$id'";
$result6=ExecuteNonQuery ($sql6);

if($result6)
{
	header("location: asset-check.php?act=tankervalid&tab=1");
}
else
{
	header("location: asset-check.php?act=tankerinvalid&tab=1");
}

?>