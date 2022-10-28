<?php  
ob_start();
require_once("utility.php");
 ?>

<?php 

$product_name1 = (strip_tags(stripslashes($_POST['product_name'])));


$product_name = filter_var($product_name1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql3="select * from product_type where PRODUCT_NAME='$product_name'";
$result3 = ExecuteQuery($sql3);

if(mysqli_num_rows($result3)==1)
{
	header("location: manage-product.php?act=duplicate");
}
else
{
	$sql2=" INSERT INTO product_type (PRODUCT_NAME,CREATED_AT) values ('$product_name',now())";

	$result2=ExecuteNonQuery ($sql2);

	if($result2)
	{
		
		header("location: manage-product.php?act=valid");
	}
	else
	{
		header("location: manage-product.php?act=invalid");
	}
}

?>

