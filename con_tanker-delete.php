<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from tanker where tanker.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: con_tanker.php?act=delete");
}
else
{
	header("location: con_tanker.php?act=deletefail");
}

?>