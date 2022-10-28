<?php  
ob_start();
require("utility.php");
 ?>


<?php


$work_order1 = (strip_tags(stripslashes($_POST['work_order'])));

$work_order = filter_var($work_order1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql3="select * from work_order where WORK_ORDER_NUMBER='$work_order'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	header("location: search.php?id=$work_order");
}
else
{
	header("location: work-order-search.php?act=invalid");
}




?>