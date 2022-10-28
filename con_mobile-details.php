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
	
	
	$locations=array(); 
		
		$time = date("Y-m-d");
		
		$sql1="SELECT * FROM gps where NAME='$reference_number' and DATE='$time'";
		$result1=ExecuteQuery($sql1);
		if (mysqli_num_rows($result1)==0)
		{
			$name = $first_name." ".$surname;
			$longitude = "30.9114453";                              
			$latitude = "-29.9221461";
			$link="Driver has not moved today";
			/* Each row is added as a new array */
			$locations[]=array( 'name'=>$name, 'lat'=>$latitude, 'lng'=>$longitude, 'lnk'=>$link );
		}
		else{

			while( $row1 = mysqli_fetch_array($result1) ){
				$name = $row1['NAME'];
				$longitude = $row1['LONGTITUDE'];                              
				$latitude = $row1['LATITUDE'];
				$link=$row1['CREATED_AT'];
				/* Each row is added as a new array */
				$locations[]=array( 'name'=>$name, 'lat'=>$latitude, 'lng'=>$longitude, 'lnk'=>$link );
			}
		}
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBZdkLaUsqBOemyPAVmBpYGB0dyqs0jWEI&callback=initMap"></script> 
    <script type="text/javascript">
    var map;
    var Markers = {};
    var infowindow;
    var locations = [
        <?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
        [
            'AMC Service',
            //'<p><?php echo"$first_name $surname";?></p>',
			'<p><?php echo $locations[$i]['lnk'];?></p>',
            <?php echo $locations[$i]['lat'];?>,
            <?php echo $locations[$i]['lng'];?>,
            0
        ]<?php if($j!=sizeof($locations))echo ","; }?>
    ];
    var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);

    function initialize() {
      var mapOptions = {
        zoom: 9,
        center: origin
      };

      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        infowindow = new google.maps.InfoWindow();

        for(i=0; i<locations.length; i++) {
            var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
            var marker = new google.maps.Marker({
                position: position,
                map: map,
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][1]);
                    infowindow.setOptions({maxWidth: 200});
                    infowindow.open(map, marker);
                }
            }) (marker, i));
            Markers[locations[i][4]] = marker;
        }

        locate(0);

    }

    function locate(marker_id) {
        var myMarker = Markers[marker_id];
        var markerPosition = myMarker.getPosition();
        map.setCenter(markerPosition);
        google.maps.event.trigger(myMarker, 'click');
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    </script>

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
                        <a  class="active-menu" href="con_manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
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
							 <h2>Mobile User Details</h2>   
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>Mobile User $reference_number has been updated</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to update mobile user $reference_number. Please try again...</h4>";
												
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
											<li class="active"><a href="#mobile-view" data-toggle="tab">Mobile User Detail View</a>
											</li>
											<li class=""><a href="#mobile-edit" data-toggle="tab">Edit Mobile User</a>
											</li>
											<li class=""><a href="#user-map" data-toggle="tab">Mobile User Map</a>
											</li>
											<!--<li class=""><a href="#settings" data-toggle="tab">Settings</a>
											</li>-->
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade active in" id="mobile-view">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<?php
														
														echo "
															<table>
																<tr>
																	<th>Mobile User ID</th>
																	<td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$reference_number</td>
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
													<?php
														$sql7="select * from work_order where work_order.DRIVER_ASSIGNED='$reference_number' and (work_order.STATUS='created' or work_order.STATUS='pickedup')";
														$result7=ExecuteQuery($sql7);
														
														$count = mysqli_num_rows($result7);
														
														if(mysqli_num_rows($result7)>=1)
														{
															echo"<button type='submit' class='btn btn-success' disabled>$count Job Assigned To This Driver</button>";
														}
														else
														{
															echo"<button type='submit' class='btn btn-danger' disabled>No Job Assigned To This Driver</button>";
														}
													?>
												</div>
												
											</div>
											<div class="tab-pane fade" id="mobile-edit">
												<br>
												
												<br>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<form action="<?php echo"con_mobile-detailsH.php?id=$id";?>" method="POST">
														<div class="form-group">
															<label>Mobile User ID</label>
															<input type="text" name="reference_number" class="form-control" value="<?php echo"$reference_number"; ?>" disabled />
														</div>
														<br>
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
											<div class="tab-pane fade" id="user-map">
												<br>
													
													
												
												<br>
												<div id="map-canvas" style="width:100%;height:500px"></div>
												
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
