<?php  
ob_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];

$offload_point1 = ucfirst(strip_tags(stripslashes($_POST['offload_point'])));
$postal_code1 = strip_tags(stripslashes($_POST['postal_code']));
$customer_name1 = ucfirst(strip_tags(stripslashes($_POST['customer_name'])));
$contact_person1 = ucfirst(strip_tags(stripslashes($_POST['contact_person'])));
$phone1 = strip_tags(stripslashes($_POST['phone']));
$email1 = strip_tags(stripslashes($_POST['email']));


$offload_point = filter_var($offload_point1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$postal_code = filter_var($postal_code1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$customer_name = filter_var($customer_name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$contact_person = filter_var($contact_person1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$sql3="select * from pickup_point where ID='$id'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	
	$sql="update pickup_point set OFFLOAD_POINT='$offload_point',POSTAL_CODE='$postal_code',CUSTOMER_NAME='$customer_name',CONTACT_PERSON='$contact_person',PHONE='$phone',EMAIL='$email',UPDATED_AT=now() where pickup_point.ID=$id";

	$result=ExecuteNonQuery ($sql);

	header("location: con_pickup-point-details.php?id=$id&act=valid");
	

}
else
{
	header("location: con_pickup-point-details.php?id=$id&act=invalid");
}
	





?>