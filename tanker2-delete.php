<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from tanker_2 where tanker_2.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: tanker2.php?act=delete2");
}
else
{
	header("location: tanker2.php?act=delete2fail");
}

?>