<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql6="update trailer set STATUS='' where trailer.ID='$id'";
$result6=ExecuteNonQuery ($sql6);

if($result6)
{
	header("location: asset-check.php?act=trailervalid&tab=1");
}
else
{
	header("location: asset-check.php?act=trailerinvalid&tab=1");
}

?>