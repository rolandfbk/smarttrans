<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$mail = $_GET['mail'];
$id = $_GET['id'];

$ImageData = $_POST['image_path'];
 
$ImageName = ucfirst(strip_tags(stripslashes($_POST['image_name'])));

$comment_title = filter_var($ImageName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$time = date("d-m-Y")."-".time();
$photo = "comment_attachment";
$DefaultId = $photo.$time;

$url = "comment/$DefaultId.png";

$sql4="select * from controller_user where EMAIL='$mail'"	;
$result4 = ExecuteQuery($sql4);
if (mysqli_num_rows($result4)==1)
{
  $row4 = mysqli_fetch_array($result4);
  $username = $row4["FIRST_NAME"];
}

$user = $username;

// $sql1="select * from work_order where work_order.ID=$id";
// $result1 = ExecuteQuery($sql1);
// $row1 = mysqli_fetch_array($result1);
// $orderNumber = $row1['WORK_ORDER_NUMBER'];

$sql2=" INSERT INTO comment (WORK_ORDER_NUMBER,TITLE,FILE,ATTACHED_BY,CREATED_AT) values ('$id','$comment_title','$url','$user',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$id','comment posted',now(),'$user',now())";
	$result3=ExecuteNonQuery ($sql3);
	
	file_put_contents($url,base64_decode($ImageData));

	echo "Attachment Posted.";
}
else
{
	echo "Fail To Post Attachment";
}


?>

