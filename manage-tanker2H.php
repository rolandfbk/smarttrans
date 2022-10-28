<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$vehicle_reg1 = strtoupper(strip_tags(stripslashes($_POST['vehicle_reg'])));
$vehicle_make1 = ucwords(strip_tags(stripslashes($_POST['vehicle_make'])));
$vin_no1 = strtoupper(strip_tags(stripslashes($_POST['vin_no'])));
$expiry_date = $_POST['expiry_date'];


$vehicle_reg = filter_var($vehicle_reg1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$vehicle_make = filter_var($vehicle_make1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$vin_no = filter_var($vin_no1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql3="select * from tanker_2 where VEHICLE_REG='$vehicle_reg'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	header("location: tanker2.php?act=duplicate");
}
else
{
	$sql2=" INSERT INTO tanker_2 (VEHICLE_REG,VEHICLE_MAKE,VIN_NO,EXPIRY_DATE,CREATED_AT,UPDATED_AT) values ('$vehicle_reg','$vehicle_make','$vin_no','$expiry_date',now(),now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		
		header("location: tanker2.php?act=trailer2valid");
	}
	else
	{
		header("location: tanker2.php?act=trailer2invalid");
	}
}

?>

