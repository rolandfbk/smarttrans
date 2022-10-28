<?php  
ob_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];
$cstmr= $_GET['cstmr'];

// echo"$cstmr";

// $sql2="select * from delivery_one where COMPANY='$cstmr'";
// $result2=ExecuteQuery($sql2);
// while($row2 = mysqli_fetch_array($result2))
// {
	// $link = $row2['ID'];
	// $sql1="update delivery_one set COMPANY='$company' where delivery_one.ID=$link";
	// $result1=ExecuteNonQuery ($sql1);
	// echo"$link";
// }

$accno1 = strtoupper(strip_tags(stripslashes($_POST['accno'])));
$company1 = (strip_tags(stripslashes($_POST['company'])));
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


$sql="update customer_list set ACC_NO='$accno', COMPANY='$company',FIRST_NAME='$fn',SURNAME='$surname',PHONE='$phone',EMAIL='$email',ADDRESS='$address',SUBURB='$suburb',CITY='$city',PROVINCE='$province',COUNTRY='$country',POSTAL_CODE='$postal',UPDATED_AT=now() where customer_list.ID=$id";

$result=ExecuteNonQuery ($sql);

if($result)
{
	$sql2="select * from delivery_one where COMPANY='$cstmr'";
	$result2=ExecuteQuery($sql2);
	while($row2 = mysqli_fetch_array($result2))
	{
		$link = $row2['ID'];
		$sql1="update delivery_one set COMPANY='$company' where delivery_one.ID=$link";
		$result1=ExecuteNonQuery ($sql1);
	}
	
	
	
	header("location: client-details.php?id=$id&act=valid");
}
else
{
	header("location: client-details.php?id=$id&act=invalid");
}

?>