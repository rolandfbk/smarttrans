<?php  
ob_start();
require("utility.php");
 ?>


<?php

$exception1 = ucfirst(strip_tags(stripslashes($_POST['exception'])));
$bol_bkg1 = ucfirst(strip_tags(stripslashes($_POST['bol_bkg'])));
$shipment_ref_num1 = ucfirst(strip_tags(stripslashes($_POST['shipment_ref_num'])));
$unit_identifier1 = ucfirst(strip_tags(stripslashes($_POST['unit_identifier'])));
$originator1 = ucfirst(strip_tags(stripslashes($_POST['originator'])));
$category1 = ucfirst(strip_tags(stripslashes($_POST['category'])));
$offer_pending1 = ucfirst(strip_tags(stripslashes($_POST['offer_pending'])));
$eta1 = ucfirst(strip_tags(stripslashes($_POST['eta'])));
$carrier_code1 = ucfirst(strip_tags(stripslashes($_POST['carrier_code'])));
$vessel1 = ucfirst(strip_tags(stripslashes($_POST['vessel'])));
$voyage1 = ucfirst(strip_tags(stripslashes($_POST['voyage'])));
$cutoff_date = $_POST['cutoff_date'];
$last_free_day = $_POST['last_free_day'];
$respond_by_date = $_POST['respond_by_date'];
$pickup_name1 = ucfirst(strip_tags(stripslashes($_POST['pickup_name'])));
$pickup_city1 = ucfirst(strip_tags(stripslashes($_POST['pickup_city'])));
$delivery_name1 = ucfirst(strip_tags(stripslashes($_POST['delivery_name'])));
$delivery_city1 = ucfirst(strip_tags(stripslashes($_POST['delivery_city'])));
$port_of_loading1 = ucfirst(strip_tags(stripslashes($_POST['port_of_loading'])));
$port_of_discharge1 = ucfirst(strip_tags(stripslashes($_POST['port_of_discharge'])));
$unit_type_size1 = ucfirst(strip_tags(stripslashes($_POST['unit_type_size'])));



$exception = filter_var($exception1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$bol_bkg = filter_var($bol_bkg1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$shipment_ref_num = filter_var($shipment_ref_num1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$unit_identifier = filter_var($unit_identifier1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$originator = filter_var($originator1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$category = filter_var($category1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$offer_pending = filter_var($offer_pending1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$eta = filter_var($eta1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$carrier_code = filter_var($carrier_code1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$vessel = filter_var($vessel1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$voyage = filter_var($voyage1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pickup_name = filter_var($pickup_name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pickup_city= filter_var($pickup_city1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$delivery_name = filter_var($delivery_name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$delivery_city = filter_var($delivery_city1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$port_of_loading = filter_var($port_of_loading1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$port_of_discharge = filter_var($port_of_discharge1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$unit_type_size = filter_var($unit_type_size1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);



$attachment = $_FILES['attachment']['name'];
$temp = $_FILES['attachment']['tmp_name'];
move_uploaded_file($temp,"attachment/".$attachment);

$url = "attachment/$attachment";

$sql=" INSERT INTO table1 (PREFIX) values ('GTW')";
$result=ExecuteNonQuery ($sql);


$sql1="select * from table1 order by ID desc limit 1";
$result1 = ExecuteQuery($sql1);
if (mysqli_num_rows($result1)==1)
{
	$row = mysqli_fetch_array($result1);
	$id = $row['ID'];
	$prefix = $row['PREFIX'];

}

$orderNumber = $prefix . $id;

$user = $_SESSION["name"];


$sql2=" INSERT INTO work_order (ATTACHMENT,EXCEPTION,WORK_ORDER_NUMBER,BOL_BKG,SHIPMENT_REF_NUM,UNIT_IDENTIFIER,ORIGINATOR,CATEGORY,STATUS,OFFER_PENDING,WORK_ORDER_DATE_TIME,ETA,CARRIER_CODE,VESSEL,VOYAGE,CUTOFF_DATE,LAST_FREE_DAY,RESPOND_BY_DATE,PICKUP_NAME,PICKUP_CITY,DELIVERY_NAME,DELIVERY_CITY,PORT_OF_LOADING,PORT_OF_DISCHARGE,CREATED_BY,ASSIGNED_BY,UNIT_SIZE_TYPE,CREATED_AT,UPDATED_AT,ASSIGNED_AT,ACCEPTED_AT,REJECTED_AT) values ('$url','$exception','$orderNumber','$bol_bkg','$shipment_ref_num','$unit_identifier','$originator','$category','Created','$offer_pending',now(),'$eta','$carrier_code','$vessel','$voyage','$cutoff_date','$last_free_day','$respond_by_date','$pickup_name','$pickup_city','$delivery_name','$delivery_city','$port_of_loading','$port_of_discharge','$user','$user','$unit_type_size',now(),now(),now(),now(),now())";

$result2=ExecuteNonQuery ($sql2);

if($result2)
{
	header("location: work-orders.php?act=valid");
}
else
{
	header("location: work-orders.php?act=invalid");
}






?>