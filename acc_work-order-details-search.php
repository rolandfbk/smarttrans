
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
	
	if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='account'))
	{
		header("location: index.php");
	}
?>
<?php

	$id = $_GET['id'];
	$truck = $_GET['truck'];
	$trailer = $_GET['trailer'];
	$trailer2 = $_GET['trailer2'];
	$tanker = $_GET['tanker'];
	$tanker2 = $_GET['tanker2'];
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
                        <a href="ahome.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a href="acc_work-order-manage.php"><i class="fa fa-sitemap"></i> Work Orders</a>
                    </li>
					<li>
                        <a class="active-menu" href="acc_work-order-search.php"><i class="fa fa-sitemap"></i> Search Work Order</a>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
					
						<div class="row">
							<div class="col-md-12">
							 <h2>Archive Work Order Details&nbsp;&nbsp;&nbsp;&nbsp;
								
								<!--<a href="<?php echo"work-order-details-searchH.php?id=$id";?>"><button style="" class="btn btn-success">Return This Work Order To Account</button></a>-->
								
							 </h2>
								<h5>Created on <font color="green"><b><?php echo"$created";?></b></font></h5>
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
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "editvalid")
											echo "<h4 style='color:green;'>Work Order updated</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "editinvalid")
											echo "<h4 style='color:red;'>Failed to update Work Order. Please try again...</h4>";
												
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
										<ul class="tab nav nav-tabs" id="myTab">
											<li class="active"><a href="#header" role="tab" data-toggle="tab">Description</a>
											</li>
											<li class=""><a href="#comments" role="tab" data-toggle="tab">Attachment</a>
											</li>
											<li class=""><a href="#pickup" role="tab" data-toggle="tab">Pickup</a>
											</li>
											<li class=""><a href="#stops" role="tab" data-toggle="tab">Stops</a>
											</li>
											<li class=""><a href="#delivery" role="tab" data-toggle="tab">Delivery</a>
											</li>
											<?php 
												if($delivery_point2 =='')
												{
													if($status == 'delivered' || $status == 'mixed' || $status == 'account' || $status == 'archive')
													{
														echo"<li class=''><a href='#delivery-note' role='tab' data-toggle='tab'><b>Delivery Note</b></a></li>";
													}
												}
												else{
													if($status == 'mixed' || $status == 'account' || $status == 'archive')
													{
														echo"<li class=''><a href='#delivery-note' role='tab' data-toggle='tab'><b>Delivery Note</b></a></li>";
													}
												}
											?>
											<li class=""><a href="#activity-log" role="tab" data-toggle="tab">Activity Log</a>
											</li>
											
											<?php if($status == 'created' || $status == 'pickedup' || $status == 'gatetime')
													{
														echo"<li class=''><a href='#edit-work-order' role='tab' data-toggle='tab'><b>Edit This Work Order</b></a></li>";
													}
											?>
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
																		<th style='width:190px;text-align:right;vertical-align:top'>Main Attachment&nbsp;&nbsp;&nbsp;:</th>";
																		if($StringCount <= 33)
																		{
																			echo"<td style='padding-left:10px'><i class='fa fa-minus-circle'></i></td>";
																		}
																		else
																		{
																			//echo"<td style='padding-left:10px'><a href='$attachment'><i class='fa fa-file'></i></a></td>";
																			echo"<td style='padding-left:10px'><a href='$attachment' download='myimage'><button><i class='fa fa-file'></i>&nbsp;Download</button></a><br><br>
																			<a target='blank' href='$attachment'><button><i class='fa fa-file'></i>&nbsp;View</button></a>
																			</td>";
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
																		<td style='padding-left:10px'>$quantity L</td>
																	</tr>
																	<tr style='height:10px'></tr>
																	<tr>
																		<th style='width:190px;text-align:right'>Tonnage&nbsp;&nbsp;&nbsp;:</th>
																		<td style='padding-left:10px'>$tonnage T</td>
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
																			<td style='padding-left:10px'>$driver_first_name $driver_surname</td>
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
													<form action="<?php echo"commentH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
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
																					<th>Attachment No</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$count</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																				<th>Work Order Number</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$work_order_number</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Witness</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[TITLE]</td>
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
																							<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<a target='blank' href='$row5[FILE]'><i class='fa fa-file'></i></a></td>
																						</tr>
																					";
																				}
																				
																			echo"
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Attached By</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[ATTACHED_BY]</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				<tr>
																					<th>Date/Time</th>
																					<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row5[CREATED_AT]</td>
																				</tr>
																				<tr style='height:10px'></tr>
																				
																			</table>
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
												
												<div class="col-md-12 col-sm-12 col-xs-12">
													<form action="<?php echo"pickupH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
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
																	
																	$edit_product = $row7['PRODUCT'];
																	$edit_quantity = $row7['QUANTITY'];
																	$edit_tonnage = $row7['TONNAGE'];
																	
																	echo "
																		<table>
																			<tr>
																				<th>Pickup Status</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;";
																					if($row7['DESCRIPTION'] == 'Original')
																					{
																						echo"<font color='green'><b>$row7[DESCRIPTION]</b></font>";
																					}
																					else if($row7['DESCRIPTION'] == 'Amended'){
																						echo"<font color='red'><b>$row7[DESCRIPTION]</b></font>";
																					}
																					else{
																						echo"<i class='fa fa-minus-circle'></i>";
																					}
																				
																			echo"	
																				</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Product Type</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;";
																					if($edit_product == '')
																					{
																						echo"$product_type";
																					}
																					else if($edit_product == $product_type)
																					{
																						echo"$product_type";
																					}
																					else{
																						echo"<font color='red'><b>$edit_product</b></font>";
																					}
																				
																				echo"
																				</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Quantity</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;";
																				if($edit_quantity == '')
																				{
																					echo"$quantity";
																				}
																				else if($edit_quantity == $quantity)
																				{
																					echo"$quantity";
																				}
																				else{
																					echo"<font color='red'><b>$edit_quantity</b></font>";
																				}
																				
																				echo"
																				</td>
																			</tr>
																			<tr style='height:10px'></tr>
																			<tr>
																				<th>Tonnage</th>
																				<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;";
																				if($edit_tonnage == '')
																				{
																					echo"$tonnage";
																				}
																				else if($edit_tonnage == $tonnage)
																				{
																					echo"$tonnage";
																				}
																				else{
																					echo"<font color='red'><b>$edit_tonnage</b></font>";
																				}
																				
																				echo"
																				</td>
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
																			<!--<tr>
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
																			</tr>-->
																			
																		</table>
																		<!--<iframe src='http://demo4u.co.za/test3.php?img=$json3' width='350' height='300' frameborder='0'></iframe>-->
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
													<form action="<?php echo"stopsH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
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
												
												<div class="col-md-12 col-sm-12 col-xs-12">
													<form action="<?php echo"deliveryH.php?id=$id";?>" method="POST" enctype="multipart/form-data">
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
																	
																	$del_sign1 = $row10['SIGNATURE'];
																	$del_Count1 = strlen($del_sign1);
																	
																	$row30 = mysqli_fetch_array($result30);
																	$json8 = $row30['ID'];
																	
																	$del_sign2 = $row30['SIGNATURE'];
																	$del_Count2 = strlen($del_sign2);
																	
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
																						<th>Delivered Product</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$product_type</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivered Quantity</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$quantity_1</td>
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
																					
																				</table>";
																			if($del_Count1 <= 255)
																			{
																				if($del_Count1 != 0){
																					echo"<div><img style='width:200px;height:200px' src='$row10[SIGNATURE]'></div>";
																				}
																			}
																			echo"
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
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row30[DATE]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivery Time</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row30[TIME]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>System Time</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row30[CREATED_AT]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivered Product</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$product_type</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivered Quantity</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$quantity_2</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Delivered By</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row30[DELIVERED_BY]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Received By</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$row30[SIGNED_BY]</td>
																					</tr>
																					<tr style='height:10px'></tr>
																					<tr>
																						<th>Signature</th>
																						<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																					</tr>
																					
																				</table>";
																			if($del_Count2 <= 255)
																			{
																				if($del_Count2 != 0){
																					echo"<div><img style='width:200px;height:200px' src='$row30[SIGNATURE]'></div>";
																				}
																			}
																			echo"
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
											
											<div class="tab-pane fade" id="delivery-note">
												<br>
												<?php
													$unique_number = substr($work_order_number,3);
												?>
												<br>
												
												<a class="btn jquery-word-export" href="javascript:void(0)"><button style="width:150px" class="btn btn-primary">Print Delivery Note</button></a>
												<div id="page-content">
													
													<div class="row">
														<div align="center" class="col-md-12">
															<img src="assets/img/find_user.png" class="user-image img-responsive"/>
														</div>
													</div>
													<div class="row">
														<div align="center" class="col-md-12">
															<h5>P.O. BOX 12411 | JACOBS, 4026 | 21 INDUSTRIA ST | JACOBS, 4052</h5>
															<h5>TEL: (031) 4658681/2/3 | (031) 4654916 | (031) 4651063 | FAX: (031) 4658610 | E-mail: knaidu@gantrans.co.za</h5>
														</div>
													</div>
													<div class="row">
														<div align="center" class="col-md-12">
															<h3 style='color:black;'>DELIVERY NOTE No. <?php echo $unique_number; ?></h3>
														</div>
													</div>
													
													<div class="row">
														<div align="center" class="col-md-12">
															<h5 style='color:black;'><b>"BUILDING BUSINESS PARTNERSHIPS"</b></h5>
															<h5 style='color:black;'>INDUSTRIAL AND COMMERCIAL HAULIERS * HARBOUR CARRIERS * BULK TRANSPORTERS</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>ACCOUNT TO:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$bill_client";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>UPLIFT FROM:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$pickup_point";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. DELIVER TO:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$delivery_point1";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. DELIVER TO:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$delivery_point2";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SHIPPING REF / WORK ORDER No:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$shipment_reference / $work_order_number";?></h5></td>
																</tr>
																
															</table>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:25%'><h5>QUANTITY</h5></td>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>DESCRIPTION</h5></td>
																	<td style='padding-left:5px;background-color:#add8e6;width:25%'><h5>WEIGHT/LITRES</h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;height:35px'><h5><?php echo "$final_quantity";?></h5></td>
																	<td style='padding-left:5px;height:35px'><h5><?php echo "$product_type";?></h5></td>
																	<td style='padding-left:5px;height:35px'><h5><?php echo "$tonnage";?></h5></td>
																</tr>
															</table>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>HORSE REG:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$truck_vehicle_reg";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TANKER/TRAILER REG.:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$trailer_vehicle_reg $tanker_vehicle_reg | $trailer2_vehicle_reg $tanker2_vehicle_reg";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SEAL FITTED ON LOADING</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SEAL, BROKEN ON DISCHARGE</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>DRIVER NAME:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$driver_first_name $driver_surname";?></h5></td>
																</tr>
															</table>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TIME IN:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$pickup_time";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TIME OUT:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row10[TIME]";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;width:50%'><h5></h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row30[TIME]";?></h5></td>
																</tr>
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
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. DATE:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$newDate";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. TIME:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row10[TIME]";?></h5></td>
																</tr>
																
																<tr>
																	<td rowspan="2" style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. RECEIVED BY:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row10[SIGNED_BY]";?></h5></td>
																</tr>
																
																<tr>
																	<?php
																		
																		$s = $row10['SIGNATURE'];
																		if($s != "")
																		{
																			echo"<td style='padding-left:5px;width:50%'><img style='width:100px;height:100px' src='$s'></td>";
																		}
																		else{
																			echo"<td style='padding-left:5px;width:50%'></td>";
																		}
																	?>
																</tr>
																
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. DATE:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$newDate2";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. TIME:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row30[TIME]";?></h5></td>
																</tr>
																
																<tr>
																	<td rowspan="2" style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. RECEIVED BY:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row30[SIGNED_BY]";?></h5></td>
																</tr>
																
																<tr>
																	<?php
																		
																		$s2 = $row30['SIGNATURE'];
																		if($s2 != "")
																		{
																			echo"<td style='padding-left:5px;width:50%'><img style='width:100px;height:100px' src='$s2'></td>";
																		}
																		else{
																			echo"<td style='padding-left:5px;width:50%'></td>";
																		}
																	?>
																</tr>
															</table>
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-12">
															<h5>ALL CARRIAGE IS UNDERTAKEN SUBJECT TO OUR STANDARD TRADING CONDITIONS. A COPY OF WHICH IS AVAILABLE ON REQUEST. NO CLAIMS WILL BE RECOGNISED IN RESPECT OF THIS DELIVERY UNLESS POINTED OUT TO THE DRIVER ON RECEIPT AND WAYBILL ENDORSED ACCORDINGLY.</h5>
														</div>
													</div>
												</div>
												
											</div>
											
											<!--<textarea id="printing-css" style="display:none;">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:white;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none}</textarea>
											<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>-->
											
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
											
											
											<div class="tab-pane fade" id="edit-work-order">
												<br>
												
												<br>
												<?php
													$sql8="select * from work_order where work_order.ID=$id";
													$result8=ExecuteQuery($sql8);
													$row8 = mysqli_fetch_array($result8);
												?>
												
												<form action="<?php echo "edit-work-orderH.php?id=$id&truck=$truck&trailer=$trailer&trailer2=$trailer2&tanker=$tanker&tanker2=$tanker2&cl=$bill_client&tp=$type";?>" method="POST" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-3 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="form-group">
																	<label>Attachment</label>
																	<input type="file" name="attachment" class="form-control">
																</div>
																<div class="form-group">
																	<label>Shipment Reference</label>
																	<input type="text" name="shipment_reference" class="form-control" value="<?php echo"$row8[SHIPMENT_REFERENCE]"; ?>">
																</div>
																<div class="form-group">
																	<label>Import Reference</label>
																	<input type="text" name="import_reference" class="form-control" value="<?php echo"$row8[IMPORT_REFERENCE]"; ?>">
																</div>
																<div class="form-group">
																	<label>Bill Client</label>
																	<select name="bill_client" class="form-control" disabled>
																		<option value="<?php echo"$bill_client"; ?>"><?php echo"$bill_client"; ?></option>
																		<?php
																			$sql18="select * from customer_list order by COMPANY";
																			$result18=ExecuteQuery($sql18);
																			
																			while($row18 = mysqli_fetch_array($result18))
																			{
																				echo"<option value='$row18[COMPANY]'>$row18[COMPANY]</option>";
																			}
																		?>
																	</select>
																</div>
																
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="form-group">
																	<label>Product Type</label>
																	<input list="browsers" name="product_type" class="form-control" value="<?php echo"$product_type"; ?>">
																		<datalist id="browsers">
																			<?php
																				$sql17="select * from product_type order by PRODUCT_NAME";
																				$result17=ExecuteQuery($sql17);
																				
																				while($row17 = mysqli_fetch_array($result17))
																				{
																					echo"<option value='$row17[PRODUCT_NAME]'>$row17[PRODUCT_NAME]</option>";
																				}
																			?>
																		</datalist>
																</div>
																<div class="form-group">
																	<label>Quantity</label>
																	<input type="text" name="quantity" class="form-control" value="<?php echo"$row8[QUANTITY]"; ?>">
																</div>
																<div class="form-group">
																	<label>Tonnage</label>
																	<input type="text" name="tonnage" class="form-control" value="<?php echo"$row8[TONNAGE]"; ?>">
																</div>
																<div class="form-group">
																	<label>Pickup Point</label>
																	<select name="pickup_point" class="form-control">
																		<option value="<?php echo"$pickup_point"; ?>"><?php echo"$pickup_point"; ?></option>
																		<?php
																			$sql22="select * from delivery_two order by CUSTOMER_NAME";
																			$result22=ExecuteQuery($sql22);
																			
																			while($row22 = mysqli_fetch_array($result22))
																			{
																				echo"<option value='$row22[CUSTOMER_NAME], $row22[OFFLOAD_POINT]'>$row22[CUSTOMER_NAME], $row22[OFFLOAD_POINT]</option>";
																			}
																		?>
																	</select>
																</div>
																
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="form-group">
																	<label>Pickup Date</label>
																	<div id="sandbox-container4"><input name="pickup_date" type="text" class="form-control" placeholder="Click to set date" value="<?php echo"$row8[PICKUP_DATE]"; ?>"/></div>
																</div>
																<div class="form-group">
																	<label>Pickup Time &nbsp;&nbsp;<!--<button type="button" id="button-e">Set time</button>-->&nbsp;<!--<button type="button" id="button-a">Check the  minutes </button>--></label>
																	<input type="time" id="input-d" data-default="20:48" name="pickup_time" class="form-control" value="<?php echo"$row8[PICKUP_TIME]"; ?>">
																</div>
																<div class="form-group">
																	<label>Delivery Point 1</label>
																	<select name="delivery_point1" class="form-control">
																		<option value="<?php echo"$delivery_point1"; ?>"><?php echo"$delivery_point1"; ?></option>
																			<?php
																				$sql16="select * from delivery_one where COMPANY='$bill_client' AND CARGO_TYPE='$type'";
																				$result16=ExecuteQuery($sql16);
																				
																				while($row16 = mysqli_fetch_array($result16))
																				{
																					echo"<option value='$row16[OFFLOAD_POINT], $row16[SUBURB]'>$row16[OFFLOAD_POINT], $row16[SUBURB]</option>";
																				}
																			?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Delivery Point 2</label>
																		<select name="delivery_point2" class="form-control">
																			<option value="<?php echo"$delivery_point2"; ?>"><?php echo"$delivery_point2"; ?></option>
																			<?php
																				$sql15="select * from delivery_one where COMPANY='$bill_client' AND CARGO_TYPE='$type'";
																				$result15=ExecuteQuery($sql15);
																				
																				while($row15 = mysqli_fetch_array($result15))
																				{
																					echo"<option value='$row15[OFFLOAD_POINT], $row15[SUBURB]'>$row15[OFFLOAD_POINT], $row15[SUBURB]</option>";
																				}
																			?>
																		</select>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<div class="form-group">
																
																<div class="form-group">
																	<label>Truck Allocation</label>
																	<?php
																			$sql12="select * from truck where truck.VEHICLE_REG='$truck_vehicle_reg' order by CREATED_AT desc";
																			$result12=ExecuteQuery($sql12);
																			$row12=mysqli_fetch_array($result12)?>
																		<select name="truck_allocation" class="form-control">
																			<option value="<?php echo"$row12[VEHICLE_REG]"; ?>"><?php echo"$row12[VEHICLE_REG] - $row12[VEHICLE_MAKE]"; ?></option>
																			<?php
																				$sql9="select * from truck where truck.STATUS='' order by VEHICLE_REG";
																				$result9=ExecuteQuery($sql9);
																				while($row9 = mysqli_fetch_array($result9))
																				{
																					echo"<option value='$row9[VEHICLE_REG]'>$row9[VEHICLE_REG] - $row9[VEHICLE_FLEET_NO] $row9[VEHICLE_MAKE]</option>";
																				}
																			?>
																		</select>
																</div>
															<?php if ($type == 'Packed') 
																	{
															?>
																<div class="form-group">
																	<label>Trailer Allocation 1</label>
																	<?php
																			$sql13="select * from trailer where trailer.VEHICLE_REG='$trailer_vehicle_reg' order by CREATED_AT desc";
																			$result13=ExecuteQuery($sql13);
																			$row13=mysqli_fetch_array($result13)?>
																		<select name="trailer_allocation" class="form-control">
																			<option value="<?php echo"$row13[VEHICLE_REG]"; ?>"><?php echo"$row13[VEHICLE_REG] - $row13[VEHICLE_MAKE]"; ?></option>
																			<?php
																				$sql10="select * from trailer where trailer.STATUS='' order by VEHICLE_REG";
																				$result10=ExecuteQuery($sql10);
																				
																				while($row10 = mysqli_fetch_array($result10))
																				{
																					echo"<option value='$row10[VEHICLE_REG]'>$row10[VEHICLE_REG] - $row10[VEHICLE_MAKE]</option>";
																				}
																			?>
																		</select>
																</div>
																<div class="form-group">
																	<label>Trailer Allocation 2</label>
																	<?php
																			$sql19="select * from trailer_2 where trailer_2.VEHICLE_REG='$trailer2_vehicle_reg' order by CREATED_AT desc";
																			$result19=ExecuteQuery($sql19);
																			$row19=mysqli_fetch_array($result19)?>
																		<select name="trailer_allocation2" class="form-control">
																			<option value="<?php echo"$row19[VEHICLE_REG]"; ?>"><?php echo"$row19[VEHICLE_REG] - $row19[VEHICLE_MAKE]"; ?></option>
																			<?php
																				$sql20="select * from trailer_2 where trailer_2.STATUS='' order by VEHICLE_REG";
																				$result20=ExecuteQuery($sql20);
																				
																				while($row20 = mysqli_fetch_array($result20))
																				{
																					echo"<option value='$row20[VEHICLE_REG]'>$row20[VEHICLE_REG] - $row20[VEHICLE_MAKE]</option>";
																				}
																			?>
																		</select>
																</div>
															<?php }
																	else{
															?>
																<div class="form-group">
																	<label>Tanker Allocation</label>
																	<?php
																			$sql26="select * from tanker where tanker.VEHICLE_REG='$tanker_vehicle_reg' order by CREATED_AT desc";
																			$result26=ExecuteQuery($sql26);
																			$row26=mysqli_fetch_array($result26)?>
																		<select name="tanker_allocation" class="form-control">
																			<option value="<?php echo"$row26[VEHICLE_REG]"; ?>"><?php echo"$row26[VEHICLE_REG] - $row26[VEHICLE_MAKE]"; ?></option>
																			<?php
																				$sql27="select * from tanker where tanker.STATUS='' order by VEHICLE_REG";
																				$result27=ExecuteQuery($sql27);
																				
																				while($row27 = mysqli_fetch_array($result27))
																				{
																					echo"<option value='$row27[VEHICLE_REG]'>$row27[VEHICLE_REG] - $row27[VEHICLE_MAKE]</option>";
																				}
																			?>
																		</select>
																</div>
																<div class="form-group">
																	<label>Tanker Allocation 2</label>
																	<?php
																			$sql28="select * from tanker_2 where tanker_2.VEHICLE_REG='$tanker2_vehicle_reg' order by CREATED_AT desc";
																			$result28=ExecuteQuery($sql28);
																			$row28=mysqli_fetch_array($result28)?>
																		<select name="tanker_allocation2" class="form-control">
																			<option value="<?php echo"$row28[VEHICLE_REG]"; ?>"><?php echo"$row28[VEHICLE_REG] - $row28[VEHICLE_MAKE]"; ?></option>
																			<?php
																				$sql29="select * from tanker_2 where tanker_2.STATUS='' order by VEHICLE_REG";
																				$result29=ExecuteQuery($sql29);
																				
																				while($row29 = mysqli_fetch_array($result29))
																				{
																					echo"<option value='$row29[VEHICLE_REG]'>$row29[VEHICLE_REG] - $row29[VEHICLE_MAKE]</option>";
																				}
																			?>
																		</select>
																</div>
															<?php }?>
																<div class="form-group">
																	<label>Driver Assigned</label>
																	<?php
																			$sql14="select * from controller_user where controller_user.REFERENCE_NUMBER='$driver_reference_number' order by CREATED_AT desc";
																			$result14=ExecuteQuery($sql14);
																			$row14=mysqli_fetch_array($result14)?>
																		<select name="driver_assigned" class="form-control">
																			<option value="<?php echo"$row14[REFERENCE_NUMBER]"; ?>"><?php echo"$row14[FIRST_NAME] $row14[SURNAME]"; ?></option>
																			<?php
																				$sql11="select * from controller_user where controller_user.USER_TYPE='mobile' order by FIRST_NAME";
																				$result11=ExecuteQuery($sql11);
																				
																				while($row11 = mysqli_fetch_array($result11))
																				{
																					echo"<option value='$row11[REFERENCE_NUMBER]'>$row11[FIRST_NAME] $row11[SURNAME]</option>";
																				}
																			?>
																		</select>
																</div>
															</div>
														</div>
													
													</div>
													<br><br>
													<div align="right">
														<button type="submit" class="btn btn-primary">Update Work Order</button>
													</div>
												</form>
												<!-- Test -->
												
												<!-- End Test  -->
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
	<script src="FileSaver.js"></script> 
	<script src="jquery.wordexport.js"></script> 
	<!--<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("a.word-export").click(function(event) {
				$("#page-content").wordExport();
			});
		});
    </script>-->
	
	
	<script>
		$(function() {
			$('a[data-toggle="tab"]').on('click', function(e) {
				window.localStorage.setItem('activeTab', $(e.target).attr('href'));
			});
			var activeTab = window.localStorage.getItem('activeTab');
			if (activeTab) {
				$('#myTab a[href="' + activeTab + '"]').tab('show');
				//window.localStorage.removeItem("activeTab");
			}
		});
	</script>
	
	
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
	<script>
		var input3 = $('#input-d');
		input3.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input3.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-e').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input3.clockpicker('show')
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
	<script>
		$('#sandbox-container4 input').datepicker({
				autoclose: true
			});

			$('#sandbox-container4 input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container4 input').on('hide', function(e){
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
		if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
		(function($) {
			$.fn.wordExport = function(fileName) {
				fileName = typeof fileName !== 'undefined' ? fileName : "Delivery Note";
				var static = {
					mhtml: {
						top: "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>",
						head: "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n",
						body: "<body>_body_</body>"
					}
				};
				var options = {
					maxWidth: 624
				};
				// Clone selected element before manipulating it
				var markup = $(this).clone();

				// Remove hidden elements from the output
				markup.each(function() {
					var self = $(this);
					if (self.is(':hidden'))
						self.remove();
				});

				// Embed all images using Data URLs
				var images = Array();
				var img = markup.find('img');
				for (var i = 0; i < img.length; i++) {
					// Calculate dimensions of output image
					var w = Math.min(img[i].width, options.maxWidth);
					var h = img[i].height * (w / img[i].width);
					// Create canvas for converting image to data URL
					var canvas = document.createElement("CANVAS");
					canvas.width = w;
					canvas.height = h;
					// Draw image to canvas
					var context = canvas.getContext('2d');
					context.drawImage(img[i], 0, 0, w, h);
					// Get data URL encoding of image
					var uri = canvas.toDataURL("image/png");
					$(img[i]).attr("src", img[i].src);
					img[i].width = w;
					img[i].height = h;
					// Save encoded image to array
					images[i] = {
						type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
						encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
						location: $(img[i]).attr("src"),
						data: uri.substring(uri.indexOf(",") + 1)
					};
				}

				// Prepare bottom of mhtml file with image data
				var mhtmlBottom = "\n";
				for (var i = 0; i < images.length; i++) {
					mhtmlBottom += "--NEXT.ITEM-BOUNDARY\n";
					mhtmlBottom += "Content-Location: " + images[i].location + "\n";
					mhtmlBottom += "Content-Type: " + images[i].type + "\n";
					mhtmlBottom += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
					mhtmlBottom += images[i].data + "\n\n";
				}
				mhtmlBottom += "--NEXT.ITEM-BOUNDARY--";

				//TODO: load css from included stylesheet
				var styles = "";

				// Aggregate parts of the file together
				var fileContent = static.mhtml.top.replace("_html_", static.mhtml.head.replace("_styles_", styles) + static.mhtml.body.replace("_body_", markup.html())) + mhtmlBottom;

				// Create a Blob with the file contents
				var blob = new Blob([fileContent], {
					type: "application/msword;charset=utf-8"
				});
				saveAs(blob, fileName + ".doc");
			};
		})(jQuery);
	} else {
		if (typeof jQuery === "undefined") {
			console.error("jQuery Word Export: missing dependency (jQuery)");
		}
		if (typeof saveAs === "undefined") {
			console.error("jQuery Word Export: missing dependency (FileSaver.js)");
		}
	}




	$("a.jquery-word-export").click(function(event) {
				$("#page-content").wordExport();
			});
	</script>
	
	
	
	<!--<script>
		// function downloadInnerHtml(filename, elId) {
		 // var elHtml = document.getElementById(elId).innerHTML;
		 // var link = document.createElement('a');
		 // link.setAttribute('download', filename);   
		 // link.setAttribute('href', 'data:' + 'text/doc' + ';charset=utf-8,' + encodeURIComponent(elHtml));
		 // link.click(); 
		// }
		// var fileName =  'tags.doc'; // You can use the .txt extension if you want
		// downloadInnerHtml(fileName, 'main');
	</script>-->
	
	 <!--<script>
		// function printDiv(elementId) {
			// var a = document.getElementById('printing-css').value;
			// var b = document.getElementById(elementId).innerHTML;
			// window.frames["print_frame"].document.title = document.title;
			// window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
			// window.frames["print_frame"].window.focus();
			// window.frames["print_frame"].window.print();
		// }
	 <!--</script>-->
</body>	

	
</html>
