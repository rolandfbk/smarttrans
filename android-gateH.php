<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$mail = $_POST['email'];
$id = $_POST['ref_num'];

$security_name1 = ucfirst(strip_tags(stripslashes($_POST['date_date'])));

$security_name = filter_var($security_name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql1="select * from work_order where work_order.WORK_ORDER_NUMBER='$id'";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];



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



$sql5="insert into security (DRIVER,WORK_ORDER_NUMBER,SECURITY_NAME,GATE_SIGNATURE,GATE_TIME) values ('$user','$orderNumber','$security_name','$url',now())";
$result5=ExecuteNonQuery ($sql5);

if($result5)
{
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','security gate signed by $security_name',now(),now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
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

