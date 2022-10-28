<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$mail = $_GET['mail'];
$id = $_GET['id'];

$delivery_date = $_POST['date_date'];
$delivery_time = $_POST['pickup_time'];
$signed_by1 = ucfirst(strip_tags(stripslashes($_POST['receiver'])));
$quantity1 = (strip_tags(stripslashes($_POST['quantity'])));


$signed_by = filter_var($signed_by1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity = filter_var($quantity1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$ImageData = $_POST['ConvertImage'];

$time = date("d-m-Y")."-".time();
$photo = "comment_attachment";
$DefaultId = $photo.$time;

$url = "signature/$DefaultId.png";


$sql12="select * from controller_user where EMAIL='$mail'"	;
$result12 = ExecuteQuery($sql12);
if (mysqli_num_rows($result12)==1)
{
  $row12 = mysqli_fetch_array($result12);
  $username = $row12["FIRST_NAME"];
}

$user = $username;



$sql1="select * from work_order where work_order.WORK_ORDER_NUMBER='$id'";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];
$delivery_2 = $row1['DELIVERY_POINT_2'];



$sql2=" INSERT INTO delivery (WORK_ORDER_NUMBER,DATE,TIME,SIGNED_BY,SIGNATURE,DELIVERED_BY,CREATED_AT) values ('$orderNumber','$delivery_date','$delivery_time','$signed_by','$url','$user',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	if($delivery_2 == '')
	{
		$sql7="update truck set STATUS='' where truck.REFERENCE='$orderNumber'";
		$result7=ExecuteNonQuery ($sql7);
		
		$sql6="update trailer set STATUS='' where trailer.REFERENCE='$orderNumber'";
		$result6=ExecuteNonQuery ($sql6);
		
		$sql8="update trailer_2 set STATUS='' where trailer_2.REFERENCE='$orderNumber'";
		$result8=ExecuteNonQuery ($sql8);
		
		$sql9="update tanker set STATUS='' where tanker.REFERENCE='$orderNumber'";
		$result9=ExecuteNonQuery ($sql9);
		
		$sql10="update tanker_2 set STATUS='' where tanker_2.REFERENCE='$orderNumber'";
		$result10=ExecuteNonQuery ($sql10);
	}
	
	$sql4=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','first delivery confirmation','$delivery_time',now(),'$user',now())";
	$result4=ExecuteNonQuery ($sql4);
	
	$sql5="update work_order set STATUS='delivered',QUANTITY_1=$quantity, DELIVERED_AT=now() where work_order.WORK_ORDER_NUMBER='$orderNumber'";
	$result5=ExecuteNonQuery ($sql5);
	
	file_put_contents($url,base64_decode($ImageData));
	
	
	$result="true";
}
else
{
	$result="false";
}

// send result back to android
echo "$result";


?>

