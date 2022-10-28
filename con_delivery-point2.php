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
							 <h2>Manage Second Delivery Point</h2>
								<div align="right">
									<input type="button" value="Refresh" onClick="window.location.reload()">
									<!--<button onclick="myFunction()">Print this page</button>-->
								</div>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>New Client has been created</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to create new client. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2valid")
											echo "<h4 style='color:green;'>New Delivery Point 2 has been created</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2invalid")
											echo "<h4 style='color:red;'>Failed to create new delivery point 2. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "pickupdelete")
											echo "<h4 style='color:green;'>Pickup Point has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "pickupdeletefail")
											echo "<h4 style='color:green;'>Failed to delete pickup point. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery1delete")
											echo "<h4 style='color:green;'>Delivery Point 1 has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery1deletefail")
											echo "<h4 style='color:red;'>Failed to delete delivery point 2. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "clientdelete")
											echo "<h4 style='color:green;'>Client has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "clientdeletefail")
											echo "<h4 style='color:green;'>Failed to delete client. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery1valid")
											echo "<h4 style='color:green;'>Delivery Point 1 has been created</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery1invalid")
											echo "<h4 style='color:red;'>Failed to create delivery point 1. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2delete")
											echo "<h4 style='color:green;'>Delivery Point 2 has been deleted</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2deletefail")
											echo "<h4 style='color:red;'>Failed to delete delivery point 2. Please try again...</h4>";
												
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
											<li class="active"><a href="#delivery2-list" data-toggle="tab">Delivery Point 2 List</a>
											</li>
											<li class=""><a href="#delivery2" data-toggle="tab">Create Delivery Point 2</a>
											</li>
											
										</ul>

										<div class="tab-content">
											
											<div class="tab-pane fade" id="delivery2">
												<br>
												
												<br>
												<div class="col-md-4 col-sm-12 col-xs-12">
													<form action="con_delivery-point2H.php" method="POST">
														<div class="form-group">
															<input type="text" name="offload_point" class="form-control" placeholder="Offload Point" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="postal" class="form-control" placeholder="Postal Code" onkeypress='validate(event)' required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="name" class="form-control" placeholder="Customer Name" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="contact" class="form-control" placeholder="Contact Person" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="phone" class="form-control" placeholder="Phone Number" onkeypress='validate(event)' required="required"/>
														</div>
														<div class="form-group">
															<input type="email" name="email" class="form-control" placeholder="Email Address" required="required"/>
														</div>
														<br>
														<div>
															<button type="submit" class="btn btn-primary">Create New Delivery Point 2</button>
														</div>
													</form>
												</div>
											</div>
											<div class="tab-pane fade active in" id="delivery2-list">
												<br>
												
												<!-- Advanced Tables -->
												<div>
													<div class="panel panel-default">
														<!--<div class="panel-heading">
															 
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
														</div>-->
														<div id="buttons"></div>
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example3">
																	<?php
																		$sql3="select * from delivery_two order by CREATED_AT desc";
																		$result3=ExecuteQuery($sql3);
																	?>
																	<thead>
																		<tr>
																			<th style="width:150px;">Offload Point</th>
																			<th style="width:50px;">Postal Code</th>
																			<th style="width:90px;">Customer Name</th>
																			<th style="width:100px;">Contact Person</th>
																			<th style="width:70px;">Phone Number</th>
																			<th style="width:200px;">Email Address</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row3 = mysqli_fetch_array($result3))
																			{
																				echo "
																					<tr>
																						
																						<td>$row3[OFFLOAD_POINT]</td>
																						<td>$row3[POSTAL_CODE]</td>
																						<td>$row3[CUSTOMER_NAME]</td>
																						<td>$row3[CONTACT_PERSON]</td>
																						<td>$row3[PHONE]</td>
																						<td>$row3[EMAIL]</td>
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
	<script>
            $(document).ready(function () {
                $('#dataTables-example4').dataTable();
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
