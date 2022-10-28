<?php  
ob_start();
require_once("utility.php"); ?>
<?php 

$email1 = (strip_tags(stripslashes($_POST['email'])));
$password1 = ucfirst(strip_tags(stripslashes($_POST['password'])));


$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$password = filter_var($password1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


if ( isset($email) && isset($password))
{
	$sql="select * from controller_user where EMAIL='$email' and PASSWORD='$password'"	;
	$result = ExecuteQuery($sql);
	
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		
		session_start();
		$_SESSION["email"]= $row["EMAIL"];
		$_SESSION["name"] = $row["FIRST_NAME"];
		$_SESSION["ref_no"] = $row["REFERENCE_NUMBER"];
		$_SESSION["user"] = $row["USER_TYPE"];
		$_SESSION["logged_in"]= true;
		
		if($row["USER_TYPE"]=="admin")
		{
			header("location: work-order-manage.php");
		}
		else if($row["USER_TYPE"]=="controller")
		{
			header("location: con_work-order-manage.php");
		}
		else if($row["USER_TYPE"]=="account")
		{
			header("location: acc_work-order-manage.php");
		}
		else
		{
			header("location: index.php?act=invalid");
		}
	}
	else
	{
		header("location: index.php?act=invalid");
	}
}
?>