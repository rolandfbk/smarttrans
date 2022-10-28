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
	
	if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='admin'))
	{
		header("location: index.php");
	}
?>
<?php

	$id = $_GET['id'];

?>
<?php
	$sql="select * from controller_user where controller_user.ID=$id";
	$result=ExecuteQuery($sql);
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		$reference_number = $row['REFERENCE_NUMBER'];
		$first_name = $row['FIRST_NAME'];
		$surname = $row['SURNAME'];
		$email = $row['EMAIL'];
		$phone = $row['PHONE'];
		$company_name = $row['COMPANY_NAME'];
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
                        <a href="ahome.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a href="work-orders.php"><i class="fa fa-sitemap"></i> Work Orders</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="work-order-client.php">Create Work Order</a>
                            </li>
                            <li>
                                <a href="work-order-manage.php">Manage Work Order</a>
                            </li>
							<li>
                                <a href="work-order-pickup.php">Picked Up Work Order</a>
                            </li>
                            <li>
                                <a href="work-order-delivered.php">Delivered Work Order</a>
                            </li>
							<li>
                                <a href="work-order-search.php">Search Work Order</a>
                            </li>
						</ul>
                    </li>
					<li>
                        <a  class="active-menu" href="manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="administrator.php">Administrator</a>
                            </li>
							<li>
                                <a href="account-user.php">AC user</a>
                            </li>
                            <li>
                                <a href="controller.php">Controller</a>
                            </li>
							<li>
                                <a href="mobile.php">Mobile User</a>
                            </li>
						</ul>
                    </li>
					
					<li>
                        <a  href="manage-product.php"><i class="fa fa-sitemap"></i> Manage Products</a>
                    </li>
					
					<li>
                        <a href="manage-vehicle.php"><i class="fa fa-sitemap"></i> Manage Vehicles</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="truck.php">Truck</a>
                            </li>
                            <li>
                                <a href="trailer.php">First Trailer</a>
                            </li>
							<li>
                                <a href="trailer2.php">Second Trailer</a>
                            </li>
                            <li>
                                <a href="tanker.php">First Tanker</a>
                            </li>
							<li>
                                <a href="tanker2.php">Second Tanker</a>
                            </li>
                            <li>
                                <a href="asset-check.php">Assets Check</a>
                            </li>
						</ul>
                    </li>
					<li>
                        <a href="manage-client.php"><i class="fa fa-sitemap"></i> Manage Clients & Destinations</a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="client.php">Clients</a>
                            </li>
                            <li>
                                <a href="pickup-point.php">Pickup Point</a>
                            </li>
							<li>
                                <a href="delivery-point1.php">Delivery Point</a>
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
							 <h2>Administrator User Details</h2>   
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>Administrator has been updated</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to update administrator. Please try again...</h4>";
												
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
											<li class="active"><a href="#admin-view" data-toggle="tab">Administrator User Details View</a>
											</li>
											<li class=""><a href="#admin-edit" data-toggle="tab">Edit Administrator User</a>
											</li>
											<!--<li class=""><a href="#messages" data-toggle="tab">Messages</a>
											</li>
											<li class=""><a href="#settings" data-toggle="tab">Settings</a>
											</li>-->
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade active in" id="admin-view">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<?php
														
														echo "
															<table>
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
																	<th>Email Address</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$email</td>
																</tr>
																<tr style='height:10px'></tr>
																<tr>
																	<th>Phone Number</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$phone</td>
																</tr>
															</table>
														
														";
													?>
													<br>
												</div>
												
											</div>
											<div class="tab-pane fade" id="admin-edit">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<form action="<?php echo"admin-detailsH.php?id=$id";?>" method="POST">
														
														<div class="form-group">
															<label>First Name</label>
															<input type="text" name="fn" class="form-control" value="<?php echo"$first_name"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Surname</label>
															<input type="text" name="surname" class="form-control" value="<?php echo"$surname"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Email Address</label>
															<input type="email" name="email" class="form-control" value="<?php echo"$email"; ?>" />
														</div>
														<br>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phone" class="form-control" value="<?php echo"$phone"; ?>" onkeypress='validate(event)'/>
														</div>
														<br>
														<div class="form-group">
															<label style='color:red;'>Password</label>
															<input type="text" name="company" class="form-control" placeholder="Type here only if necessary"/>
														</div>
														<br>
														<div>
															<button type="submit" class="btn btn-primary">Update This Mobile User</button>
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
