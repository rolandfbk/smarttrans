<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from controller_user where controller_user.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: account-user.php?act=delete");
}
else
{
	header("location: account-user.php?act=deletefail");
}

?>