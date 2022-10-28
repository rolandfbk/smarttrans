<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Barter</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	
	<link rel="stylesheet" type="text/css" href="Clock-picker/jquery-clockpicker.min.css"/>
	
	<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css" rel="stylesheet"/>
	
	<link rel="stylesheet" type="text/css" href="datepicker/datepicker3.css"/>
   
</head>
<body>
<?php 
	session_start();
	require("utility.php");
?>
<?php

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
		
	}
	
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
?>

	<div id="overlay">
		<div id="loader"></div>
	</div>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Smart Barter</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Welcome <?php echo $_SESSION["name"];?> &nbsp;<a href="index.php" class="btn btn-primary square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <!--<li>
                        <a href="mob_home.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a class="active-menu" href="mob_work-orders.php"><i class="fa fa-sitemap"></i> Work Orders</a>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
					
						<div class="row">
							<div class="col-md-12">
							 <h2>Work Order Details</h2>   
								<div align="right">
									<input type="button" value="Refresh" onClick="window.location.reload()">
									<!--<button onclick="myFunction()">Print this page</button>-->
								</div>
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "commentvalid")
											echo "<h4 style='color:green;'>Comment success</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "commentinvalid")
											echo "<h4 style='color:red;'>Comment fail. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "pickupvalid")
											echo "<h4 style='color:green;'>Pickup confirmed</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "pickupinvalid")
											echo "<h4 style='color:red;'>Failed to confirm pickup. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "stopsvalid")
											echo "<h4 style='color:green;'>Stop Point has been posted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "stopsinvalid")
											echo "<h4 style='color:red;'>Failed to post Stop Point. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "deliveryvalid")
											echo "<h4 style='color:green;'>Delivery confirmed</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "deliveryinvalid")
											echo "<h4 style='color:red;'>Failed to confirm delivery. Please try again...</h4>";
												
								?>
								<!--<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4"></div>
									<div class="col-md-4" align="right">
									<form action="<?php echo"assignH.php?id=$id";?>" method="POST">
										<table>
											<tr>
												<td style="padding-right:10px">
													<select name="assign" class="form-control" required="required">
														<option value="" disabled selected hidden>Please select motor carrier office</option>
														<option value="Gantrans-Durban">Gantrans-Durban</option>
														<option value="Gantrans-Joburg">Gantrans-Joburg</option>
														<option value="Gantrans-Cape-Town">Gantrans-Cape-Town</option>
													</select>
												</td>
												<td>
													<?php
														if($status == 'Assigned')
														{
															echo"<button type='submit' class='btn btn-primary' disabled>Assign Work Order</button>";
														}
														else if($status == 'Accepted')
														{
															echo"<button type='submit' class='btn btn-success' disabled>Assign Work Order</button>";
														}
														else if($status == 'Rejected')
														{
															echo"<button type='submit' class='btn btn-danger'>Assign Work Order</button>";
														}
														else
														{
															echo"<button type='submit' class='btn btn-primary'>Assign Work Order</button>";
														}
													?>
												</td>
											<tr>
										</table>
										</form>
									</div>
								</div>-->
								
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-default">
									
									<div class="panel-body">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#header" data-toggle="tab">Header</a>
											</li>
											<li class=""><a href="#comments" data-toggle="tab">Comments</a>
											</li>
											<li class=""><a href="#pickup" data-toggle="tab">Pickup</a>
											</li>
											<li class=""><a href="#stops" data-toggle="tab">Stops</a>
											</li>
											<li class=""><a href="#delivery" data-toggle="tab">Delivery</a>
											</li>
											<li class=""><a href="#activity-log" data-toggle="tab">Activity Log</a>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade active in" id="header">
												<br>
												
												<br>
												<div>
													<div class="col-md-4 col-sm-12 col-xs-12">
														<?php
															$StringCount = strlen($attachment);
															echo "
																<table>
																	<tr>
																		<th style='width:190px;text-align:right'>Main Attachment&nbsp;&nbsp;&nbsp;:</th>";
																		if($StringCount <= 33)
																		{
																			echo"<td style='padding-left:10px'><i class='fa fa-minus-circle'></i></td>";
																		}
																		else
																		{
																			echo"<td style='padding-left:10px'><a href='$attachment'><i class='fa fa-file'></i></a></td>";
																		}
																		
															echo"	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Work Order Number&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$work_order_number</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Shipment Reference&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$shipment_reference</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Import Reference&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$import_reference</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Bill Client&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$bill_client</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Product Type&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$product_type</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Quantity&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$quantity</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Tonnage&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$tonnage</td>
																	</tr>
																</table>
															
															";
														?>
														</div>
														<div class="col-md-4 col-sm-12 col-xs-12">
															<?php
																
																echo "
																	<table>
																		<tr>
																			<th style='width:190px;text-align:right'>Pickup Point&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$pickup_point</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Pickup Date&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$pickup_date</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Pickup Time&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$pickup_time</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Delivery Point 1&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$delivery_point1</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Delivery Point 2&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$delivery_point2</td>
																		</tr>
																	</table>
																
																";
															?>
														</div>
														<div class="col-md-4 col-sm-12 col-xs-12">
															<?php
																
																echo "
																	<table>
																		<tr>
																			<th style='width:190px;text-align:right'>Truck Allocation&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$truck_vehicle_make<br>$truck_vehicle_reg<br>$truck_vehicle_fleet_no<br>$truck_vin_no</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Trailer Allocation&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$trailer_vehicle_make<br>$trailer_vehicle_reg<br>$trailer_vin_no</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Trailer Allocation 2&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$trailer2_vehicle_make<br>$trailer2_vehicle_reg<br>$trailer2_vin_no</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Tanker Allocation&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$tanker_vehicle_make<br>$tanker_vehicle_reg<br>$tanker_vin_no</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Tanker Allocation 2&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$tanker2_vehicle_make<br>$tanker2_vehicle_reg<br>$tanker2_vin_no</td>
																		</tr>
																		<tr style='height:10px'></tr>
																		<tr>
																			<th style='width:190px;text-align:right'>Driver Assigned&nbsp;&nbsp;&nbsp;:</th>
																			<td style='padding-left:10px'>$driver_first_name $driver_surname<br>$driver_reference_number</td>
																		</tr>
																	</table>
																
																";
															?>
														</div>
												</div>
												  
											</div>
											<div class="tab-pane fade" id="comments">
												<br>
												
												<br>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<form action="<?php echo"mob_commentH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
													<!--  Start Table -->
													<div class="panel panel-default">
														<!--<div class="panel-heading">
															
															<div align="right">
																<button type="submit" class="btn btn-primary">Add Comment</button>
															</div>
														</div>-->
														<div class="panel-body">
															<div class="table-responsive">
																<?php
																	$sql5="select * from comment where comment.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
																	$result5=ExecuteQuery($sql5);
																?>
																<!--<table class="table table-striped table-bordered table-hover">
																		<thead>
																			<tr>
																				<th style='width:30px'>No</th>
																				<th style='width:100px'>Title</th>
																				<th style='width:100px'>File</th>
																				<th style='width:190px'>Description</th>
																				<th style='width:100px'>Commented/Attached By</th>
																				<th style='width:100px'>Date/Time</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td></td>
																				<td><input type="text" name="comment_title" class="form-control" placeholder="Title" required="required"/></td>
																				<td><input type="file" name="comment_file" class="form-control"/></td>
																				<td><textarea id="textareacomment" rows="2" name="comment_description" placeholder="Type description or comment" class="form-control" required="required"></textarea></td>
																				<td></td>
																				<td></td>
																			</tr>
																		</tbody>
																	</table>-->
																</div>
																<br><br>
																<?php
	
																	$count = 0;
																	while($row5 = mysqli_fetch_array($result5))
																	{
																		$count = $count + 1;
																		$strcount = "$count";
																		$json2 = $row5['ID'];
																		
																		echo "
																			<table>
																				<tr>
																					<th>Comment No</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$count</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																				<th>Work Order Number</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$work_order_number</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Title</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[TITLE]</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Description</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[DESCRIPTION]</td>
																				</tr>
																				<tr style='height:10px'></tr>";
																				
																				if(strlen($row5['FILE']) <= 30)
																				{
																					echo"
																						<tr>
																							<th>Attachment</th>
																							<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																						</tr>
																					";
																				}
																				else
																				{
																					echo"
																						<tr>
																							<th>Attachment</th>
																							<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<a href='$row5[FILE]'><i class='fa fa-file'></i></a></td>
																						</tr>
																					";
																				}
																				
																			echo"
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Commented By</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[ATTACHED_BY]</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Date/Time</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[CREATED_AT]</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Signed By</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[SIGNED_BY]</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Signature</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																				</tr>
																				
																			</table>
																			<iframe src='http://demo4u.co.za/test2.php?img=$json2' width='350' height='300' frameborder='0'></iframe>
																			<hr><br><br>
																		";
																	}
																?>
															</div>
														</div>
														 <!-- End table -->
														</form>
												
												</div>
											</div>
											<div class="tab-pane fade" id="pickup">
												
												<br>
												
												<br>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<form action="<?php echo"mob_pickupH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
													<!--  Start Table -->
													<div class="panel panel-default">
														<!--<div class="panel-heading">
															
															<div align="right">
																<?php
																	$sql6="select * from pickup where pickup.WORK_ORDER_NUMBER='$work_order_number'";
																	$result6=ExecuteQuery($sql6);
																	
																	if(mysqli_num_rows($result6)==1)
																	{
																		echo"<button type='submit' class='btn btn-primary' disabled>Confirm Pickup</button>";
																	}
																	else
																	{
																		echo"<button type='submit' class='btn btn-primary'>Confirm Pickup</button>";
																	}
																?>
																	
															</div>
														</div>-->
														<div class="panel-body">
															<div class="table-responsive">
																<?php
																	$sql7="select * from pickup where pickup.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
																	$result7=ExecuteQuery($sql7);
																?>
																<!--<table class="table table-striped table-bordered table-hover">
																		<thead>
																			<tr>
																				<th style='width:300px'>Description</th>
																				<th style='width:100px'>Date</th>
																				<th style='width:100px'>Time</th>
																				<th style='width:100px'>Picked Up By</th>
																				<th style='width:100px'>System Date/Time</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td><textarea id="textareapickup" rows="2" name="pickup_description" placeholder="Type description or comment" class="form-control" required="required"></textarea></td>
																				<td><div id="sandbox-container"><input name="pickup_date" type="text" type="text" class="form-control" placeholder="Click to set date" required="required"/></div></td>
																				<td><input type="time" id="input-a" value="" data-default="20:48" name="pickup_time" class="form-control" required="required"><button type="button" id="button-b">Set Time</button></td>
																				<td></td>
																				<td></td>
																				
																			</tr>
																			
																		</tbody>
																	</table>-->
																</div>
																<br><br>
																<?php
																	
																	$row7 = mysqli_fetch_array($result7);
																	$json3 = $id;
																	
																	echo "
																		<table>
																			<tr>
																				<th>Product Type</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$product_type</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Quantity</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$quantity</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Tonnage</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$tonnage</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Work Order Number</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$work_order_number</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Shipping Reference</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$shipment_reference</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Import Reference</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$import_reference</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Pickup Date</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row7[DATE]</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Pickup Time</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row7[TIME]</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>System Time</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row7[CREATED_AT]</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Picked Up By</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row7[PICKED_UP_BY]</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Gate Sign In Time</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$gate_time</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Security Name</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$security_name</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Security Signature</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																			</tr>
																			
																		</table>
																		<iframe src='http://demo4u.co.za/test3.php?img=$json3' width='350' height='300' frameborder='0'></iframe>
																	";
																?>
															</div>
														</div>
														 <!-- End table -->
														</form>
												
												</div>
											</div>
											<div class="tab-pane fade" id="stops">
												
												<br>
												
												<br>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<form action="<?php echo"mob_stopsH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
													<!--  Start Table -->
													<div class="panel panel-default">
														<!--<div class="panel-heading">
															
															<div align="right">
																<button type="submit" class="btn btn-primary">Post Stop</button>
															</div>
														</div>-->
														<div class="panel-body">
															<div class="table-responsive">
																<?php
																	$sql23="select * from stops where stops.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
																	$result23=ExecuteQuery($sql23);
																?>
																<table class="table table-striped table-bordered table-hover">
																		<thead>
																			<tr>
																				<th style='width:30px'>No</th>
																				<th style='width:100px'>Title</th>
																				<!--<th style='width:190px'>Description</th>-->
																				<th style='width:100px'>Date</th>
																				<th style='width:100px'>Time</th>
																				<th style='width:100px'>Posted By</th>
																				<th style='width:100px'> System Date/Time</th>
																			</tr>
																		</thead>
																		<tbody>
																			<!--<tr>
																				<td></td>
																				<td><input type="text" name="stop_title" class="form-control" placeholder="Title" required="required"/></td>
																				<td><textarea id="textareacomment" rows="2" name="stop_description" placeholder="Type your stopping reason" class="form-control" required="required"></textarea></td>
																				<td><div id="sandbox-container2"><input name="stop_date" type="text" type="text" class="form-control" placeholder="Click to set date" required="required"/></td>
																				<td><input type="time" id="input-b" value="" data-default="20:48" name="stop_time" class="form-control" required="required"><button type="button" id="button-c">Set Time</button></td>
																				<td></td>
																				<td></td>
																			</tr>-->
																			
																			<?php
																				$count5 = 0;
																				while($row23 = mysqli_fetch_array($result23))
																				{
																					$count5 = $count5 + 1;
																					$strcount5 = "$count5";
																					echo"
																						<tr>
																							<td>$strcount5</td>
																							<td>$row23[TITLE]</td>
																							<td>$row23[DATE]</td>
																							<td>$row23[TIME]</td>
																							<td>$row23[POSTED_BY]</td>
																							<td>$row23[CREATED_AT]</td>
																						</tr>
																					";
																				}
																			?>
																			
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														 <!-- End table -->
														</form>
												
												</div>
												
											</div>
											<div class="tab-pane fade" id="delivery">
												
												<br>
												
												<br>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<form action="<?php echo"mob_deliveryH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
													<!--  Start Table -->
													<div class="panel panel-default">
														<!--<div class="panel-heading">
															
															<div align="right">
																<?php
																	$sql9="select * from delivery where delivery.WORK_ORDER_NUMBER='$work_order_number'";
																	$result9=ExecuteQuery($sql9);
																	
																	if(mysqli_num_rows($result9)==1)
																	{
																		echo"<button type='submit' class='btn btn-primary' disabled>Confirm Delivery</button>";
																	}
																	else
																	{
																		echo"<button type='submit' class='btn btn-primary'>Confirm Delivery</button>";
																	}
																?>
																	
															</div>
														</div>-->
														<div class="panel-body">
															<div class="table-responsive">
																<?php
																	$sql10="select * from delivery where delivery.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
																	$result10=ExecuteQuery($sql10);
																	
																	$sql30="select * from delivery2 where delivery2.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
																	$result30=ExecuteQuery($sql30);
																?>
																<!--<table class="table table-striped table-bordered table-hover">
																		<thead>
																			<tr>
																				<th style='width:390px'>Description</th>
																				<th style='width:100px'>Date</th>
																				<th style='width:100px'>Time</th>
																				<th style='width:100px'>Delivered By</th>
																				<th style='width:100px'>System Date/Time</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td><textarea id="textareapickup" rows="2" name="delivery_description" placeholder="Type description or comment" class="form-control" required="required"></textarea></td>
																				<td><div id="sandbox-container3"><input name="delivery_date" type="text" type="text" class="form-control" placeholder="Click to set date" required="required"/></div></td>
																				<td><input type="time" id="input-c" value="" data-default="20:48" name="delivery_time" class="form-control" required="required"><button type="button" id="button-d">Set Time</button></td>
																				<td></td>
																				<td></td>
																				
																			</tr>
																			
																			
																			
																		</tbody>
																	</table>-->
																</div>
																<br><br>
																<?php
																	
																	$row10 = mysqli_fetch_array($result10);
																	$json = $row10['ID'];
																	
																	$row30 = mysqli_fetch_array($result30);
																	$json8 = $row30['ID'];
																	
																	echo "
																		<div class='row'>
																			<div class='col-md-12' align='center'>
																				<table>
																					<tr>
																						<th>Product Type</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$product_type</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Quantity</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$quantity</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Tonnage</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$tonnage</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Work Order Number</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$work_order_number</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Shipping Reference</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$shipment_reference</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Import Reference</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$import_reference</td>
																					</tr>
																				</table>
																			</div>
																		</div>
																		<br><br>
																		<div class='row'>
																			<div class='col-md-6'>
																				<h3>FIRST DELIVERY</h3>
																				<br>
																				<table>
																					<tr>
																						<th>Address</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$delivery_point1</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivery Date</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[DATE]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivery Time</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[TIME]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>System Time</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[CREATED_AT]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivered By</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[DELIVERED_BY]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Received By</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[SIGNED_BY]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Signature</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																					</tr>
																					
																				</table>
																				<iframe src='http://demo4u.co.za/test1.php?img=$json' width='350' height='300' frameborder='0'></iframe>
																			</div>
																			<div class='col-md-6'>
																				<h3>SECOND DELIVERY</h3>
																				<br>
																				<table>
																					<tr>
																						<th>Address</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$delivery_point2</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivery Date</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[DATE]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivery Time</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[TIME]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>System Time</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[CREATED_AT]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivered By</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[DELIVERED_BY]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Received By</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row10[SIGNED_BY]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Signature</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																					</tr>
																					
																				</table>
																				<iframe src='http://demo4u.co.za/test4.php?img=$json8' width='350' height='300' frameborder='0'></iframe>
																			</div>
																	";
																?>
															</div>
														</div>
														 <!-- End table -->
														</form>
													</div>
												</div>
												
											</div>
											<div class="tab-pane fade" id="activity-log">
												<br>
												
												<br>
												<?php
													$sql16="select * from activity_log where activity_log.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
													$result16=ExecuteQuery($sql16);
													
												?>
												
												<table class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th style='width:390px'>Comment</th>
															<th style='width:100px'>Time</th>
															<th style='width:100px'>System Time</th>
															<th style='width:100px'>User</th>
														</tr>
													</thead>
													<tbody>
														<?php
															
															while($row16 = mysqli_fetch_array($result16))
															{
																echo"
																	<tr>
																		<td>$row16[COMMENT]</td>	
																		<td>$row16[TIME]</td>
																		<td>$row16[SYSTEM_TIME]</td>
																		<td>$row16[USER]</td>
																	</tr>
																";
															}
														?>
													</tbody>
												</table>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						 <!-- /. ROW  -->
						<hr />
					
				</div>
				<!--<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div align="center">
							<img height="25px" width="25px" id="loading" src="assets/img/ajax_load.gif" alt="loading" />
						</div>
					</div>
				</div>-->
                
                          
			
             <!-- /. PAGE INNER  -->
	   </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="Clock-picker/jquery-clockpicker.min.js"></script>
	<script src="datepicker/bootstrap-datepicker.js"></script>
	<script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
	
	<script>
		var input1 = $('#input-a');
		input1.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input1.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-b').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input1.clockpicker('show')
					.clockpicker('toggleView', 'hours');
		});
    </script>
	<script>
		var input2 = $('#input-b');
		input2.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input2.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-c').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input2.clockpicker('show')
					.clockpicker('toggleView', 'hours');
		});
    </script>
	<script>
		var input = $('#input-c');
		input.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-d').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input.clockpicker('show')
					.clockpicker('toggleView', 'hours');
		});
    </script>
	
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	<script>
		function myFunction() {
			window.print();
		}
	</script>
	
	<script>
		$(window).load(function(){ 
		 //PAGE IS FULLY LOADED 
		 //FADE OUT YOUR OVERLAYING DIV
		 $('#overlay').fadeOut();
		});
	</script>
	
	<script>
		function validate(evt) {
		  var theEvent = evt || window.event;
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode( key );
		  var regex = /[0-9]|\./;
		  if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		  }
		}
	</script>
	
	<script>
		var textarea = document.querySelector('#textareacomment');

		textarea.addEventListener('keydown', autosize);
					 
		function autosize(){
		  var el = this;
		  setTimeout(function(){
			el.style.cssText = 'height:auto; padding:0';
			// for box-sizing other than "content-box" use:
			// el.style.cssText = '-moz-box-sizing:content-box';
			el.style.cssText = 'height:' + el.scrollHeight + 'px';
		  },0);
		}
	</script>
	
	<script>
		var textarea2 = document.querySelector('#textareapickup');

		textarea2.addEventListener('keydown', autosize);
					 
		function autosize(){
		  var el = this;
		  setTimeout(function(){
			el.style.cssText = 'height:auto; padding:0';
			// for box-sizing other than "content-box" use:
			// el.style.cssText = '-moz-box-sizing:content-box';
			el.style.cssText = 'height:' + el.scrollHeight + 'px';
		  },0);
		}
	</script>
	
	<script>
		var textarea2 = document.querySelector('#textareastops');

		textarea2.addEventListener('keydown', autosize);
					 
		function autosize(){
		  var el = this;
		  setTimeout(function(){
			el.style.cssText = 'height:auto; padding:0';
			// for box-sizing other than "content-box" use:
			// el.style.cssText = '-moz-box-sizing:content-box';
			el.style.cssText = 'height:' + el.scrollHeight + 'px';
		  },0);
		}
	</script>
	<script>
		$('#sandbox-container input').datepicker({
				autoclose: true
			});

			$('#sandbox-container input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container input').on('hide', function(e){
				console.debug('hide', e.date, $(this).data('stickyDate'));
				var stickyDate = $(this).data('stickyDate');
				
				if ( !e.date && stickyDate ) {
					console.debug('restore stickyDate', stickyDate);
					$(this).datepicker('setDate', stickyDate);
					$(this).data('stickyDate', null);
				}
			});
	</script>
	<script>
		$('#sandbox-container2 input').datepicker({
				autoclose: true
			});

			$('#sandbox-container2 input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container2 input').on('hide', function(e){
				console.debug('hide', e.date, $(this).data('stickyDate'));
				var stickyDate = $(this).data('stickyDate');
				
				if ( !e.date && stickyDate ) {
					console.debug('restore stickyDate', stickyDate);
					$(this).datepicker('setDate', stickyDate);
					$(this).data('stickyDate', null);
				}
			});
	</script>
	<script>
		$('#sandbox-container3 input').datepicker({
				autoclose: true
			});

			$('#sandbox-container3 input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container3 input').on('hide', function(e){
				console.debug('hide', e.date, $(this).data('stickyDate'));
				var stickyDate = $(this).data('stickyDate');
				
				if ( !e.date && stickyDate ) {
					console.debug('restore stickyDate', stickyDate);
					$(this).datepicker('setDate', stickyDate);
					$(this).data('stickyDate', null);
				}
			});
	</script>
	
	
</html>
