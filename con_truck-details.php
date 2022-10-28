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
?>
<?php

	$id = $_GET['id'];

?>
<?php
	$sql="select * from truck where truck.ID=$id";
	$result=ExecuteQuery($sql);
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		$vehicle_reg = $row['VEHICLE_REG'];
		$vehicle_fleet_no = $row['VEHICLE_FLEET_NO'];
		$vehicle_make = $row['VEHICLE_MAKE'];
		$vin_no = $row['VIN_NO'];
		$expiry_date = $row['EXPIRY_DATE'];
		$model_year = $row['MODEL_YEAR'];
	}
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
                        <a href="con_home.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a href="con_work-orders.php"><i class="fa fa-sitemap"></i> Work Orders</a>
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
                        <a href="con_manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
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
                        <a class="active-menu" href="con_manage-vehicle.php"><i class="fa fa-sitemap"></i> Manage Vehicles</a>
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
							 <h2>Truck Details</h2>   
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>Truck $vehicle_fleet_no has been updated</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to update truck $vehicle_fleet_no. Please try again...</h4>";
												
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
											<li class="active"><a href="#truck-view" data-toggle="tab">Truck Detail View</a>
											</li>
											<li class=""><a href="#truck-edit" data-toggle="tab">Edit Truck Details</a>
											</li>
											<!--<li class=""><a href="#messages" data-toggle="tab">Messages</a>
											</li>
											<li class=""><a href="#settings" data-toggle="tab">Settings</a>
											</li>-->
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade active in" id="truck-view">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<?php
														
														echo "
															<table>
																<tr>
																	<th>Vehicle Reg</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$vehicle_reg</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Vehicle Fleet No</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$vehicle_fleet_no</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Vehicle Make</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$vehicle_make</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Vin No</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$vin_no</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Expiry Date</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$expiry_date</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Model Year</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$model_year</td>
																</tr>
															</table>
														
														";
													?>
												</div>
											</div>
											<div class="tab-pane fade" id="truck-edit">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<form action="<?php echo"con_truck-detailsH.php?id=$id";?>" method="POST">
														<div class="form-group">
															<label>Vehicle Reg</label>
															<input type="text" name="vehicle_reg" class="form-control" value="<?php echo"$vehicle_reg"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Vehicle Fleet No</label>
															<input type="text" name="vehicle_fleet_no" class="form-control" value="<?php echo"$vehicle_fleet_no"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Vehicle Make</label>
															<input type="text" name="vehicle_make" class="form-control" value="<?php echo"$vehicle_make"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Vin No</label>
															<input type="text" name="vin_no" class="form-control" value="<?php echo"$vin_no"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Expiry Date</label>
															<div id="sandbox-container"><input name="expiry_date" type="text" class="form-control" value="<?php echo"$expiry_date"; ?>"/></div>
														</div>
														<br>
														<div class="form-group">
															<label>Model Year</label>
															<input type="text" name="model_year" class="form-control" value="<?php echo"$model_year"; ?>" onkeypress='validate(event)'/>
														</div>
														<br>
														<div>
															<button type="submit" class="btn btn-primary">Update This Truck</button>
														</div>
													</form>
												</div>
											</div>
											<!--<div class="tab-pane fade" id="messages">
												<h4>Messages Tab</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											</div>
											<div class="tab-pane fade" id="settings">
												<h4>Settings Tab</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
	<script src="datepicker/bootstrap-datepicker.js"></script>
	<script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
	<!--<script>
            $(document).ready(function () {
                var table = $('#dataTables-example').dataTable({
					lengthChange: false,
					buttons: ['copy','excel','pdf']
				});
				table.buttons().container().appendTo('#dataTables-example_wrapper .col-sm-6:eq(0)')
            });
    </script>-->
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
