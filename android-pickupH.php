<?php  
ob_start();
session_start();
require_once("utility.php");
 ?>

<?php 
$result="";
$mail = $_GET['mail'];
$id = $_GET['id'];

$product1 = (strip_tags(stripslashes($_POST['product'])));
$quantity1 = (strip_tags(stripslashes($_POST['quantity'])));
$tonnage1 = (strip_tags(stripslashes($_POST['tonnage'])));

$pickup_time = $_POST['pickup_time'];

$product = filter_var($product1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity = filter_var($quantity1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$tonnage = filter_var($tonnage1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql4="select * from controller_user where EMAIL='$mail'"	;
$result4 = ExecuteQuery($sql4);
if (mysqli_num_rows($result4)==1)
{
  $row4 = mysqli_fetch_array($result4);
  $username = $row4["FIRST_NAME"];
}

$user = $username;

$sql1="select * from pickup where WORK_ORDER_NUMBER='$id'";
$result1 = ExecuteQuery($sql1);

if (mysqli_num_rows($result1)==1)
{
	$result="duplicate";
}
else
{
	$sql2=" INSERT INTO pickup (WORK_ORDER_NUMBER,PRODUCT,QUANTITY,DESCRIPTION,TONNAGE,TIME,PICKED_UP_BY,CREATED_AT) values ('$id','$product','$quantity','Original','$tonnage','$pickup_time','$user',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$id','pickup confirmation','$pickup_time',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		$sql5="update work_order set STATUS='pickedup' where work_order.WORK_ORDER_NUMBER='$id'";
		$result5=ExecuteNonQuery ($sql5);
		
		$result="true";
	}
	else
	{
		$result="false";
	}
}

// send result back to android
echo "$result";


?>

