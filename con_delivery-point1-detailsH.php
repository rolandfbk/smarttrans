<?php  
ob_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];

$company1 = (strip_tags(stripslashes($_POST['company'])));
$offload_point1 = strip_tags(stripslashes($_POST['offload_point']));
$suburb1 = ucfirst(strip_tags(stripslashes($_POST['suburb'])));
$postal_code1 = (strip_tags(stripslashes($_POST['postal_code'])));
$first_name1 = ucfirst(strip_tags(stripslashes($_POST['first_name'])));
$surname1 = ucfirst(strip_tags(stripslashes($_POST['surname'])));
$phone1 = strip_tags(stripslashes($_POST['phone']));
$email1 = strip_tags(stripslashes($_POST['email']));
$cargo_type1 = (strip_tags(stripslashes($_POST['cargo_type'])));


$company = filter_var($company1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$offload_point = filter_var($offload_point1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$suburb = filter_var($suburb1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$postal_code = filter_var($postal_code1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$first_name = filter_var($first_name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$surname = filter_var($surname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$cargo_type = filter_var($cargo_type1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$sql3="select * from delivery_one where ID='$id'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	
	$sql="update delivery_one set COMPANY='$company',OFFLOAD_POINT='$offload_point',SUBURB='$suburb',POSTAL_CODE='$postal_code',FIRST_NAME='$first_name',SURNAME='$surname',PHONE='$phone',EMAIL='$email',CARGO_TYPE='$cargo_type',UPDATED_AT=now() where delivery_one.ID=$id";

	$result=ExecuteNonQuery ($sql);

	header("location: con_delivery-point1-details.php?id=$id&act=valid");
	

}
else
{
	header("location: con_delivery-point1-details.php?id=$id&act=invalid");
}
	





?>