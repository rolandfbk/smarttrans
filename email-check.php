<?php  
ob_start();
require_once("utility.php"); ?>

<?php

$email = (strip_tags(stripslashes($_POST['email'])));

$sql3="select * from client where EMAIL='$email'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	header("location: send-work-order.php?act=valid");
}
else
{
	header("location: send-work-order.php?act=invalid");
}

?>