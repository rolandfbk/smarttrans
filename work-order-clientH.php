<?php  
ob_start();
session_start();
require("utility.php");
 ?>


<?php

$bill_client1 = (strip_tags(stripslashes($_POST['bill_client'])));
$cargo_type1 = ucfirst(strip_tags(stripslashes($_POST['cargo_type'])));


$cargo_type = filter_var($cargo_type1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$bill_client = filter_var($bill_client1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql1="select * from delivery_one where COMPANY='$bill_client' and (CARGO_TYPE='$cargo_type' OR CARGO_TYPE='Both')";
$result1 = ExecuteQuery($sql1);
if (mysqli_num_rows($result1)>=1)
{
	header("location: work-order-create.php?client=$bill_client&type=$cargo_type");
}
else
{
	header("location: work-order-client.php?act=invalid&type=$cargo_type&client=$bill_client");
}








?>