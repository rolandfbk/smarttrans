<?php  
ob_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];

$reference_number = $_POST['reference_number'];
$fn1 = ucfirst(strip_tags(stripslashes($_POST['fn'])));
$surname1 = ucfirst(strip_tags(stripslashes($_POST['surname'])));
$email1 = (strip_tags(stripslashes($_POST['email'])));
$phone1 = (strip_tags(stripslashes($_POST['phone'])));
$password1 = ucfirst(strip_tags(stripslashes($_POST['password'])));


$fn = filter_var($fn1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$surname = filter_var($surname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$password = filter_var($password1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$sql3="select * from controller_user where EMAIL='$email'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	if($password =="")
	{
		$sql="update controller_user set FIRST_NAME='$fn',SURNAME='$surname',PHONE='$phone',UPDATED_AT=now() where controller_user.ID=$id";

		$result=ExecuteNonQuery ($sql);

		if($result)
		{
			header("location: con_mobile-details.php?id=$id&act=valid");
		}
		else
		{
			header("location: con_mobile-details.php?id=$id&act=invalid");
		}

	}
	else
	{
		$sql="update controller_user set FIRST_NAME='$fn',SURNAME='$surname',PHONE='$phone',PASSWORD='$password',UPDATED_AT=now() where controller_user.ID=$id";

		$result=ExecuteNonQuery ($sql);

		if($result)
		{
			header("location: con_mobile-details.php?id=$id&act=valid");
		}
		else
		{
			header("location: con_mobile-details.php?id=$id&act=invalid");
		}

	}
}
else
{
	if($password =="")
	{
		$sql="update controller_user set FIRST_NAME='$fn',SURNAME='$surname',EMAIL='$email',PHONE='$phone',UPDATED_AT=now() where controller_user.ID=$id";

		$result=ExecuteNonQuery ($sql);

		if($result)
		{
			header("location: con_mobile-details.php?id=$id&act=valid");
		}
		else
		{
			header("location: con_mobile-details.php?id=$id&act=invalid");
		}

	}
	else
	{
		$sql="update controller_user set FIRST_NAME='$fn',SURNAME='$surname',EMAIL='$email',PHONE='$phone',PASSWORD='$password',UPDATED_AT=now() where controller_user.ID=$id";

		$result=ExecuteNonQuery ($sql);

		if($result)
		{
			header("location: con_mobile-details.php?id=$id&act=valid");
		}
		else
		{
			header("location: con_mobile-details.php?id=$id&act=invalid");
		}

	}
}
	





?>