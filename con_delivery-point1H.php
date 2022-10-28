<?php  
ob_start();
require_once("utility.php");
//require_once("class.phpmailer.php");
//require_once("PHPMailer-master/PHPMailerAutoload.php");
 ?>

<?php 

$company1 = (strip_tags(stripslashes($_POST['company'])));
$offload_point1 = ucfirst(strip_tags(stripslashes($_POST['offload_point'])));
$suburb1 = ucfirst(strip_tags(stripslashes($_POST['suburb'])));
$postal1 = ucfirst(strip_tags(stripslashes($_POST['postal'])));
$fn1 = ucfirst(strip_tags(stripslashes($_POST['fn'])));
$email1 = (strip_tags(stripslashes($_POST['email'])));
$phone1 = (strip_tags(stripslashes($_POST['phone'])));
$surname1 = ucfirst(strip_tags(stripslashes($_POST['surname'])));
$cargo_type = ucfirst(strip_tags(stripslashes($_POST['cargo_type'])));


$company = filter_var($company1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$offload_point = filter_var($offload_point1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$suburb = filter_var($suburb1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$postal = filter_var($postal1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$fn = filter_var($fn1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$surname = filter_var($surname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);



$sql2=" INSERT INTO delivery_one (COMPANY,OFFLOAD_POINT,SUBURB,POSTAL_CODE,FIRST_NAME,SURNAME,PHONE,EMAIL,CARGO_TYPE,CREATED_AT) values ('$company','$offload_point','$suburb','$postal','$fn','$surname','$phone','$email','$cargo_type',now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	
	header("location: con_delivery-point1.php?act=delivery1valid");
}
else
{
	header("location: con_delivery-point1.php?act=delivery1invalid");
}


?>

