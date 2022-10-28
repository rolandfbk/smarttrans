<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from customer_list where customer_list.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: client.php?act=clientdelete");
}
else
{
	header("location: client.php?act=clientdeletefail");
}

?>