<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$vehicle_reg1 = strtoupper(strip_tags(stripslashes($_POST['vehicle_reg'])));
$vehicle_fleet_no1 = strtoupper(strip_tags(stripslashes($_POST['vehicle_fleet_no'])));
$vehicle_make1 = ucwords(strip_tags(stripslashes($_POST['vehicle_make'])));
$vin_no1 = strtoupper(strip_tags(stripslashes($_POST['vin_no'])));
$expiry_date = $_POST['expiry_date'];
$model_year1 = (strip_tags(stripslashes($_POST['model_year'])));


$vehicle_reg = filter_var($vehicle_reg1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$vehicle_fleet_no = filter_var($vehicle_fleet_no1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$vehicle_make = filter_var($vehicle_make1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$vin_no = filter_var($vin_no1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$model_year = filter_var($model_year1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql3="select * from truck where VEHICLE_REG='$vehicle_reg'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	header("location: con_truck.php?act=duplicate");
}
else
{
	$sql2=" INSERT INTO truck (VEHICLE_REG,VEHICLE_FLEET_NO,VEHICLE_MAKE,VIN_NO,EXPIRY_DATE,MODEL_YEAR,CREATED_AT,UPDATED_AT) values ('$vehicle_reg','$vehicle_fleet_no','$vehicle_make','$vin_no','$expiry_date','$model_year',now(),now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		
		header("location: con_truck.php?act=valid");
	}
	else
	{
		header("location: con_truck.php?act=invalid");
	}
}

?>

