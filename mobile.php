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
	
	if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='admin'))
	{
		header("location: index.php");
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
							 <h2>Mobile Users</h2>
								<div align="right">
									<input type="button" value="Refresh" onClick="window.location.reload()">
									<!--<button onclick="myFunction()">Print this page</button>-->
								</div>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>New Controller has been created</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to create new controller. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "mobilevalid")
											echo "<h4 style='color:green;'>New Mobile User has been created</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "moblileinvalid")
											echo "<h4 style='color:red;'>Failed to create new mobile user. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delete")
											echo "<h4 style='color:green;'>Controller has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "deletefail")
											echo "<h4 style='color:green;'>Failed to delete controller. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "duplicate")
											echo "<h4 style='color:red;'>Email already in use</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "mobiledelete")
											echo "<h4 style='color:green;'>Driver has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "mobiledeletefail")
											echo "<h4 style='color:green;'>Failed to delete driver. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "adminvalid")
											echo "<h4 style='color:green;'>Administrator created</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "admininvalid")
											echo "<h4 style='color:red;'>Failed to create administrator. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "admindelete")
											echo "<h4 style='color:green;'>Administrator deleted</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "admindeletefail")
											echo "<h4 style='color:red;'>Failed to delete administrator. Please try again...</h4>";
												
								?>
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-default">
									
									<div class="panel-body">
										<ul class="nav nav-pills">
											<li class="active"><a href="#mobile-list" data-toggle="tab">Mobile User List</a>
											</li>
											<li class=""><a href="#mobile" data-toggle="tab">Create Mobile User</a>
											</li>
										</ul>

										<div class="tab-content">
											
											<div class="tab-pane fade" id="mobile">
												<br>
												
												<br>
												<div class="col-md-4 col-sm-12 col-xs-12">
													<form action="manage-mobile-userH.php" method="POST">
														<div class="form-group">
															<input type="text" name="fn" class="form-control" placeholder="First Name" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="surname" class="form-control" placeholder="Surname" required="required"/>
														</div>
														<div class="form-group">
															<input type="email" name="email" class="form-control" placeholder="Email Address" required="required"/>
														</div>
														<div class="form-group">
															<input type="password" name="password" class="form-control" placeholder="Password" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="phone" class="form-control" placeholder="Phone Number" onkeypress='validate(event)' required="required"/>
														</div>
														
														<br>
														<div>
															<button type="submit" class="btn btn-primary">Create New Mobile User</button>
														</div>
													</form>
												</div>
												
											</div>
											<div class="tab-pane fade active in" id="mobile-list">
												<br>
												
												<!-- Advanced Tables -->
												<div>
													<div class="panel panel-default">
														<div class="panel-heading">
															 <!--<i class="fa fa-asterisk"></i>&nbsp;<b>Manage Work Orders</b>-->
															 <form action="export-mobile.php" method="post" name="export_excel">
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
														</div>
														<div id="buttons"></div>
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example2">
																	<?php
																		$sql2="select * from controller_user where controller_user.USER_TYPE='mobile' order by CREATED_AT desc";
																		$result2=ExecuteQuery($sql2);
																	?>
																	<thead>
																		<tr>
																			<th style="width:10px;"></th>
																			<th style="width:10px;"></th>
																			<th style="width:70px;">Mobile User ID</th>
																			<th style="width:70px;">First Name</th>
																			<th style="width:70px;">Surname</th>
																			<th style="width:100px;">Email Address</th>
																			<th style="width:70px;">Phone Number</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row2 = mysqli_fetch_array($result2))
																			{
																				echo "
																					<tr>
																						<td><a href='mobile-delete.php?id=$row2[ID]' ";?> onclick="return confirm('Delete driver <?php echo"$row2[FIRST_NAME] $row2[SURNAME]"; ?>?')"<?php echo"><i class='fa fa-trash-o' style='font-size:20px;color:red'></i></a></td>
																						<td><a href='mobile-details.php?id=$row2[ID]' ><i class='fa fa-eye' style='font-size:20px'></i></a></td>
																						<td>$row2[REFERENCE_NUMBER]</td>
																						<td>$row2[FIRST_NAME]</td>
																						<td>$row2[SURNAME]</td>
																						<td>$row2[EMAIL]</td>
																						<td>$row2[PHONE]</td>
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
												<!--End Advanced Tables -->
												
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
	<script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
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
		function confirmDelete(){
			var agree = confirm("Do you really want to delete this controller?");
			if (agree)
				return true;
			else
				return false;
		}
	</script>
	
	
</html>
