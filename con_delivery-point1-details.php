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
	
	<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css" rel="stylesheet"/>
   
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
	$sql="select * from delivery_one where delivery_one.ID=$id";
	$result=ExecuteQuery($sql);
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		$company = $row['COMPANY'];
		$offload_point = $row['OFFLOAD_POINT'];
		$suburb = $row['SUBURB'];
		$postal_code = $row['POSTAL_CODE'];
		$first_name = $row['FIRST_NAME'];
		$surname = $row['SURNAME'];
		$phone = $row['PHONE'];
		$email = $row['EMAIL'];
		$cargo_type = $row['CARGO_TYPE'];
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
					<div style="color:#fff; margin-bottom:25px">Created by <a href="https://rolandoy.com" target="_blank">Roland</a> &copy; <?php echo date('Y') ?></div>
					</li>
				
					
                    <!--<li>
                        <a href="ahome.php"><i class="fa fa-home"></i> Home</a>
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
                        <a class="active-menu" href="con_manage-client.php"><i class="fa fa-sitemap"></i> Manage Client & Destination</a>
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
							 <h2>Delivery Point Details</h2>   
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>Delivery Point has been updated</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to update delivery point. Please try again...</h4>";
												
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
											<li class="active"><a href="#client-view" data-toggle="tab">Delivery Point Detail View</a>
											</li>
											<li class=""><a href="#client-edit" data-toggle="tab">Edit Delivery Point</a>
											</li>
											<!--<li class=""><a href="#messages" data-toggle="tab">Messages</a>
											</li>
											<li class=""><a href="#settings" data-toggle="tab">Settings</a>
											</li>-->
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade active in" id="client-view">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<?php
														
														echo "
															<table>
																<tr>
																	<th>Client Name</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$company</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Offload Point</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$offload_point</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Suburb</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$suburb</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Postal Code</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$postal_code</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>First Name</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$first_name</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Surname</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$surname</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Phone</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$phone</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Email</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$email</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Cargo Type</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;";if($cargo_type == 'Both'){echo"Bulk & Packed";} else{ echo"$cargo_type";} echo"</td>
																</tr>
															</table>
														
														";
													?>
													<br>
												</div>
												
											</div>
											<div class="tab-pane fade" id="client-edit">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<form action="<?php echo"con_delivery-point1-detailsH.php?id=$id";?>" method="POST">
														<div class="form-group">
															<label>Client Name</label>
															<select name="company" class="form-control" required="required">
																<option value="<?php echo"$company"; ?>"><?php echo"$company"; ?></option>
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
														<div class="form-group">
															<label>Offload Point</label>
															<input type="text" name="offload_point" class="form-control" value="<?php echo"$offload_point"; ?>"/>
														</div>
														<div class="form-group">
															<label>Suburb</label>
															<input type="text" name="suburb" class="form-control" value="<?php echo"$suburb"; ?>"/>
														</div>
														<div class="form-group">
															<label>Postal Code</label>
															<input type="text" name="postal_code" class="form-control" value="<?php echo"$postal_code"; ?>" onkeypress='validate(event)'/>
														</div>
														<div class="form-group">
															<label>First Name</label>
															<input type="text" name="first_name" class="form-control" value="<?php echo"$first_name"; ?>"/>
														</div>
														<div class="form-group">
															<label>Surname</label>
															<input type="text" name="surname" class="form-control" value="<?php echo"$surname"; ?>"/>
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phone" class="form-control" value="<?php echo"$phone"; ?>" onkeypress='validate(event)'/>
														</div>
														<div class="form-group">
															<label>Email Address</label>
															<input type="email" name="email" class="form-control" value="<?php echo"$email"; ?>"/>
														</div>
														<div class="form-group">
															<label>Cargo Type</label>
															<select name="cargo_type" class="form-control" required="required">
																<option value="<?php echo"$cargo_type"; ?>"><?php if($cargo_type == 'Both'){echo"Bulk & Packed";} else{ echo"$cargo_type";} ?></option>
																<option value="Bulk" >Bulk</option>
																<option value="Packed" >Packed</option>
																<option value="Both" >Bulk & Packed</option>
															</select>
														</div>
														
														<br>
														<div>
															<button type="submit" class="btn btn-primary">Update This Delivery Point</button>
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
	
	
	
</html>
