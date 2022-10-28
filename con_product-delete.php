<?php  
ob_start();
require("utility.php");

 ?>


<?php

$id = $_GET['id'];



$sql="delete from product_type where product_type.ID=$id";

$result=ExecuteQuery ($sql);

if($result)
{
	header("location: con_manage-product.php?act=productdelete");
}
else
{
	header("location: con_manage-product.php?act=productdeletefail");
}

?>