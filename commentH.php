<?php  
ob_start();
session_start();
require_once("utility.php");
 ?>

<?php 

$id = $_GET['id'];

$comment_title1 = ucfirst(strip_tags(stripslashes($_POST['comment_title'])));
$comment_description1 = ucfirst(strip_tags(stripslashes($_POST['comment_description'])));


$comment_title = filter_var($comment_title1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$comment_description = filter_var($comment_description1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

// $comment_file = $_FILES['comment_file']['name'];
// $temp = $_FILES['comment_file']['tmp_name'];
// move_uploaded_file($temp,"comment/".$comment_file);

$time = date("d-m-Y")."-".time();
$comment_file = $_FILES['comment_file']['name'];
$picture = $time.$comment_file;
$temp = $_FILES['comment_file']['tmp_name'];
move_uploaded_file($temp,"comment/".$picture);

$url = "comment/$picture";

$user = $_SESSION["name"];

$sql1="select * from work_order where work_order.ID=$id";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];

$sql2=" INSERT INTO comment (WORK_ORDER_NUMBER,TITLE,FILE,DESCRIPTION,ATTACHED_BY,CREATED_AT) values ('$orderNumber','$comment_title','$url','$comment_description','$user',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','comment posted',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	header("location: work-order-details.php?id=$id&act=commentvalid");
}
else
{
	header("location: work-order-details.php?id=$id&act=commentinvalid");
}


?>

