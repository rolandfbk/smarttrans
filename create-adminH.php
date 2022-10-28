<?php  
ob_start();
require("utility.php");
 ?>


<?php

$create_admin = $_POST['create_admin'];




$sql3="select * from controller_user where controller_user.EMAIL='$create_admin'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	$sql="update controller_user set REFERENCE_NUMBER='ADMIN',USER_TYPE='admin',UPDATED_AT=now() where controller_user.EMAIL='$create_admin'";

	$result=ExecuteNonQuery ($sql);

	if($result)
	{
		header("location: administrator.php?act=adminvalid");
	}
	else
	{
		header("location: administrator.php?act=admininvalid");
	}

}
else
{
	header("location: administrator.php?act=admininvalid");
}


?>