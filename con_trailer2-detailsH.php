<?php  
ob_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];

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


$sql3="select * from trailer_2 where VEHICLE_REG='$vehicle_reg'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	$sql="update trailer_2 set VEHICLE_MAKE='$vehicle_make',VIN_NO='$vin_no',EXPIRY_DATE='$expiry_date',UPDATED_AT=now() where trailer_2.ID=$id";

	$result=ExecuteNonQuery ($sql);

	if($result)
	{
		header("location: con_trailer2-details.php?id=$id&act=valid");
	}
	else
	{
		header("location: con_trailer2-details.php?id=$id&act=invalid");
	}
	
	
}
else
{
	$sql="update trailer_2 set VEHICLE_REG='$vehicle_reg',VEHICLE_MAKE='$vehicle_make',VIN_NO='$vin_no',EXPIRY_DATE='$expiry_date',UPDATED_AT=now() where trailer_2.ID=$id";

	$result=ExecuteNonQuery ($sql);

	if($result)
	{
		header("location: con_trailer2-details.php?id=$id&act=valid");
	}
	else
	{
		header("location: con_trailer2-details.php?id=$id&act=invalid");
	}

}




?>