<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from trailer where trailer.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: trailer.php?act=delete");
}
else
{
	header("location: trailer.php?act=deletefail");
}

?>