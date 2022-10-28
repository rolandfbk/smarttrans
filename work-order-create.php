<?php ob_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT"/> 
	<meta http-equiv="pragma" content="no-cache" />
	
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
	
	if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='admin'))
	{
		header("location: index.php");
	}
	
	$client = $_GET['client'];
	$type = $_GET['type'];
	
	if($client == "H")
	{
		$client = "H&R";
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
                        <a class="active-menu" href="work-orders.php"><i class="fa fa-sitemap"></i> Work Orders</a>
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
                        <a  href="manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
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
							 <h2>Create Work Order</h2>
								<div align="right">
									
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
										if ($_GET["act"] == "workorderdelete")
											echo "<h4 style='color:green;'>Work Order $orderNumber has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "workorderdeletefail")
											echo "<h4 style='color:red;'>Failed to delete Work Order $orderNumber. Please try again...</h4>";
												
								?>
								
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								
											
							<br>
							<form action="create-work-orderH.php?<?php echo"tp=$type&cl=$client";?>" method="POST" enctype="multipart/form-data">
							<div class="row">
									<div class="col-md-3 col-sm-12 col-xs-12">
										<div class="form-group">
											<div class="form-group">
												<label>Attachment</label>
												<input type="file" name="attachment" class="form-control">
											</div>
											<div class="form-group">
												<label>Shipment Reference</label>
												<input type="text" name="shipment_reference" class="form-control">
											</div>
											<div class="form-group">
												<label>Import Reference</label>
												<input type="text" name="import_reference" class="form-control">
											</div>
											<?php if($type == 'Packed') 
												{
													echo"
														<div class='form-group'>
															<label>Container Number</label>
															<input type='text' name='container_number' class='form-control'>
														</div>
													
													";
												}
											?>
											
											
											<div class="form-group">
												<label>Bill Client</label>
												<input type="text" name="bill_client" class="form-control" value="<?php echo"$client";?>" disabled>
											</div>
											
										</div>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12">
										<div class="form-group">
											<div class="form-group">
												<label>Product Type</label>
												<input list="browsers" name="product_type" class="form-control">
													<datalist id="browsers">
														<?php
															$sql6="select * from product_type order by PRODUCT_NAME";
															$result6=ExecuteQuery($sql6);
															
															while($row6 = mysqli_fetch_array($result6))
															{
																echo"<option value='$row6[PRODUCT_NAME]'>$row6[PRODUCT_NAME]</option>";
															}
														?>
													</datalist>
												</select>
											</div>
											<div class="form-group">
												<label>Quantity (Litre)</label>
												<input type="text" name="quantity" class="form-control" onkeypress='validate(event)'>
											</div>
											<div class="form-group">
												<label>Tonnage (Weight)</label>
												<input type="text" name="tonnage" class="form-control" onkeypress='validate(event)'>
											</div>
											<div class="form-group">
												<label>Pickup Point</label>
												<select name="pickup_point" class="form-control">
													<option value="" disabled selected hidden>Select pickup point</option>
													<option value="" >N/A</option>
													<?php
														$sql11="select * from pickup_point order by CUSTOMER_NAME";
														$result11=ExecuteQuery($sql11);
														
														while($row11 = mysqli_fetch_array($result11))
														{
															echo"<option value='$row11[CUSTOMER_NAME], $row11[OFFLOAD_POINT]'>$row11[CUSTOMER_NAME], $row11[OFFLOAD_POINT]</option>";
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
												<div id="sandbox-container"><input name="pickup_date" type="text" class="form-control" placeholder="Click to set date" /></div>
											</div>
											<div class="form-group">
												<label>Pickup Time &nbsp;&nbsp;<!--<button type="button" id="button-b">Set time</button>-->&nbsp;<!--<button type="button" id="button-a">Check the  minutes </button>--></label>
												<input type="time" id="input-a" value="" data-default="20:48" name="pickup_time" class="form-control">
											</div>
											<div class="form-group">
												<label>Delivery Point 1</label>
												<select name="delivery_point1" class="form-control">
													<option value="" disabled selected hidden>Select delivery point</option>
													<option value="" >N/A</option>
													<?php
														$sql7="select * from delivery_one where COMPANY='$client' AND (CARGO_TYPE='$type' OR CARGO_TYPE='Both')";
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
													<option value="" disabled selected hidden>Select delivery point</option>
													<option value="" >N/A</option>
													<?php
														$sql8="select * from delivery_one where COMPANY='$client' AND (CARGO_TYPE='$type' OR CARGO_TYPE='Both')";
														$result8=ExecuteQuery($sql8);
														
														while($row8 = mysqli_fetch_array($result8))
														{
															echo"<option value='$row8[OFFLOAD_POINT], $row8[SUBURB]'>$row8[OFFLOAD_POINT], $row8[SUBURB]</option>";
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
												<select name="truck_allocation" class="form-control">
													<option value="" disabled selected hidden>Select truck</option>
													<option value="" >N/A</option>
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
										<?php if ($type == 'Packed') 
												{
										?>
											<div class="form-group">
												<label>Trailer Allocation 1</label>
												<select name="trailer_allocation" class="form-control">
													<option value="" disabled selected hidden>Select trailer</option>
													<option value="" >N/A</option>
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
													<option value="" disabled selected hidden>Select trailer</option>
													<option value="" >N/A</option>
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
										<?php }
												else{
										?>
											<div class="form-group">
												<label>Tanker Allocation 1</label>
												<select name="tanker_allocation" class="form-control">
													<option value="" disabled selected hidden>Select tanker</option>
													<option value="" >N/A</option>
													<?php
														$sql12="select * from tanker where tanker.STATUS='' order by VEHICLE_REG";
														$result12=ExecuteQuery($sql12);
														
														while($row12 = mysqli_fetch_array($result12))
														{
															echo"<option value='$row12[VEHICLE_REG]'>$row12[VEHICLE_REG] - $row12[VEHICLE_MAKE]</option>";
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Tanker Allocation 2</label>
												<select name="tanker_allocation2" class="form-control">
													<option value="" disabled selected hidden>Select tanker</option>
													<option value="" >N/A</option>
													<?php
														$sql13="select * from tanker_2 where tanker_2.STATUS='' order by VEHICLE_REG";
														$result13=ExecuteQuery($sql13);
														
														while($row13 = mysqli_fetch_array($result13))
														{
															echo"<option value='$row13[VEHICLE_REG]'>$row13[VEHICLE_REG] - $row13[VEHICLE_MAKE]</option>";
														}
													?>
												</select>
											</div>
										<?php }?>
											<div class="form-group">
												<label>Driver Assigned</label>
												<select name="driver_assigned" class="form-control">
													<option value="" disabled selected hidden>Select driver</option>
													<option value="" >N/A</option>
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
								<br><br>
								<div align="right">
									<button type="submit" class="btn btn-primary">Create Work Order</button>
								</div>
							</form>
							
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
