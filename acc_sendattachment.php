<?php  
ob_start();
session_start();
require_once("utility.php");
//require_once("class.phpmailer.php");
require_once("PHPMailer-master/PHPMailerAutoload.php"); 

$id = $_GET['id'];
?>

<?php
	$sql="select * from work_order where work_order.ID=$id";
	$result=ExecuteQuery($sql);
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		$attachment = $row['ATTACHMENT'];
		$work_order_number = $row['WORK_ORDER_NUMBER'];
		$shipment_reference = $row['SHIPMENT_REFERENCE'];
		$import_reference = $row['IMPORT_REFERENCE'];
		$bill_client = $row['BILL_CLIENT'];
		//$job_detail = $row['JOB_DETAIL'];
		$product_type = $row['PRODUCT_TYPE'];
		$quantity = $row['QUANTITY'];
		$tonnage = $row['TONNAGE'];
		$pickup_point = $row['PICKUP_POINT'];
		$pickup_date = $row['PICKUP_DATE'];
		$pickup_time = $row['PICKUP_TIME'];
		$delivery_point1 = $row['DELIVERY_POINT_1'];
		$delivery_point2 = $row['DELIVERY_POINT_2'];
		$truck_allocation = $row['TRUCK_ALLOCATION'];
		$trailer_allocation = $row['TRAILER_ALLOCATION'];
		$trailer_allocation2 = $row['TRAILER_ALLOCATION_2'];
		$tanker_allocation = $row['TANKER_ALLOCATION'];
		$tanker_allocation2 = $row['TANKER_ALLOCATION_2'];
		$driver_assigned = $row['DRIVER_ASSIGNED'];
		$status = $row['STATUS'];
		$pastel = $row['PASTEL'];
		$gate_time = $row['GATE_TIME'];
		$security_name = $row['SECURITY_NAME'];
		$gate_signature = $row['GATE_SIGNATURE'];
		$type = $row['CARGO_TYPE'];
		$created = $row['CREATED_AT'];
		$quantity_1 = $row['QUANTITY_1'];
		$quantity_2 = $row['QUANTITY_2'];
		
	}
	$final_quantity = $quantity_1 + $quantity_2;
	
	
	$sql2="select * from truck where truck.VEHICLE_REG='$truck_allocation'";
	$result2=ExecuteQuery($sql2);
	$row2 = mysqli_fetch_array($result2);
	$truck_vehicle_make = $row2['VEHICLE_MAKE'];
	$truck_vehicle_reg = $row2['VEHICLE_REG'];
	$truck_vehicle_fleet_no = $row2['VEHICLE_FLEET_NO'];
	$truck_vin_no = $row2['VIN_NO'];
	
	
	$sql3="select * from trailer where trailer.VEHICLE_REG='$trailer_allocation'";
	$result3=ExecuteQuery($sql3);
	$row3 = mysqli_fetch_array($result3);
	$trailer_vehicle_make = $row3['VEHICLE_MAKE'];
	$trailer_vehicle_reg = $row3['VEHICLE_REG'];
	$trailer_vin_no = $row3['VIN_NO'];
	
	$sql21="select * from trailer_2 where trailer_2.VEHICLE_REG='$trailer_allocation2'";
	$result21=ExecuteQuery($sql21);
	$row21 = mysqli_fetch_array($result21);
	$trailer2_vehicle_make = $row21['VEHICLE_MAKE'];
	$trailer2_vehicle_reg = $row21['VEHICLE_REG'];
	$trailer2_vin_no = $row21['VIN_NO'];
	
	$sql24="select * from tanker where tanker.VEHICLE_REG='$tanker_allocation'";
	$result24=ExecuteQuery($sql24);
	$row24 = mysqli_fetch_array($result24);
	$tanker_vehicle_make = $row24['VEHICLE_MAKE'];
	$tanker_vehicle_reg = $row24['VEHICLE_REG'];
	$tanker_vin_no = $row24['VIN_NO'];
	
	$sql25="select * from tanker_2 where tanker_2.VEHICLE_REG='$tanker_allocation2'";
	$result25=ExecuteQuery($sql25);
	$row25 = mysqli_fetch_array($result25);
	$tanker2_vehicle_make = $row25['VEHICLE_MAKE'];
	$tanker2_vehicle_reg = $row25['VEHICLE_REG'];
	$tanker2_vin_no = $row25['VIN_NO'];
	
	$sql4="select * from controller_user where controller_user.REFERENCE_NUMBER='$driver_assigned'";
	$result4=ExecuteQuery($sql4);
	$row4 = mysqli_fetch_array($result4);
	$driver_first_name = $row4['FIRST_NAME'];
	$driver_surname = $row4['SURNAME'];
	$driver_reference_number = $row4['REFERENCE_NUMBER'];
	
	
	$unique_number = substr($work_order_number,3);
?>

<?php
	$sql10="select * from delivery where delivery.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
	$result10=ExecuteQuery($sql10);
	
	$sql30="select * from delivery2 where delivery2.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
	$result30=ExecuteQuery($sql30);
	
	$row10 = mysqli_fetch_array($result10);
	$json = $row10['ID'];
	
	$del_sign1 = $row10['SIGNATURE'];
	$del_Count1 = strlen($del_sign1);
	
	$row30 = mysqli_fetch_array($result30);
	$json8 = $row30['ID'];
	
	$del_sign2 = $row30['SIGNATURE'];
	$del_Count2 = strlen($del_sign2);
?>

<?php 
	$newDate = "";
	$date_del = $row10['DATE'];
	if($date_del != "")
	{
		$newDate = date("d-m-Y", strtotime($date_del));
	}
	
	
	$newDate2 = "";
	$date_del2 = $row30['DATE'];
	if($date_del2 != "")
	{
		$newDate2 = date("d-m-Y", strtotime($date_del2));
	}
	
?>

<?php 
$email=$_POST['email'];
$mainattachment=$_POST['mainattachment'];

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->isHTML(true);
$mail->Username = "myclasstest2000@gmail.com";
$mail->Password = "Student-12345";
$mail->setFrom('no-reply@gmail.com');
$mail->Subject = 'PHPMailer GMail SMTP test';

$message = "

<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
      <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    
	
    <link href='assets/css/bootstrap.css' rel='stylesheet' />
     
    <link href='assets/css/font-awesome.css' rel='stylesheet' />
     
    <link href='assets/js/morris/morris-0.4.3.min.css' rel='stylesheet' />
        
    <link href='assets/css/custom.css' rel='stylesheet' />
     
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
    <link href='assets/js/dataTables/dataTables.bootstrap.css' rel='stylesheet' />
	
	<link rel='stylesheet' type='text/css' href='DataTables/datatables.min.css'/>
	
	<link rel='stylesheet' type='text/css' href='Clock-picker/jquery-clockpicker.min.css'/>
	
	<link href='https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css' rel='stylesheet'/>
	
	<link rel='stylesheet' type='text/css' href='datepicker/datepicker3.css'/>
	
   
</head>
<body>

    <div>
        
        <div>
            <div>
				<div class='row'>
					<div class='col-md-12 col-sm-12'>
						
						<br>
						
						<br>
						
						<div id='page-content'>
							
							<div class='row'>
								<div align='center' class='col-md-12'>
									<img src='http://gantrans.mine.nu:8880/assets/img/find_user.png' class='user-image img-responsive'/>
								</div>
							</div>
							<div class='row'>
								<div align='center' class='col-md-12'>
									<h5>P.O. BOX 12411 | JACOBS, 4026 | 21 INDUSTRIA ST | JACOBS, 4052</h5>
									<h5>TEL: (031) 4658681/2/3 | (031) 4654916 | (031) 4651063 | FAX: (031) 4658610 | E-mail: knaidu@gantrans.co.za</h5>
								</div>
							</div>
							<div class='row'>
								<div align='center' class='col-md-12'>
									<h3 style='color:black;'>DELIVERY NOTE No. $unique_number</h3>
								</div>
							</div>
							
							<div class='row'>
								<div align='center' class='col-md-12'>
									<h5 style='color:black;'><b>'BUILDING BUSINESS PARTNERSHIPS'</b></h5>
									<h5 style='color:black;'>INDUSTRIAL AND COMMERCIAL HAULIERS * HARBOUR CARRIERS * BULK TRANSPORTERS</h5>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-12'>
									<table border='1'  style='width:100%;border-collapse: collapse'>
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>ACCOUNT TO:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$bill_client</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>UPLIFT FROM:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$pickup_point</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. DELIVER TO:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$delivery_point1</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. DELIVER TO:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$delivery_point2</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SHIPPING REF / WORK ORDER No:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$shipment_reference / $work_order_number</h5></td>
										</tr>
										
									</table>
								</div>
							</div>
							<br>
							<div class='row'>
								<div class='col-md-12'>
									<table border='1'  style='width:100%;border-collapse: collapse'>
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:25%'><h5>QUANTITY</h5></td>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>DESCRIPTION</h5></td>
											<td style='padding-left:5px;background-color:#add8e6;width:25%'><h5>WEIGHT/LITRES</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;height:35px'><h5>$final_quantity</h5></td>
											<td style='padding-left:5px;height:35px'><h5>$product_type</h5></td>
											<td style='padding-left:5px;height:35px'><h5>$tonnage</h5></td>
										</tr>
									</table>
								</div>
							</div>
							<br>
							<div class='row'>
								<div class='col-md-12'>
									<table border='1'  style='width:100%;border-collapse: collapse'>
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>HORSE REG:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$truck_vehicle_reg</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TANKER/TRAILER REG.:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$trailer_vehicle_reg $tanker_vehicle_reg | $trailer2_vehicle_reg $tanker2_vehicle_reg</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SEAL FITTED ON LOADING</h5></td>
											<td style='padding-left:5px;width:50%'><h5></h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SEAL, BROKEN ON DISCHARGE</h5></td>
											<td style='padding-left:5px;width:50%'><h5></h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>DRIVER NAME:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$driver_first_name $driver_surname</h5></td>
										</tr>
									</table>
								</div>
							</div>
							<br>
							<div class='row'>
								<div class='col-md-12'>
									<table border='1'  style='width:100%;border-collapse: collapse'>
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TIME IN:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$pickup_time</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TIME OUT:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$row10[TIME]</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;width:50%'><h5></h5></td>
											<td style='padding-left:5px;width:50%'><h5>$row30[TIME]</h5></td>
										</tr>
											
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. DATE:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$newDate</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. TIME:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$row10[TIME]</h5></td>
										</tr>
										
										<tr>
											<td rowspan='2' style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. RECEIVED BY:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$row10[SIGNED_BY]</h5></td>
										</tr>
										
										<tr>";
											
																		
												$s = $row10['SIGNATURE'];
												if($s != "")
												{
													$message .= "<td style='padding-left:5px;width:50%'><img style='width:100px;height:100px' src='http://gantrans.mine.nu:8880/$s'></td>";
												}
												else{
													$message .= "<td style='padding-left:5px;width:50%'></td>";
												}
											
										$message .= "
											
										</tr>
										
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. DATE:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$newDate2</h5></td>
										</tr>
										
										<tr>
											<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. TIME:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$row30[TIME]</h5></td>
										</tr>
										
										<tr>
											<td rowspan='2' style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. RECEIVED BY:</h5></td>
											<td style='padding-left:5px;width:50%'><h5>$row30[SIGNED_BY]</h5></td>
										</tr>
										
										<tr>";
											
																		
												$s2 = $row30['SIGNATURE'];
												if($s2 != "")
												{
													$message .= "<td style='padding-left:5px;width:50%'><img style='width:100px;height:100px' src='http://gantrans.mine.nu:8880/$s2'></td>";
												}
												else{
													$message .= "<td style='padding-left:5px;width:50%'></td>";
												}
											
										$message .= "
											
										</tr>
									</table>
								</div>
							</div>
							
							<div class='row'>
								<div class='col-md-12'>
									<h5>ALL CARRIAGE IS UNDERTAKEN SUBJECT TO OUR STANDARD TRADING CONDITIONS. A COPY OF WHICH IS AVAILABLE ON REQUEST. NO CLAIMS WILL BE RECOGNISED IN RESPECT OF THIS DELIVERY UNLESS POINTED OUT TO THE DRIVER ON RECEIPT AND WAYBILL ENDORSED ACCORDINGLY.</h5>
								</div>
							</div>
						</div>
								
					</div>
				</div>
						 
				<hr />
					
				</div>
				
                          
			
            
	   </div>
        
        </div>
    <script src='assets/js/jquery-1.10.2.js'></script>
     
    <script src='assets/js/bootstrap.min.js'></script>
    
    <script src='assets/js/jquery.metisMenu.js'></script>
     
    <script src='assets/js/dataTables/jquery.dataTables.js'></script>
    <script src='assets/js/dataTables/dataTables.bootstrap.js'></script>
	<script src='Clock-picker/jquery-clockpicker.min.js'></script>
	<script src='datepicker/bootstrap-datepicker.js'></script>
	<script src='FileSaver.js'></script> 
	<script src='jquery.wordexport.js'></script> 
	
</body>	

	
</html>

";




$mail->MsgHTML($message);
//$mail->msgHTML(file_get_contents('../contents.php'), dirname(__FILE__));
$mail->AltBody = 'PHPMailer GMail SMTP test';
$mail->addAttachment($mainattachment);

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++)
{
	$mail->addAttachment($_POST["users"][$i]);
}

$mail->addAddress($email);
$mail->send();

//header("location: acc_work-order-details.php?id=$id&act=editvalid");

if (!$mail->send()) {
   header("location: acc_work-order-details.php?id=$id&act=sendinvalid");
} else {
    header("location: acc_work-order-details.php?id=$id&act=sendvalid");
    
}

// $mail = new PHPMailer();
// $mail->isSMTP();
// $mail->SMTPAuth = true;
// $mail->SMTPSecure = 'ssl';
// $mail->Host = 'smtp.gmail.com';
// $mail->Port = 465;
// $mail->isHTML();
// $mail->Username = "myclasstest2000@gmail.com";
// $mail->Password = "Student-12345";
// $mail->setFrom('no-reply@gmail.com');
// $mail->Subject = 'PHPMailer GMail SMTP test';
// $mail->Body = 'PHPMailer GMail SMTP test';
// $mail->addAddress('rolandfbk@gmail.com');
// $mail->send();
?>