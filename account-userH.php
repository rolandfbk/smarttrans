<?php  
ob_start();
require_once("utility.php");
//require_once("class.phpmailer.php");
//require_once("PHPMailer-master/PHPMailerAutoload.php");
 ?>

<?php 

$fn1 = ucfirst(strip_tags(stripslashes($_POST['fn'])));
$surname1 = ucfirst(strip_tags(stripslashes($_POST['surname'])));
$email1 = (strip_tags(stripslashes($_POST['email'])));
$phone1 = (strip_tags(stripslashes($_POST['phone'])));
$password1 = (strip_tags(stripslashes($_POST['password'])));


$fn = filter_var($fn1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$surname = filter_var($surname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$password = filter_var($password1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql3="select * from controller_user where EMAIL='$email'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	header("location: account-user.php?act=duplicate");
}
else
{
	$sql=" INSERT INTO controller_prefix (PREFIX) values ('ACC')";
	$result=ExecuteNonQuery ($sql);


	$sql1="select * from controller_prefix order by ID desc limit 1";
	$result1 = ExecuteQuery($sql1);
	if (mysqli_num_rows($result1)==1)
	{
		$row = mysqli_fetch_array($result1);
		$id = $row['ID'];
		$prefix = $row['PREFIX'];

	}

	$orderNumber = $prefix . $id;


	$sql2=" INSERT INTO controller_user (REFERENCE_NUMBER,FIRST_NAME,SURNAME,EMAIL,PASSWORD,PHONE,USER_TYPE,CREATED_AT,UPDATED_AT,PRINT_FROM) values ('$orderNumber','$fn','$surname','$email','$password','$phone','account',now(),now(),now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		
		header("location: account-user.php?act=valid");
	}
	else
	{
		header("location: account-user.php?act=invalid");
	}
}

?>

