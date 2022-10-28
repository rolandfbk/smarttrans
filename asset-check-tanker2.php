<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql6="update tanker_2 set STATUS='' where tanker_2.ID='$id'";
$result6=ExecuteNonQuery ($sql6);

if($result6)
{
	header("location: asset-check.php?act=tanker2valid&tab=1");
}
else
{
	header("location: asset-check.php?act=tanker2invalid&tab=1");
}

?>