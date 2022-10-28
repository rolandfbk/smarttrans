<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$mail = $_POST['email'];

$id = $_POST['ref_num'];

$sql6="select * from work_order where WORK_ORDER_NUMBER='$id'";
$result6 = ExecuteQuery($sql6);
$row6 = mysqli_fetch_array($result6);
$wo_id = $row6['ID'];


$sql12="select * from controller_user where EMAIL='$mail'"	;
$result12 = ExecuteQuery($sql12);
if (mysqli_num_rows($result12)==1)
{
  $row12 = mysqli_fetch_array($result12);
  $username = $row12["FIRST_NAME"];
  $number = $row12["REFERENCE_NUMBER"];
}

$user = $username;
$usr = $number;


$sql4="update user set STOPS='Resume delivery',WORK_ORDER_NUMBER='$id' where DRIVER='$usr'";
$result4=ExecuteNonQuery ($sql4);



$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,POSTED_BY,CREATED_AT) values ('$id','Resume delivery','$user',now())";
$result2=ExecuteNonQuery ($sql2);


if($result4)
{
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$id','Resume delivery',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	$result="true";
}
else
{
	$result="false";
}

// send result back to android
echo "$result";







?>
