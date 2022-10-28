<?php
    
ob_start();
require_once("utility.php");
	
	
		  
$sql2="select * from product_type";
$result2 = ExecuteQuery($sql2);

while($row2 = mysqli_fetch_array($result2))
{
	$order[] = array('id'  => $row2['PRODUCT_NAME']);
}

$json = json_encode($order);	


// send result back to android
echo $json;
  	
	
?>