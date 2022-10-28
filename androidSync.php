<?php  
ob_start();
session_start();
require_once("utility.php");
 ?>

<?php
$mail = $_GET['mail'];


$work_order_number1 = (strip_tags(stripslashes($_POST['work_order_number'])));
$pick_product1 = (strip_tags(stripslashes($_POST['pick_product'])));
$pick_quantity1 = (strip_tags(stripslashes($_POST['pick_quantity'])));
$pick_tonnage1 = (strip_tags(stripslashes($_POST['pick_tonnage'])));
$pick_time1 = (strip_tags(stripslashes($_POST['pick_time'])));
$quantity11 = (strip_tags(stripslashes($_POST['quantity1'])));
$del_date1 = (strip_tags(stripslashes($_POST['del_date'])));
$del_time1 = (strip_tags(stripslashes($_POST['del_time'])));
$del_receiver1 = (strip_tags(stripslashes($_POST['del_receiver'])));
//$del_signature1 = (strip_tags(stripslashes($_POST['del_signature'])));
$quantity21 = (strip_tags(stripslashes($_POST['quantity2'])));
$del_date21 = (strip_tags(stripslashes($_POST['del_date2'])));
$del_time21 = (strip_tags(stripslashes($_POST['del_time2'])));
$del_receiver21 = (strip_tags(stripslashes($_POST['del_receiver2'])));
//$del_signature21 = (strip_tags(stripslashes($_POST['del_signature2'])));
$product1 = (strip_tags(stripslashes($_POST['product'])));
$quantity1 = (strip_tags(stripslashes($_POST['quantity'])));
$tonnage1 = (strip_tags(stripslashes($_POST['tonnage'])));


$work_order_number = filter_var($work_order_number1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pick_product = filter_var($pick_product1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pick_quantity = filter_var($pick_quantity1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pick_tonnage = filter_var($pick_tonnage1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pick_time = filter_var($pick_time1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity1 = filter_var($quantity11, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_date = filter_var($del_date1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_time = filter_var($del_time1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_receiver = filter_var($del_receiver1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_signature = $_POST['del_signature'];
$quantity2 = filter_var($quantity21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_date2 = filter_var($del_date21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_time2 = filter_var($del_time21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_receiver2 = filter_var($del_receiver21, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$del_signature2 = $_POST['del_signature2'];
$product = filter_var($product1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$quantity = filter_var($quantity1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$tonnage = filter_var($tonnage1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


$sql="select DRIVER_RESPONSE from work_order where WORK_ORDER_NUMBER='$work_order_number'";
$result = ExecuteQuery($sql);
$row = mysqli_fetch_array($result);
$driver_response = $row['DRIVER_RESPONSE'];

if($driver_response == "yes")
{

	$sql4="select * from controller_user where EMAIL='$mail'"	;
	$result4 = ExecuteQuery($sql4);
	if (mysqli_num_rows($result4)==1)
	{
	  $row4 = mysqli_fetch_array($result4);
	  $username = $row4["FIRST_NAME"];
	}

	$user = $username;

	//START PICK UP

	//if(($pick_product != "")&&($pick_quantity != "")&&($pick_tonnage != ""))
	if($pick_product != "1")
	{
		$status = "";
		$activity_text = "";
		if(($product == $pick_product)&&($quantity == $pick_quantity)&&($tonnage == $pick_tonnage))
		{
			$status = "Original";
			$activity_text = "pickup confirmation";
		}
		else{
			$status = "Amended";
			$activity_text = "pickup confirmation with amendment";
		}
		
		$sql1="select * from pickup where WORK_ORDER_NUMBER='$work_order_number'";
		$result1 = ExecuteQuery($sql1);

		if (mysqli_num_rows($result1)==0)
		{
			$sql2=" INSERT INTO pickup (WORK_ORDER_NUMBER,PRODUCT,QUANTITY,DESCRIPTION,TONNAGE,TIME,PICKED_UP_BY,CREATED_AT) values ('$work_order_number','$pick_product','$pick_quantity','$status','$pick_tonnage','$pick_time','$user',now())";

			$result2=ExecuteNonQuery ($sql2);
			
			if($result2)
			{
				$sql3=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$work_order_number','$activity_text','$pickup_time',now(),'$user',now())";
				$result3=ExecuteNonQuery ($sql3);
				
				$sql5="update work_order set STATUS='pickedup' where work_order.WORK_ORDER_NUMBER='$work_order_number'";
				$result5=ExecuteNonQuery ($sql5);
				
				$result="true";
			}
		}
	}
	//END PICK UP

	//START DELIVERY 1
	if(($del_date != "1")&&($del_time != "1")&&($del_receiver != "1"))
	{
		$time = date("d-m-Y")."-".time();
		$photo = "comment_del1";
		$DefaultId = $photo.$time;

		$url = "signature/$DefaultId.png";
		
		$sql1="select * from delivery where WORK_ORDER_NUMBER='$work_order_number'";
		$result1 = ExecuteQuery($sql1);

		if (mysqli_num_rows($result1)==0)
		{
		
			$sql2=" INSERT INTO delivery (WORK_ORDER_NUMBER,DATE,TIME,SIGNED_BY,SIGNATURE,DELIVERED_BY,CREATED_AT) values ('$work_order_number','$del_date','$del_time','$del_receiver','$url','$user',now())";

			$result2=ExecuteNonQuery ($sql2);

			if($result2)
			{
				if($delivery_2 == '')
				{
					$sql7="update truck set STATUS='' where truck.REFERENCE='$work_order_number'";
					$result7=ExecuteNonQuery ($sql7);
					
					$sql6="update trailer set STATUS='' where trailer.REFERENCE='$work_order_number'";
					$result6=ExecuteNonQuery ($sql6);
					
					$sql8="update trailer_2 set STATUS='' where trailer_2.REFERENCE='$work_order_number'";
					$result8=ExecuteNonQuery ($sql8);
					
					$sql9="update tanker set STATUS='' where tanker.REFERENCE='$work_order_number'";
					$result9=ExecuteNonQuery ($sql9);
					
					$sql10="update tanker_2 set STATUS='' where tanker_2.REFERENCE='$work_order_number'";
					$result10=ExecuteNonQuery ($sql10);
				}
				
				$sql4=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$work_order_number','first delivery confirmation','$del_time',now(),'$user',now())";
				$result4=ExecuteNonQuery ($sql4);
				
				$sql5="update work_order set STATUS='delivered',QUANTITY_1=$quantity1, DELIVERED_AT=now() where work_order.WORK_ORDER_NUMBER='$work_order_number'";
				$result5=ExecuteNonQuery ($sql5);
				
				file_put_contents($url,base64_decode($del_signature));
				
			}
		}
	}
	//END DELIVERY 1

	//START DELIVERY 2
	if(($del_date2 != "1")&&($del_time2 != "1")&&($del_receiver2 != "1"))
	{
		$time = date("d-m-Y")."-".time();
		$photo = "comment_del2";
		$DefaultId = $photo.$time;

		$url = "signature/$DefaultId.png";
		
		$sql1="select * from delivery2 where WORK_ORDER_NUMBER='$work_order_number'";
		$result1 = ExecuteQuery($sql1);

		if (mysqli_num_rows($result1)==0)
		{
			$sql2=" INSERT INTO delivery2 (WORK_ORDER_NUMBER,DATE,TIME,SIGNED_BY,SIGNATURE,DELIVERED_BY,CREATED_AT) values ('$work_order_number','$del_date2','$del_time2','$del_receiver2','$url','$user',now())";

			$result2=ExecuteNonQuery ($sql2);

			if($result2)
			{
				$sql7="update truck set STATUS='' where truck.REFERENCE='$work_order_number'";
				$result7=ExecuteNonQuery ($sql7);
				
				$sql6="update trailer set STATUS='' where trailer.REFERENCE='$work_order_number'";
				$result6=ExecuteNonQuery ($sql6);
				
				$sql8="update trailer_2 set STATUS='' where trailer_2.REFERENCE='$work_order_number'";
				$result8=ExecuteNonQuery ($sql8);
				
				$sql9="update tanker set STATUS='' where tanker.REFERENCE='$work_order_number'";
				$result9=ExecuteNonQuery ($sql9);
				
				$sql10="update tanker_2 set STATUS='' where tanker_2.REFERENCE='$work_order_number'";
				$result10=ExecuteNonQuery ($sql10);
				
				$sql4=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$work_order_number','second delivery confirmation','$del_time2',now(),'$user',now())";
				$result4=ExecuteNonQuery ($sql4);
				
				$sql5="update work_order set STATUS='mixed',QUANTITY_2=$quantity2, DELIVERED_AT=now() where work_order.WORK_ORDER_NUMBER='$work_order_number'";
				$result5=ExecuteNonQuery ($sql5);
				
				file_put_contents($url,base64_decode($del_signature2));
			}
		}
	}
}

?>

