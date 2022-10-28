<?php  
ob_start();
require("utility.php");

 ?>


<?php

$rowCount = count($_POST["users"]);

for($i=0;$i<$rowCount;$i++)
{
	$sql6="update tanker set STATUS='' where tanker.VEHICLE_REG='" . $_POST["users"][$i] . "'";
	$result6=ExecuteNonQuery ($sql6);
	
	$sql6="update tanker_2 set STATUS='' where tanker_2.VEHICLE_REG='" . $_POST["users"][$i] . "'";
	$result6=ExecuteNonQuery ($sql6);
	
	$sql6="update trailer set STATUS='' where trailer.VEHICLE_REG='" . $_POST["users"][$i] . "'";
	$result6=ExecuteNonQuery ($sql6);
	
	$sql6="update trailer_2 set STATUS='' where trailer_2.VEHICLE_REG='" . $_POST["users"][$i] . "'";
	$result6=ExecuteNonQuery ($sql6);
	
	$sql7="update truck set STATUS='' where truck.VEHICLE_REG='" . $_POST["users"][$i] . "'";
	$result7=ExecuteNonQuery ($sql7);
}


header("location: asset-check.php?act=multiplevalid&tab=1");

?>