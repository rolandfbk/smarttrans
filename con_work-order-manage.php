<?php ob_start(); ?>
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
	
	if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='controller'))
	{
		header("location: index.php");
	}
	
	
	$sort = $_GET['sort'];
	
	
	$color = $_GET['color'];
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
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "accountvalid")
											echo "<h4 style='color:green;'>Work Order Sent To Account</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "accountinvalid")
											echo "<h4 style='color:green;'>Failed to send work order to account. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "drivervalid")
											echo "<h4 style='color:green;'>New driver assigned</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "driverinvalid")
											echo "<h4 style='color:green;'>Failed to assign new driver. Please try again...</h4>";
												
								?>
								
								
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								
												<br>
												
												<div class="col-md-12 col-sm-12 col-xs-12">
													<!-- Advanced Tables -->
													<div class="panel panel-default">
														<div class="panel-heading">
															
															 <!--<form action="con_export.php" method="post" name="export_excel">
																<div class="control-group">
																	<div align="right" class="controls">
																		From (<i>Recent date</i>):
																		<input type="date" name="from" required="required">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		To (<i>Older date</i>):
																		<input type="date" name="to" required="required">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<button type="submit" id="export" name="export" class="btn btn-primary button-loading" data-loading-text="Loading...">Download This Table</button>
																	</div>
																</div>
															</form>-->
															
															<form style="display:inline-block" action="con_sort-work-order.php" method="post" name="export_excel">
																<div class="control-group">
																	<div class="controls">
																		Sort by controller
																		<select name="sort" required="required">
																			<option value="" disabled selected hidden>Select controller</option>
																			<option value="" >N/A</option>
																			<?php
																				$sql9="select * from controller_user where USER_TYPE='controller' OR USER_TYPE='admin' order by CREATED_AT";
																				$result9=ExecuteQuery($sql9);
																				
																				while($row9 = mysqli_fetch_array($result9))
																				{
																					echo"<option value='$row9[FIRST_NAME]'>$row9[FIRST_NAME] $row9[SURNAME]</option>";
																				}
																			?>
																		</select>
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<button type="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Sort</button>
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<?php echo"<b>$sort</b>"?>
																	</div>
																</div>
															</form>
															
															<form style="display:inline-block;float:right" action="con_sort-color-work-order.php" method="post" name="export_excel">
																<div class="control-group">
																	<div class="controls">
																		Sort by color
																		<select name="color" required="required">
																			<option value="" disabled selected hidden>Select color</option>
																			<option value="" >N/A</option>
																			<option value="Orange" >Orange</option>
																			<option value="Yellow" >Yellow</option>
																			<option value="Green" >Green</option>
																			<option value="Red" >Red</option>
																			
																		</select>
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<button type="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Sort</button>
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<?php echo"<b>$color</b>"?>
																	</div>
																</div>
															</form>
															
														</div>
														
														<div id="buttons"></div>
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example">
																	<?php
																		if($sort =="")
																		{
																			if($color =="")
																			{
																				$sql="select * from work_order where STATUS!='archive' order by CREATED_AT desc";
																				$result=ExecuteQuery($sql);
																			}
																			else if($color =="Orange"){
																				$sql="select * from work_order where STATUS!='archive' AND STATUS='created' order by CREATED_AT desc";
																				$result=ExecuteQuery($sql);
																			}
																			else if($color =="Yellow"){
																				$sql="select * from work_order where STATUS!='archive' AND STATUS='pickedup' order by CREATED_AT desc";
																				$result=ExecuteQuery($sql);
																			}
																			else if($color =="Green"){
																				$sql="select * from work_order where STATUS!='archive' AND (STATUS='delivered' OR STATUS='mixed') order by CREATED_AT desc";
																				$result=ExecuteQuery($sql);
																			}
																			else if($color =="Red"){
																				$sql="select * from work_order where STATUS!='archive' AND STATUS='account' order by CREATED_AT desc";
																				$result=ExecuteQuery($sql);
																			}
																		}
																		else{
																			$sql="select * from work_order where STATUS!='archive' AND CREATED_BY='$sort' order by CREATED_AT desc";
																			$result=ExecuteQuery($sql);
																		}
																		
																	?>
																	<thead>
																		<tr>
																			
																			<th style="width:10px;"></th>
																			<th style="width:10px;"></th>
																			<th style="width:10px;"></th>
																			<th style="width:10px;"><i class="fa fa-paperclip" style="font-size:20px"></th>
																			<th style="width:40px;">Work Order Number</th>
																			<th style="width:80px;">Shipment Reference</th>
																			<th style="width:70px;">Import Reference</th>
																			<th style="width:70px;">Container Number</th>
																			<th style="width:40px;">Bill Client</th>
																			<th style="width:40px;">Cargo Type</th>
																			<th style="width:80px;">Product Type</th>
																			<th style="width:30px;">Quantity</th>
																			<th style="width:30px;">Tonnage</th>
																			<th style="width:90px;">Pickup Point</th>
																			<th style="width:50px;">Pickup Date</th>
																			<th style="width:40px;">Pickup Time</th>
																			<th style="width:150px;">Delivery Point 1</th>
																			<th style="width:150px;">Delivery Point 2</th>
																			<th style="width:40px;">Truck Allocation</th>
																			<th style="width:40px;">Trailler Allocation</th>
																			<th style="width:40px;">Trailler Allocation 2</th>
																			<th style="width:40px;">Tanker Allocation</th>
																			<th style="width:40px;">Tanker Allocation 2</th>
																			<th style="width:40px;">Driver Assigned</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$count = 0;
																			while($row = mysqli_fetch_array($result))
																			{
																				$order = $row['WORK_ORDER_NUMBER'];
																				$link = $row['ATTACHMENT'];
																				$status = $row['STATUS'];
																				$pastel = $row['PASTEL'];
																				$delivery_point2 = $row['DELIVERY_POINT_2'];
																				$StringCount = strlen($link);
																				
																				$sql1="select * from stops where WORK_ORDER_NUMBER = '$order' order by CREATED_AT desc limit 1";
																				$result1=ExecuteQuery($sql1);
																				$row1 = mysqli_fetch_array($result1);
																				$stop = $row1['TITLE'];
																				
																				$response = $row['DRIVER_RESPONSE'];
																				$reason = $row['REJECT_REASON'];
																				$rejected_by = $row['REJECTED_BY'];
																				
																				echo "
																					<tr>
																						
																						<td><a href='con_work-order-details.php?id=$row[ID]' ><i class='fa fa-eye' style='font-size:20px'></i></a></td>
																					";
																				if($status == "pickedup")
																				{
																					if($stop == 'Diesel stop' || $stop == 'Vehicle check' || $stop == 'Vehicle breakdown' || $stop == 'Rest' || $stop == 'Puncture')
																					{
																						echo"<td style='background-color:red;text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/6.png'></td>";
																					}
																					else{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/6.png'></td>";
																					}
																				}
																				else if($delivery_point2 == "" && $status == "delivered")
																				{
																					if($stop == 'Diesel stop' || $stop == 'Vehicle check' || $stop == 'Vehicle breakdown' || $stop == 'Rest' || $stop == 'Puncture')
																					{
																						echo"<td style='background-color:red;text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}
																					else{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}
																				}
																				else if($delivery_point2 != "" && $status == "delivered")
																				{
																					if($stop == 'Diesel stop' || $stop == 'Vehicle check' || $stop == 'Vehicle breakdown' || $stop == 'Rest' || $stop == 'Puncture')
																					{
																						echo"<td style='background-color:red;text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/7.png'></td>";
																					}
																					else{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/7.png'></td>";
																					}
																				}
																				else if($status == "mixed")
																				{
																					if($stop == 'Diesel stop' || $stop == 'Vehicle check' || $stop == 'Vehicle breakdown' || $stop == 'Rest' || $stop == 'Puncture')
																					{
																						echo"<td style='background-color:red;text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}
																					else{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}
																				}
																				else if($status == "account" && $pastel == "")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																				}
																				else if($status == "account" && $pastel == "pastel")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/8.png'></td>";
																				}
																				else
																				{
																					if($stop == 'Diesel stop' || $stop == 'Vehicle check' || $stop == 'Vehicle breakdown' || $stop == 'Rest' || $stop == 'Puncture')
																					{
																						echo"<td style='background-color:red;text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/5.png'></td>";
																					}
																					else{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/5.png'></td>";
																					}
																				}
																				
																				
																				
																				if($response == "yes")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/accept.png'></td>";
																				}
																				else if($response == "no")
																				{
																					echo"<td style='text-align:center'><a data-toggle='modal' href='#myModal$count'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/reject.png'></a></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/pro_loading.gif'></td>";
																				}
																				
																				
																					
																				if($StringCount <= 33)
																				{
																					echo"<td style='text-align:center'><i class='fa fa-minus-circle'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><a target='blank' href='$link'><i class='fa fa-file'></i></a></td>";
																				}
																						
																				echo "	
																						<td>$row[WORK_ORDER_NUMBER]</td>
																						<td>$row[SHIPMENT_REFERENCE]</td>
																						<td>$row[IMPORT_REFERENCE]</td>
																						<td>$row[CONTAINER_NUMBER]</td>
																						<td>$row[BILL_CLIENT]</td>
																						<td>$row[CARGO_TYPE]</td>
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
																						<td>$row[TANKER_ALLOCATION]</td>
																						<td>$row[TANKER_ALLOCATION_2]</td>
																				";
																				
																				$driver_assigned = $row['DRIVER_ASSIGNED'];
																				$sql4="select * from controller_user where controller_user.REFERENCE_NUMBER='$driver_assigned'";
																				$result4=ExecuteQuery($sql4);
																				$row4 = mysqli_fetch_array($result4);
																				$driver_first_name = $row4['FIRST_NAME'];
																				$driver_surname = $row4['SURNAME'];
																				
																				echo"
																						<td>$driver_first_name $driver_surname</td>
																					</tr>
																				
																				";?>
																
																				<?php
																				
																					echo"
																						
																					
																					<!-- Modal -->
																					<div class='modal fade' id='myModal$count' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
																						  <div class='modal-dialog' role='document'>
																							<div class='modal-content'>
																							  <div class='modal-header'>
																								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
																								  <span aria-hidden='true'>&times;</span>
																								</button>
																								<h4 class='modal-title' id='myModalLabel'>Reject Reason</h4>
																							  </div>
																							  <div class='modal-body'>
																								<p>";?><?php echo"$reason<br><br>$rejected_by";?><?php echo"</p>
																								<hr style='height:5px;background-color:#008f4d'>
																								<form style='display:inline-block' action='con_assign-driver.php?id=$row[ID]' method='post'>
																									<div class='control-group'>
																										<div class='controls'>
																											
																											<select name='driver' required='required'>
																												<option value='' disabled selected hidden>Select driver</option>
																												<option value='' >N/A</option>";?>
																												<?php
																													$sql2="select * from controller_user where USER_TYPE='mobile' order by CREATED_AT";
																													$result2=ExecuteQuery($sql2);
																													
																													while($row2 = mysqli_fetch_array($result2))
																													{
																														echo"<option value='$row2[REFERENCE_NUMBER]'>$row2[FIRST_NAME] $row2[SURNAME]</option>";
																													}
																												?>
																												<?php echo"
																											</select>
																											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																											<button type='submit' class='btn btn-primary button-loading' data-loading-text='Loading...'>Assign This driver</button>
																											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																										</div>
																									</div>
																								</form>
																								
																							  </div>
																							  <div class='modal-footer'>
																								<button id='hidevideo' type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
																							  </div>
																							</div>
																						</div>
																					</div>
																					";
																				
																				$count++;
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
