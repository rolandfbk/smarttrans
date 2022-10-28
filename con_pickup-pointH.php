<?php  
ob_start();
require_once("utility.php");
//require_once("class.phpmailer.php");
//require_once("PHPMailer-master/PHPMailerAutoload.php");
 ?>

<?php 

$company1 = (strip_tags(stripslashes($_POST['company'])));
$offload_point1 = ucfirst(strip_tags(stripslashes($_POST['offload_point'])));
$postal1 = ucfirst(strip_tags(stripslashes($_POST['postal'])));
$name1 = ucfirst(strip_tags(stripslashes($_POST['name'])));
$email1 = (strip_tags(stripslashes($_POST['email'])));
$phone1 = (strip_tags(stripslashes($_POST['phone'])));
$contact1 = ucfirst(strip_tags(stripslashes($_POST['contact'])));
$cargo_type = ucfirst(strip_tags(stripslashes($_POST['cargo_type'])));


$company = filter_var($company1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$offload_point = filter_var($offload_point1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$postal = filter_var($postal1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$name = filter_var($name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$contact = filter_var($contact1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);



$sql2=" INSERT INTO pickup_point (COMPANY,OFFLOAD_POINT,POSTAL_CODE,CUSTOMER_NAME,CONTACT_PERSON,PHONE,EMAIL,CARGO_TYPE,CREATED_AT) values ('$company','$offload_point','$postal','$name','$contact','$phone','$email','$cargo_type',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	
	header("location: con_pickup-point.php?act=valid");
}
else
{
	header("location: con_pickup-point.php?act=invalid");
}


?>

