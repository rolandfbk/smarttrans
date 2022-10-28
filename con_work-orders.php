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
					<div style="color:#fff; margin-bottom:25px">Created by <a href="https://rolandoy.com" target="_blank">Roland</a> &copy; <?php echo date('Y') ?></div>
					</li>
				
					
                    <!--<li>
                        <a href="con_home.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a class="active-menu" href="con_work-orders.php"><i class="fa fa-sitemap"></i> Work Orders</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="con_work-order-client.php">Create Work Order</a>
                            </li>
                            <li>
                                <a href="con_work-order-manage.php">Manage Work Order</a>
                            </li>
							<li>
                                <a href="con_work-order-pickup.php">Picked Up Work Order</a>
                            </li>
                            <li>
                                <a href="con_work-order-delivered.php">Delivered Work Order</a>
                            </li>
							<li>
                                <a href="con_work-order-search.php">Search Work Order</a>
                            </li>
						</ul>
                    </li>
					<li>
                        <a  href="con_manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
						<ul class="nav nav-second-level">
                            
							<li>
                                <a href="con_mobile.php">Mobile User</a>
                            </li>
						</ul>
                    </li>
					
					<li>
                        <a  href="con_manage-product.php"><i class="fa fa-sitemap"></i> Manage Products</a>
                    </li>
					
					<li>
                        <a href="con_manage-vehicle.php"><i class="fa fa-sitemap"></i> Manage Vehicles</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="con_truck.php">Truck</a>
                            </li>
                            <li>
                                <a href="con_trailer.php">First Trailer</a>
                            </li>
							<li>
                                <a href="con_trailer2.php">Second Trailer</a>
                            </li>
                            <li>
                                <a href="con_tanker.php">First Tanker</a>
                            </li>
							<li>
                                <a href="con_tanker2.php">Second Tanker</a>
                            </li>
                            <li>
                                <a href="con_asset-check.php">Assets Check</a>
                            </li>
						</ul>
                    </li>
					<li>
                        <a href="con_manage-client.php"><i class="fa fa-sitemap"></i> Manage Clients & Destinations</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="con_client.php">Clients</a>
                            </li>
                            <li>
                                <a href="con_pickup-point.php">Pickup Point</a>
                            </li>
							<li>
                                <a href="con_delivery-point1.php">Delivery Point</a>
                            </li>
						</ul>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
					
						<div class="row">
							<div class="col-md-12">
							 <h2>Work Orders</h2>   
								<div align="right">
									<input type="button" value="Refresh" onClick="window.location.reload()">
									<!--<button onclick="myFunction()">Print this page</button>-->
								</div>
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>New Work Order Created</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to create new work order. Please try again...</h4>";
												
								?>
								
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-default">
									
									<div class="panel-body">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#create-work-order" data-toggle="tab">Create Work Order</a>
											</li>
											<li class=""><a href="#manage-work-orders" data-toggle="tab">Manage Work Orders</a>
											</li>
											<li class=""><a href="#pickup-work-order" data-toggle="tab">Picked Up Work Order</a>
											</li>
											<li class=""><a href="#delivered-work-order" data-toggle="tab">Delivered Work Order</a>
											</li>
											<!--<li class=""><a href="#assigned-work-order" data-toggle="tab">Assigned Work Order</a>
											</li>
											<li class=""><a href="#accepted-work-order" data-toggle="tab">Accepted Work Order</a>
											</li>
											<li class=""><a href="#rejected-work-order" data-toggle="tab">Rejected Work Order</a>
											</li>
											<li class=""><a href="#non-assigned-work-order" data-toggle="tab">Non Assigned Work Order</a>
											</li>-->
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade" id="manage-work-orders">
												<br>
												
												<div class="col-md-12 col-sm-12 col-xs-12">
													<!-- Advanced Tables -->
													<div class="panel panel-default">
														<!--<div class="panel-heading">
															
															 <form action="con_export.php" method="post" name="export_excel">
																<div class="control-group">
																	<div align="right" class="controls">
																		From (<i>Recent date</i>):
																		<input type="date" name="from" required="required">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		To (<i>Older date</i>):
																		<input type="date" name="to" required="required">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<button type="submit" id="export" name="export" class="btn btn-primary button-loading" data-loading-text="Loading...">Download This Table</button>
																	</div>
																</div>
															</form>
														</div>-->
														<div id="buttons"></div>
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example">
																	<?php
																		$sql="select * from work_order order by CREATED_AT desc";
																		$result=ExecuteQuery($sql);
																	?>
																	<thead>
																		<tr>
																			
																			<th style="width:10px;"></th>
																			<th style="width:10px;"><i class="fa fa-paperclip" style="font-size:20px"></th>
																			<th style="width:40px;">Work Order Number</th>
																			<th style="width:40px;">Shipment Reference</th>
																			<th style="width:40px;">Import Reference</th>
																			<th style="width:40px;">Bill Client</th>
																			<th style="width:40px;">Product Type</th>
																			<th style="width:30px;">Quantity</th>
																			<th style="width:30px;">Tonnage</th>
																			<th style="width:40px;">Pickup Point</th>
																			<th style="width:50px;">Pickup Date</th>
																			<th style="width:40px;">Pickup Time</th>
																			<th style="width:50px;">Delivery Point 1</th>
																			<th style="width:50px;">Delivery Point 2</th>
																			<th style="width:40px;">Truck Allocation</th>
																			<th style="width:40px;">Trailler Allocation</th>
																			<th style="width:40px;">Trailler Allocation 2</th>
																			<th style="width:40px;">Driver Assigned</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row = mysqli_fetch_array($result))
																			{
																				$link = $row['ATTACHMENT'];
																				
																				
																				echo "
																					<tr>
																						
																						<td><a href='con_work-order-details.php?id=$row[ID]' ><i class='fa fa-eye' style='font-size:20px'></i></a></td>
																					";
																					
																				if($link =="attachment/")
																				{
																					echo"<td style='text-align:center'><i class='fa fa-minus-circle'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><a href='$link'><i class='fa fa-file'></i></a></td>";
																				}
																						
																				echo "	
																						<td>$row[WORK_ORDER_NUMBER]</td>
																						<td>$row[SHIPMENT_REFERENCE]</td>
																						<td>$row[IMPORT_REFERENCE]</td>
																						<td>$row[BILL_CLIENT]</td>
																						<td>$row[PRODUCT_TYPE]</td>
																						<td>$row[QUANTITY]</td>
																						<td>$row[TONNAGE]</td>
																						<td>$row[PICKUP_POINT]</td>
																						<td>$row[PICKUP_DATE]</td>
																						<td>$row[PICKUP_TIME]</td>
																						<td>$row[DELIVERY_POINT_1]</td>
																						<td>$row[DELIVERY_POINT_2]</td>
																						<td>$row[TRUCK_ALLOCATION]</td>
																						<td>$row[TRAILER_ALLOCATION]</td>
																						<td>$row[TRAILER_ALLOCATION_2]</td>
																						<td>$row[DRIVER_ASSIGNED]</td>
																					</tr>
																				";
																			}
																		?>
																	</tbody>
																</table>
																
															</div>
															
														</div>
														
													</div>
													<!--End Advanced Tables -->
												</div>
											</div>
											<div class="tab-pane fade active in" id="create-work-order">
												<br>
												
												<br>
												
												<form action="con_create-work-orderH.php" method="POST" enctype="multipart/form-data">
												<div class="row">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="form-group">
																	<label>Attachment</label>
																	<input type="file" name="attachment">
																</div>
																<div class="form-group">
																	<label>Shipment Reference</label>
																	<input type="text" name="shipment_reference" class="form-control">
																</div>
																<div class="form-group">
																	<label>Import Reference</label>
																	<input type="text" name="import_reference" class="form-control">
																</div>
																<div class="form-group">
																	<label>Bill Client</label>
																	<select name="bill_client" class="form-control">
																		<option value="" disabled selected hidden>Please select client</option>
																		<?php
																			$sql9="select * from customer_list order by COMPANY";
																			$result9=ExecuteQuery($sql9);
																			
																			while($row9 = mysqli_fetch_array($result9))
																			{
																				echo"<option value='$row9[COMPANY]'>$row9[COMPANY]</option>";
																			}
																		?>
																	</select>
																</div>
																
															</div>
														</div>
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="form-group">
																	<label>Product Type</label>
																	<input list="browsers" name="product_type" class="form-control">
																		<datalist id="browsers">
																			<?php
																				$sql6="select * from product_type order by CREATED_AT desc";
																				$result6=ExecuteQuery($sql6);
																				
																				while($row6 = mysqli_fetch_array($result6))
																				{
																					echo"<option value='$row6[PRODUCT_NAME]'>$row6[PRODUCT_NAME]</option>";
																				}
																			?>
																		</datalist>
																</div>
																<div class="form-group">
																	<label>Quantity</label>
																	<input type="text" name="quantity" class="form-control" onkeypress='validate(event)'>
																</div>
																<div class="form-group">
																	<label>Tonnage</label>
																	<input type="text" name="tonnage" class="form-control" onkeypress='validate(event)'>
																</div>
																<div class="form-group">
																	<label>Pickup Point</label>
																	<select name="pickup_point" class="form-control">
																		<option value="" disabled selected hidden>Please select pickup point</option>
																		<?php
																			$sql11="select * from delivery_two order by CUSTOMER_NAME";
																			$result11=ExecuteQuery($sql11);
																			
																			while($row11 = mysqli_fetch_array($result11))
																			{
																				echo"<option value='$row11[CUSTOMER_NAME], $row11[OFFLOAD_POINT]'>$row11[CUSTOMER_NAME], $row11[OFFLOAD_POINT]</option>";
																			}
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Pickup Date</label>
																	<div id="sandbox-container"><input name="pickup_date" type="text" class="form-control" placeholder="Click to set date" /></div>
																</div>
																<div class="form-group">
																	<label>Pickup Time &nbsp;&nbsp;<button type="button" id="button-b">Set time</button>&nbsp;<!--<button type="button" id="button-a">Check the  minutes </button>--></label>
																	<input type="time" id="input-a" value="" data-default="20:48" name="pickup_time" class="form-control">
																	
																	
																</div>
																
															</div>
														</div>
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="form-group">
																	<label>Delivery Point 1</label>
																	<select name="delivery_point1" class="form-control">
																		<option value="" disabled selected hidden>Please select delivery point</option>
																		<?php
																			$sql7="select * from delivery_one order by OFFLOAD_POINT";
																			$result7=ExecuteQuery($sql7);
																			
																			while($row7 = mysqli_fetch_array($result7))
																			{
																				echo"<option value='$row7[OFFLOAD_POINT], $row7[SUBURB]'>$row7[OFFLOAD_POINT], $row7[SUBURB]</option>";
																			}
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Delivery Point 2</label>
																	<select name="delivery_point2" class="form-control">
																		<option value="" disabled selected hidden>Please select delivery point</option>
																		<?php
																			$sql8="select * from delivery_two order by CUSTOMER_NAME";
																			$result8=ExecuteQuery($sql8);
																			
																			while($row8 = mysqli_fetch_array($result8))
																			{
																				echo"<option value='$row8[CUSTOMER_NAME], $row8[OFFLOAD_POINT]'>$row8[CUSTOMER_NAME], $row8[OFFLOAD_POINT]</option>";
																			}
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Truck Allocation</label>
																	<select name="truck_allocation" class="form-control">
																		<option value="" disabled selected hidden>Please select truck</option>
																		<?php
																			$sql3="select * from truck where truck.STATUS='' order by VEHICLE_REG";
																			$result3=ExecuteQuery($sql3);
																			
																			while($row3 = mysqli_fetch_array($result3))
																			{
																				echo"<option value='$row3[VEHICLE_REG]'>$row3[VEHICLE_REG] - $row3[VEHICLE_MAKE]</option>";
																			}
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Trailer Allocation 1</label>
																	<select name="trailer_allocation" class="form-control">
																		<option value="" disabled selected hidden>Please select trailer</option>
																		<?php
																			$sql4="select * from trailer where trailer.STATUS='' order by VEHICLE_REG";
																			$result4=ExecuteQuery($sql4);
																			
																			while($row4 = mysqli_fetch_array($result4))
																			{
																				echo"<option value='$row4[VEHICLE_REG]'>$row4[VEHICLE_REG] - $row4[VEHICLE_MAKE]</option>";
																			}
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Trailer Allocation 2</label>
																	<select name="trailer_allocation2" class="form-control">
																		<option value="" disabled selected hidden>Please select trailer</option>
																		<?php
																			$sql10="select * from trailer_2 where trailer_2.STATUS='' order by VEHICLE_REG";
																			$result10=ExecuteQuery($sql10);
																			
																			while($row10 = mysqli_fetch_array($result10))
																			{
																				echo"<option value='$row10[VEHICLE_REG]'>$row10[VEHICLE_REG] - $row10[VEHICLE_MAKE]</option>";
																			}
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label>Driver Assigned</label>
																	<select name="driver_assigned" class="form-control">
																		<option value="" disabled selected hidden>Please select driver</option>
																		<?php
																			$sql2="select * from controller_user where controller_user.USER_TYPE='mobile' order by FIRST_NAME";
																			$result2=ExecuteQuery($sql2);
																			
																			while($row2 = mysqli_fetch_array($result2))
																			{
																				echo"<option value='$row2[REFERENCE_NUMBER]'>$row2[FIRST_NAME] $row2[SURNAME]</option>";
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
													
													</div>
													<br>
													<div align="right">
														<button type="submit" class="btn btn-primary">Create Work Order</button>
													</div>
												</form>
												
											</div>
											<div class="tab-pane fade" id="pickup-work-order">
												<br>
												<div class="panel panel-default">
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example1">
																	<?php
																		$sql1="select * from work_order where work_order.STATUS='pickedup' order by CREATED_AT desc";
																		$result1=ExecuteQuery($sql1);
																	?>
																	<thead>
																		<tr>
																			<th style="width:10px;"></th>
																			<th style="width:10px;"><i class="fa fa-paperclip" style="font-size:20px"></i></th>
																			<th style="width:40px;">Work Order Number</th>
																			<th style="width:40px;">Shipment Reference</th>
																			<th style="width:40px;">Import Reference</th>
																			<th style="width:40px;">Bill Client</th>
																			<th style="width:40px;">Product Type</th>
																			<th style="width:30px;">Quantity</th>
																			<th style="width:30px;">Tonnage</th>
																			<th style="width:40px;">Pickup Point</th>
																			<th style="width:50px;">Pickup Date</th>
																			<th style="width:40px;">Pickup Time</th>
																			<th style="width:50px;">Delivery Point 1</th>
																			<th style="width:50px;">Delivery Point 2</th>
																			<th style="width:40px;">Truck Allocation</th>
																			<th style="width:40px;">Trailler Allocation</th>
																			<th style="width:40px;">Trailler Allocation 2</th>
																			<th style="width:40px;">Driver Assigned</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row1 = mysqli_fetch_array($result1))
																			{
																				$link1 = $row1['ATTACHMENT'];
																				$status1 = $row1['STATUS'];
																				
																				echo "
																					<tr>
																						<td><a href='con_work-order-details.php?id=$row1[ID]'><i class='fa fa-eye' style='font-size:20px'></i></a></td>
																					";?>
																			
																			<?php		
																				if($link1 =="attachment/")
																				{
																					echo"<td style='text-align:center'><i class='fa fa-minus-circle'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><a href='$link1'><i class='fa fa-file'></i></a></td>";
																				}
																						
																				echo "	
																						<td>$row1[WORK_ORDER_NUMBER]</td>
																						<td>$row1[SHIPMENT_REFERENCE]</td>
																						<td>$row1[IMPORT_REFERENCE]</td>
																						<td>$row1[BILL_CLIENT]</td>
																						<td>$row1[PRODUCT_TYPE]</td>
																						<td>$row1[QUANTITY]</td>
																						<td>$row1[TONNAGE]</td>
																						<td>$row1[PICKUP_POINT]</td>
																						<td>$row1[PICKUP_DATE]</td>
																						<td>$row1[PICKUP_TIME]</td>
																						<td>$row1[DELIVERY_POINT_1]</td>
																						<td>$row1[DELIVERY_POINT_2]</td>
																						<td>$row1[TRUCK_ALLOCATION]</td>
																						<td>$row1[TRAILER_ALLOCATION]</td>
																						<td>$row1[TRAILER_ALLOCATION_2]</td>
																						<td>$row1[DRIVER_ASSIGNED]</td>
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
											<div class="tab-pane fade" id="delivered-work-order">
												<br>
												<div class="panel panel-default">
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example3">
																	<?php
																		$sql2="select * from work_order where work_order.STATUS='delivered' order by CREATED_AT desc";
																		$result2=ExecuteQuery($sql2);
																	?>
																	<thead>
																		<tr>
																			<th style="width:10px;"></th>
																			<th style="width:10px;"><i class="fa fa-paperclip" style="font-size:20px"></i></th>
																			<th style="width:40px;">Work Order Number</th>
																			<th style="width:40px;">Shipment Reference</th>
																			<th style="width:40px;">Import Reference</th>
																			<th style="width:40px;">Bill Client</th>
																			<th style="width:40px;">Product Type</th>
																			<th style="width:30px;">Quantity</th>
																			<th style="width:30px;">Tonnage</th>
																			<th style="width:40px;">Pickup Point</th>
																			<th style="width:50px;">Pickup Date</th>
																			<th style="width:40px;">Pickup Time</th>
																			<th style="width:50px;">Delivery Point 1</th>
																			<th style="width:50px;">Delivery Point 2</th>
																			<th style="width:40px;">Truck Allocation</th>
																			<th style="width:40px;">Trailler Allocation</th>
																			<th style="width:40px;">Trailler Allocation 2</th>
																			<th style="width:40px;">Driver Assigned</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row2 = mysqli_fetch_array($result2))
																			{
																				$link2 = $row2['ATTACHMENT'];
																				$status2 = $row2['STATUS'];
																				
																				echo "
																					<tr>
																						<td><a href='con_work-order-details.php?id=$row2[ID]' ><i class='fa fa-eye' style='font-size:20px'></i></a></td>
																					";?>
																			
																			<?php		
																				if($link2 =="attachment/")
																				{
																					echo"<td style='text-align:center'><i class='fa fa-minus-circle'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><a href='$link2'><i class='fa fa-file'></i></a></td>";
																				}
																						
																				echo "	
																						<td>$row2[WORK_ORDER_NUMBER]</td>
																						<td>$row2[SHIPMENT_REFERENCE]</td>
																						<td>$row2[IMPORT_REFERENCE]</td>
																						<td>$row2[BILL_CLIENT]</td>
																						<td>$row2[PRODUCT_TYPE]</td>
																						<td>$row2[QUANTITY]</td>
																						<td>$row2[TONNAGE]</td>
																						<td>$row2[PICKUP_POINT]</td>
																						<td>$row2[PICKUP_DATE]</td>
																						<td>$row2[PICKUP_TIME]</td>
																						<td>$row2[DELIVERY_POINT_1]</td>
																						<td>$row2[DELIVERY_POINT_2]</td>
																						<td>$row2[TRUCK_ALLOCATION]</td>
																						<td>$row2[TRAILER_ALLOCATION]</td>
																						<td>$row2[TRAILER_ALLOCATION_2]</td>
																						<td>$row2[DRIVER_ASSIGNED]</td>
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
											<!--<div class="tab-pane fade" id="assigned-work-order">
												
											</div>
											<div class="tab-pane fade" id="accepted-work-order">
												
											</div>
											<div class="tab-pane fade" id="rejected-work-order">
												
											</div>
											<div class="tab-pane fade" id="non-assigned-work-order">
												
											</div>-->
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
            $(document).ready(function () {
                $('#dataTables-example1').dataTable();
            });
    </script>
	<script>
            $(document).ready(function () {
                $('#dataTables-example2').dataTable();
            });
    </script>
	<script>
            $(document).ready(function () {
                $('#dataTables-example3').dataTable();
            });
    </script>
	
	<script>
		var input = $('#input-a');
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
		$('#button-b').click(function(e){
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
	
	
</html>
