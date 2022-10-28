<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$mail = $_POST['email'];
$ref_num = $_POST['ref_num'];

$sql6="select * from work_order where work_order.WORK_ORDER_NUMBER='$ref_num'";
$result6 = ExecuteQuery($sql6);
$row6 = mysqli_fetch_array($result6);
$orderNumber6 = $row6['WORK_ORDER_NUMBER'];
$id = $row6['ID'];


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


$selected = $_POST['selected'];

if($selected == 'Diesel stop')
{
	$sql5="select * from user where DRIVER='$usr'";
	$result5 = ExecuteQuery($sql5);
	if(mysqli_num_rows($result5)==1)
	{
		$sql4="update user set STOPS='$selected',WORK_ORDER_NUMBER='$orderNumber6',WO_ID='$id' where DRIVER='$usr'";
		$result4=ExecuteNonQuery ($sql4);
	}
	else{
		$sql4="insert into user (DRIVER,WORK_ORDER_NUMBER,STOPS,WO_ID) values ('$usr','$orderNumber6','$selected','$id')";
		$result4=ExecuteNonQuery ($sql4);
	}
	
	

	$sql1="select * from work_order where work_order.ID=$id";
	$result1 = ExecuteQuery($sql1);
	$row1 = mysqli_fetch_array($result1);
	$orderNumber = $row1['WORK_ORDER_NUMBER'];

	$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,POSTED_BY,CREATED_AT) values ('$orderNumber','$selected','$user',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','$selected',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		
		$result="true";
	}
	else
	{
		$result="false";
	}
}
else if($selected == 'Vehicle check')
{
	$sql5="select * from user where DRIVER='$usr'";
	$result5 = ExecuteQuery($sql5);
	if(mysqli_num_rows($result5)==1)
	{
		$sql4="update user set STOPS='$selected',WORK_ORDER_NUMBER='$orderNumber6',WO_ID='$id' where DRIVER='$usr'";
		$result4=ExecuteNonQuery ($sql4);
	}
	else{
		$sql4="insert into user (DRIVER,WORK_ORDER_NUMBER,STOPS,WO_ID) values ('$usr','$orderNumber6','$selected','$id')";
		$result4=ExecuteNonQuery ($sql4);
	}
	
	

	$sql1="select * from work_order where work_order.ID=$id";
	$result1 = ExecuteQuery($sql1);
	$row1 = mysqli_fetch_array($result1);
	$orderNumber = $row1['WORK_ORDER_NUMBER'];

	$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,POSTED_BY,CREATED_AT) values ('$orderNumber','$selected','$user',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','$selected',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		
		$result="true";
	}
	else
	{
		$result="false";
	}
}
else if($selected == 'Vehicle breakdown')
{
	$sql5="select * from user where DRIVER='$usr'";
	$result5 = ExecuteQuery($sql5);
	if(mysqli_num_rows($result5)==1)
	{
		$sql4="update user set STOPS='$selected',WORK_ORDER_NUMBER='$orderNumber6',WO_ID='$id' where DRIVER='$usr'";
		$result4=ExecuteNonQuery ($sql4);
	}
	else{
		$sql4="insert into user (DRIVER,WORK_ORDER_NUMBER,STOPS,WO_ID) values ('$usr','$orderNumber6','$selected','$id')";
		$result4=ExecuteNonQuery ($sql4);
	}
	
	

	$sql1="select * from work_order where work_order.ID=$id";
	$result1 = ExecuteQuery($sql1);
	$row1 = mysqli_fetch_array($result1);
	$orderNumber = $row1['WORK_ORDER_NUMBER'];

	$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,POSTED_BY,CREATED_AT) values ('$orderNumber','$selected','$user',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','$selected',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		
		$result="true";
	}
	else
	{
		$result="false";
	}
}
else if($selected == 'Rest')
{
	$sql5="select * from user where DRIVER='$usr'";
	$result5 = ExecuteQuery($sql5);
	if(mysqli_num_rows($result5)==1)
	{
		$sql4="update user set STOPS='$selected',WORK_ORDER_NUMBER='$orderNumber6',WO_ID='$id' where DRIVER='$usr'";
		$result4=ExecuteNonQuery ($sql4);
	}
	else{
		$sql4="insert into user (DRIVER,WORK_ORDER_NUMBER,STOPS,WO_ID) values ('$usr','$orderNumber6','$selected','$id')";
		$result4=ExecuteNonQuery ($sql4);
	}
	
	

	$sql1="select * from work_order where work_order.ID=$id";
	$result1 = ExecuteQuery($sql1);
	$row1 = mysqli_fetch_array($result1);
	$orderNumber = $row1['WORK_ORDER_NUMBER'];

	$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,POSTED_BY,CREATED_AT) values ('$orderNumber','$selected','$user',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','$selected',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		
		$result="true";
	}
	else
	{
		$result="false";
	}
}
else if($selected == 'Puncture')
{
	$sql5="select * from user where DRIVER='$usr'";
	$result5 = ExecuteQuery($sql5);
	if(mysqli_num_rows($result5)==1)
	{
		$sql4="update user set STOPS='$selected',WORK_ORDER_NUMBER='$orderNumber6',WO_ID='$id' where DRIVER='$usr'";
		$result4=ExecuteNonQuery ($sql4);
	}
	else{
		$sql4="insert into user (DRIVER,WORK_ORDER_NUMBER,STOPS,WO_ID) values ('$usr','$orderNumber6','$selected','$id')";
		$result4=ExecuteNonQuery ($sql4);
	}
	
	

	$sql1="select * from work_order where work_order.ID=$id";
	$result1 = ExecuteQuery($sql1);
	$row1 = mysqli_fetch_array($result1);
	$orderNumber = $row1['WORK_ORDER_NUMBER'];

	$sql2=" INSERT INTO stops (WORK_ORDER_NUMBER,TITLE,POSTED_BY,CREATED_AT) values ('$orderNumber','$selected','$user',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','$selected',now(),'$user',now())";
		$result3=ExecuteNonQuery ($sql3);
		
		
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

