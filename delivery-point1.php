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
                        <a href="manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
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
                        <a class="active-menu" href="manage-client.php"><i class="fa fa-sitemap"></i> Manage Client & Destination</a>
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
							 <h2>Manage Delivery Point</h2>
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
											echo "<h4 style='color:green;'>New Delivery Point has been created</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2invalid")
											echo "<h4 style='color:red;'>Failed to create new delivery point. Please try again...</h4>";
												
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
											echo "<h4 style='color:green;'>Delivery Point has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery1deletefail")
											echo "<h4 style='color:red;'>Failed to delete delivery point. Please try again...</h4>";
												
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
											echo "<h4 style='color:green;'>Delivery Point has been created</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery1invalid")
											echo "<h4 style='color:red;'>Failed to create delivery point. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2delete")
											echo "<h4 style='color:green;'>Delivery Point has been deleted</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delivery2deletefail")
											echo "<h4 style='color:red;'>Failed to delete delivery point. Please try again...</h4>";
												
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
											<li class="active"><a href="#delivery1-list" data-toggle="tab">Delivery Point List</a>
											</li>
											<li class=""><a href="#delivery1" data-toggle="tab">Create Delivery Point</a>
											</li>
											
										</ul>

										<div class="tab-content">
											
											<div class="tab-pane fade" id="delivery1">
												<br>
												
												<br>
												<div class="col-md-4 col-sm-12 col-xs-12">
													<form action="delivery-point1H.php" method="POST">
														<div class="form-group">
															<select name="company" class="form-control" required="required">
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
														<div class="form-group">
															<input type="text" name="offload_point" class="form-control" placeholder="Offload Point" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="suburb" class="form-control" placeholder="Suburb" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="postal" class="form-control" placeholder="Postal Code" onkeypress='validate(event)' required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="fn" class="form-control" placeholder="First Name" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="surname" class="form-control" placeholder="Surname" required="required"/>
														</div>
														<div class="form-group">
															<input type="text" name="phone" class="form-control" placeholder="Phone Number" onkeypress='validate(event)' required="required"/>
														</div>
														<div class="form-group">
															<input type="email" name="email" class="form-control" placeholder="Email Address" required="required"/>
														</div>
														<div class="form-group">
															<select name="cargo_type" class="form-control" required="required">
																<option value="" disabled selected hidden>Please select cargo type</option>
																<option value="Bulk" >Bulk</option>
																<option value="Packed" >Packed</option>
																<option value="Both" >Bulk & Packed</option>
															</select>
														</div>
														<br>
														<div>
															<button type="submit" class="btn btn-primary">Create New Delivery Point</button>
														</div>
													</form>
												</div>
											</div>
											<div class="tab-pane fade active in" id="delivery1-list">
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
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example4">
																	<?php
																		$sql4="select * from delivery_one order by CREATED_AT desc";
																		$result4=ExecuteQuery($sql4);
																	?>
																	<thead>
																		<tr>
																			<th style="width:10px;"></th>
																			<th style="width:10px;"></th>
																			<th style="width:150px;">Offload Point</th>
																			<th style="width:100px;">Suburb</th>
																			<th style="width:50px;">Postal Code</th>
																			<th style="width:100px;">First Name</th>
																			<th style="width:100px;">Surname</th>
																			<th style="width:70px;">Phone Number</th>
																			<th style="width:200px;">Email Address</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row4 = mysqli_fetch_array($result4))
																			{
																				echo "
																					<tr>
																						<td><a href='delivery1-delete.php?id=$row4[ID]' ";?> onclick="return confirm('Delete delivery point 1?')"<?php echo"><i class='fa fa-trash-o' style='font-size:20px;color:red'></i></a></td>
																						<td><a href='delivery-point1-details.php?id=$row4[ID]' ><i class='fa fa-eye' style='font-size:20px'></i></a></td>
																						<td>$row4[OFFLOAD_POINT]</td>
																						<td>$row4[SUBURB]</td>
																						<td>$row4[POSTAL_CODE]</td>
																						<td>$row4[FIRST_NAME]</td>
																						<td>$row4[SURNAME]</td>
																						<td>$row4[PHONE]</td>
																						<td>$row4[EMAIL]</td>
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
