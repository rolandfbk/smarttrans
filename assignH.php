<?php  
ob_start();
session_start();
require("utility.php"); ?>

<?php

$id = $_GET['id'];

$assign1 = ucfirst(strip_tags(stripslashes($_POST['assign'])));

$assign = filter_var($assign1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$user = $_SESSION["name"];

$sql="update work_order set STATUS='Assigned',ASSIGNED_TO='$assign',ASSIGNED_BY='$user',ASSIGNED_AT=now() where work_order.ID=$id";

$result=ExecuteNonQuery ($sql);

if($result)
{
	header("location: work-order-details.php?id=$id&act=valid");
}
else
{
	header("location: work-order-details.php?id=$id&act=valid");
}
?>