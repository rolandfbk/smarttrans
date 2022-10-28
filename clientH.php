<?php  
ob_start();
require_once("utility.php");
//require_once("class.phpmailer.php");
//require_once("PHPMailer-master/PHPMailerAutoload.php");
 ?>

<?php 

$accno1 = strtoupper(strip_tags(stripslashes($_POST['accno'])));
$company1 = strtoupper(strip_tags(stripslashes($_POST['company'])));
$fn1 = ucfirst(strip_tags(stripslashes($_POST['fn'])));
$surname1 = ucfirst(strip_tags(stripslashes($_POST['surname'])));
$email1 = (strip_tags(stripslashes($_POST['email'])));
$phone1 = (strip_tags(stripslashes($_POST['phone'])));
$address1 = ucfirst(strip_tags(stripslashes($_POST['address'])));
$suburb1 = ucfirst(strip_tags(stripslashes($_POST['suburb'])));
$city1 = ucfirst(strip_tags(stripslashes($_POST['city'])));
$province1 = ucfirst(strip_tags(stripslashes($_POST['province'])));
$country1 = ucfirst(strip_tags(stripslashes($_POST['country'])));
$postal1 = ucfirst(strip_tags(stripslashes($_POST['postal'])));


$accno = filter_var($accno1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$company = filter_var($company1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$fn = filter_var($fn1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$surname = filter_var($surname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$phone = filter_var($phone1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($email1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$address = filter_var($address1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$suburb = filter_var($suburb1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$city = filter_var($city1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$province = filter_var($province1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$country = filter_var($country1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$postal = filter_var($postal1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql="select COMPANY from customer_list";
$result = ExecuteQuery($sql);

while($row = mysqli_fetch_array($result))
{
	$check = strtoupper($row['COMPANY']);
	
	if ($check == $company)
	{
		$check2 = $check;;
	}
	
}

if($check2 == $company)
{
	header("location: client.php?act=duplicate");
}
else{
	
	$sql2=" INSERT INTO customer_list (ACC_NO,COMPANY,FIRST_NAME,SURNAME,PHONE,EMAIL,ADDRESS,SUBURB,CITY,PROVINCE,COUNTRY,POSTAL_CODE,CREATED_AT) values ('$accno','$company','$fn','$surname','$phone','$email','$address','$suburb','$city','$province','$country','$postal',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		
		header("location: client.php?act=valid");
	}
	else
	{
		header("location: client.php?act=invalid");
	}
}

?>

