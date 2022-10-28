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
   
   
   
</head>
<body>
<?php 
	
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
font-size: 16px;"> <a href="login.php" class="btn btn-primary square-btn-adjust">Login</a> </div>
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
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a class="active-menu" href="send-work-order.php"><i class="fa fa-sitemap"></i> Send Work Order</a>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
	
        <div id="page-wrapper" >
            <div id="page-inner">
				
						<div class="row">
							<div class="col-md-12">
							 <h2>Create Work Order</h2>   
								<br><br>
								<h5>Please check if your email is recorded</h5>
								
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<form action="email-check.php" method="POST">
									<table>
										<tr>
											<td style="width:350px;padding-right:10px">
												<input type="email" name="email" class="form-control" required="required">
											</td>
											<td>
												<button type="submit" class="btn btn-primary">Check Email</button>
											</td>
										<tr>
									</table>
								</form>
							</div>
						</div>
						
						 <!-- /. ROW  -->
						 <!-- <hr />--><br>
					 <?php
						if (isset ($_GET["act"]))
							if ($_GET["act"] == "invalid")
								echo "<br><h4 style='color:red;'>Your email is not in our records. Please call us on 031 000 0000 to place your work order</h4><br>";
									
					?>
						 
					<?php
						if (isset ($_GET["act"]))
							if ($_GET["act"] == "valid")
							{
								echo "<br><h4 style='color:green;'>Email check success. Please fill the form and send your work order</h4><br>";
								
								
								echo"
									 <div>
										<form action='send-work-orderH.php' method='POST' enctype='multipart/form-data'>
											<div class='row'>
												<div class='col-md-4 col-sm-12 col-xs-12'>
													<div class='form-group'>
														<table>
															<tr>
																<th>Attachment</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='file' name='attachment'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Shipment Reference</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='shipment_reference' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Import Reference</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='import_reference' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Bill Client</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='bill_client' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Job Detail</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='job_detail' class='form-control'></td>
															</tr>
															
														</table>	
													</div>
												</div>
												<div class='col-md-4 col-sm-12 col-xs-12'>
													<div class='form-group'>
														<table>
															<tr>
																<th>Product Type</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='product_type' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Quantity</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='quantity' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Tonnage</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='tonnage' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Pickup Point</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='pickup_point' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Pickup Date/Time</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='date' name='pickup_date_time' class='form-control'></td>
															</tr>
														</table>	
													</div>
												</div>
												<div class='col-md-4 col-sm-12 col-xs-12'>
													<div class='form-group'>
														<table>
															<tr>
																<th>Delivery Point 1</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='delivery_point1' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Delivery Point 2</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td><input type='text' name='delivery_point2' class='form-control'></td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Truck Allocation</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td>
																	<select name='truck_allocation' class='form-control'>
																		<option value='' disabled selected hidden>Please select truck</option>";
																		
																			$sql3="select * from truck order by CREATED_AT desc";
																			$result3=ExecuteQuery($sql3);
																			
																			while($row3 = mysqli_fetch_array($result3))
																			{
																				echo"<option value='$row3[VEHICLE_REG]'>$row3[VEHICLE_FLEET_NO] $row3[VEHICLE_MAKE]</option>";
																			}
																		
													 echo"			</select>
																</td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Trailer Allocation</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td>
																	<select name='trailer_allocation' class='form-control'>
																		<option value='' disabled selected hidden>Please select trailer</option>";
																		
																			$sql4="select * from trailer order by CREATED_AT desc";
																			$result4=ExecuteQuery($sql4);
																			
																			while($row4 = mysqli_fetch_array($result4))
																			{
																				echo"<option value='$row4[VEHICLE_REG]'>$row4[VEHICLE_MAKE]</option>";
																			}
																		
													 echo"			</select>
																</td>
															</tr>
															<tr style='height:10px'></tr>
															<tr>
																<th>Driver Assigned</th>
																<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
																<td>
																	<select name='driver_assigned' class='form-control'>
																		<option value='' disabled selected hidden>Please select driver</option>";
																		
																			$sql2="select * from controller_user where controller_user.USER_TYPE='mobile' order by CREATED_AT desc";
																			$result2=ExecuteQuery($sql2);
																			
																			while($row2 = mysqli_fetch_array($result2))
																			{
																				echo"<option value='$row2[REFERENCE_NUMBER]'>$row2[FIRST_NAME] $row2[SURNAME]</option>";
																			}
																		
													 echo"			</select>
																</td>
															</tr>
														</table>	
													</div>
												</div>
												</div>
												<br><br><br>
												<div align='right'>
													<button type='submit' class='btn btn-primary' disabled>Create Work Order</button>
												</div>
											</form>
									</div>";
								
								
							}
					 ?>
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
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	
	
	<script>
		$(window).load(function(){ 
		 //PAGE IS FULLY LOADED 
		 //FADE OUT YOUR OVERLAYING DIV
		 $('#overlay').fadeOut();
		});
	</script>
   
</body>
</html>