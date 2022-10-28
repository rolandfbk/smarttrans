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
	
	$tab = $_GET['tab'];
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
							 <h2>Manage Assets</h2>   
								<div align="right">
									<input type="button" value="Refresh" onClick="window.location.reload()">
									<!--<button onclick="myFunction()">Print this page</button>-->
								</div>
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "valid")
											echo "<h4 style='color:green;'>New Truck has been added</h4>";
												
								?>
							
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "invalid")
											echo "<h4 style='color:red;'>Failed to add new truck. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "trailervalid")
											echo "<h4 style='color:green;'>New Trailer has been added</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "trailerinvalid")
											echo "<h4 style='color:red;'>Failed to add new trailer. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delete")
											echo "<h4 style='color:green;'>Trailer has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "deletefail")
											echo "<h4 style='color:green;'>Failed to delete trailer. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "trailer2valid")
											echo "<h4 style='color:green;'>New Second Trailer has been added</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "trailer2invalid")
											echo "<h4 style='color:red;'>Failed to add new second trailer. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delete2")
											echo "<h4 style='color:green;'>Second Trailer has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "delete2fail")
											echo "<h4 style='color:green;'>Failed to delete second trailer. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "duplicate")
											echo "<h4 style='color:red;'>Vehicle registration already in use</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "truckdelete")
											echo "<h4 style='color:green;'>Driver has been deleted</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "truckdeletefail")
											echo "<h4 style='color:green;'>Failed to delete driver. Please try again...</h4>";
												
								?>
								
								<?php
									if (isset ($_GET["act"]))
										if ($_GET["act"] == "multiplevalid")
											echo "<h4 style='color:green;'>Multiple assets released</h4>";
												
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
											<li class="<?php if($tab==""){echo"active";}?>"><a href="#available-asset" data-toggle="tab">Available Assets</a>
											</li>
											<li class="<?php if($tab=="1"){echo"active";}?>"><a href="#use-asset" data-toggle="tab">In Used Assets</a>
											</li>
										</ul>

										<div class="tab-content">
											
											<div class="tab-pane fade <?php if($tab==""){echo"active in";}?>" id="available-asset">
												<div class="panel panel-default">
														
														<div id="buttons"></div>
														<div class="panel-body">
															<div class="table-responsive">
																
																<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example3">
																	<?php
																		$sql3="select * from trailer where STATUS='' order by VEHICLE_REG";
																		$result3=ExecuteQuery($sql3);
																		
																		$sql4="select * from truck where STATUS='' order by VEHICLE_REG";
																		$result4=ExecuteQuery($sql4);
																		
																		$sql5="select * from trailer_2 where STATUS='' order by VEHICLE_REG";
																		$result5=ExecuteQuery($sql5);
																		
																		$sql6="select * from tanker where STATUS='' order by VEHICLE_REG";
																		$result6=ExecuteQuery($sql6);
																		
																		$sql7="select * from tanker_2 where STATUS='' order by VEHICLE_REG";
																		$result7=ExecuteQuery($sql7);
																	?>
																	<thead>
																		<tr>
																			<th style="width:30px;">Status</th>
																			<th style="width:50px;">Vehicle Reg</th>
																			<th style="width:150px;">Vehicle Make</th>
																			<th style="width:100px;">Vin Number</th>
																			<th style="width:70px;">Expiry Date</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			while($row4 = mysqli_fetch_array($result4))
																			{
																				$status4 = $row4['STATUS'];
																				echo "
																					<tr>";?>
																		<?php		
																				if($status4 == "repair")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																				}
																				else if($status4 == "out")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																				}?>
																		<?php
																				echo"
																						<td>$row4[VEHICLE_REG]</td>
																						<td>$row4[VEHICLE_MAKE]</td>
																						<td>$row4[VIN_NO]</td>
																						<td>$row4[EXPIRY_DATE]</td>
																					</tr>
																				";
																			}
																			
																			while($row3 = mysqli_fetch_array($result3))
																			{
																				$status3 = $row3['STATUS'];
																				echo "
																					<tr>";?>
																		<?php		
																				if($status3 == "repair")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																				}
																				else if($status3 == "out")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																				}?>
																		<?php	
																				echo"
																						
																						<td>$row3[VEHICLE_REG]</td>
																						<td>$row3[VEHICLE_MAKE]</td>
																						<td>$row3[VIN_NO]</td>
																						<td>$row3[EXPIRY_DATE]</td>
																					</tr>
																				";
																			}
																		?>
																		<?php
																			while($row5 = mysqli_fetch_array($result5))
																			{
																				$status5 = $row5['STATUS'];
																				echo "
																					<tr>";?>
																		<?php		
																				if($status5 == "repair")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																				}
																				else if($status5 == "out")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																				}?>
																		<?php
																				echo"
																						<td>$row5[VEHICLE_REG]</td>
																						<td>$row5[VEHICLE_MAKE]</td>
																						<td>$row5[VIN_NO]</td>
																						<td>$row5[EXPIRY_DATE]</td>
																					</tr>
																				";
																			}
																			
																			while($row6 = mysqli_fetch_array($result6))
																			{
																				$status6 = $row6['STATUS'];
																				echo "
																					<tr>";?>
																		<?php		
																				if($status6 == "repair")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																				}
																				else if($status6 == "out")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																				}?>
																		<?php	
																				echo"
																						
																						<td>$row6[VEHICLE_REG]</td>
																						<td>$row6[VEHICLE_MAKE]</td>
																						<td>$row6[VIN_NO]</td>
																						<td>$row6[EXPIRY_DATE]</td>
																					</tr>
																				";
																			}
																		?>
																		<?php
																			while($row7 = mysqli_fetch_array($result7))
																			{
																				$status7 = $row7['STATUS'];
																				echo "
																					<tr>";?>
																		<?php		
																				if($status7 == "repair")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																				}
																				else if($status7 == "out")
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																				}
																				else
																				{
																					echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																				}?>
																		<?php	
																				echo"
																						
																						<td>$row7[VEHICLE_REG]</td>
																						<td>$row7[VEHICLE_MAKE]</td>
																						<td>$row7[VIN_NO]</td>
																						<td>$row7[EXPIRY_DATE]</td>
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
											<div class="tab-pane fade <?php if($tab=="1"){echo"active in";}?>" id="use-asset">
												<div class="panel panel-default">
														
														<div id="buttons"></div>
														<div class="panel-body">
															<form action="con_unset-multiple.php" method="post">
																<div class="table-responsive">
																	
																	<table class="table table-striped table-bordered table-hover" style="table-layout:fixed" id="dataTables-example2">
																		<?php
																			$sql="select * from trailer where STATUS='out' order by VEHICLE_REG";
																			$result=ExecuteQuery($sql);
																			
																			$sql2="select * from truck where STATUS='out' order by VEHICLE_REG";
																			$result2=ExecuteQuery($sql2);
																			
																			$sql8="select * from trailer_2 where STATUS='out' order by VEHICLE_REG";
																			$result8=ExecuteQuery($sql8);
																			
																			$sql9="select * from tanker where STATUS='out' order by VEHICLE_REG";
																			$result9=ExecuteQuery($sql9);
																			
																			$sql10="select * from tanker_2 where STATUS='out' order by VEHICLE_REG";
																			$result10=ExecuteQuery($sql10);
																		?>
																		<thead>
																			<tr>
																				<th style="width:30px;">Status</th>
																				<th style="width:80px;">Work Order Number</th>
																				<th style="width:50px;">Vehicle Reg</th>
																				<th style="width:120px;">Vehicle Make</th>
																				<th style="width:100px;">Vin Number</th>
																				<th style="width:70px;">Expiry Date</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																				while($row2 = mysqli_fetch_array($result2))
																				{
																					$reg11 = $row2['VEHICLE_REG'];
																					$sql11="select WORK_ORDER_NUMBER from work_order where TRUCK_ALLOCATION='$reg11'";
																					$result11=ExecuteQuery($sql11);
																					$row11 = mysqli_fetch_array($result11);
																					$wo_truck = $row11['WORK_ORDER_NUMBER'];
																					
																					$status2 = $row2['STATUS'];
																					echo "
																						<tr>";?>
																			<?php		
																					if($status2 == "repair")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																					}
																					else if($status2 == "out")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																					}
																					else
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}?>
																			<?php
																					echo"
																							<td>$wo_truck</td>
																							<td>$row2[VEHICLE_REG]</td>
																							<td>$row2[VEHICLE_MAKE]</td>
																							<td>$row2[VIN_NO]</td>
																							<td>$row2[EXPIRY_DATE]</td>
																						</tr>
																					";
																				}
																				
																				while($row = mysqli_fetch_array($result))
																				{
																					$reg12 = $row['VEHICLE_REG'];
																					$sql12="select WORK_ORDER_NUMBER from work_order where TRAILER_ALLOCATION='$reg12'";
																					$result12=ExecuteQuery($sql12);
																					$row12 = mysqli_fetch_array($result12);
																					$wo_trailer = $row12['WORK_ORDER_NUMBER'];
																					
																					$status = $row['STATUS'];
																					echo "
																						<tr>";?>
																			<?php		
																					if($status == "repair")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																					}
																					else if($status == "out")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																					}
																					else
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}?>
																			<?php	
																					echo"
																							<td>$wo_trailer</td>
																							<td>$row[VEHICLE_REG]</td>
																							<td>$row[VEHICLE_MAKE]</td>
																							<td>$row[VIN_NO]</td>
																							<td>$row[EXPIRY_DATE]</td>
																						</tr>
																					";
																				}
																			?>
																			<?php
																				while($row8 = mysqli_fetch_array($result8))
																				{
																					$reg13 = $row8['VEHICLE_REG'];
																					$sql13="select WORK_ORDER_NUMBER from work_order where TRAILER_ALLOCATION_2='$reg13'";
																					$result13=ExecuteQuery($sql13);
																					$row13 = mysqli_fetch_array($result13);
																					$wo_trailer2 = $row13['WORK_ORDER_NUMBER'];
																					
																					$status8 = $row8['STATUS'];
																					echo "
																						<tr>";?>
																			<?php		
																					if($status8 == "repair")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																					}
																					else if($status8 == "out")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																					}
																					else
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}?>
																			<?php
																					echo"
																							<td>$wo_trailer2</td>
																							<td>$row8[VEHICLE_REG]</td>
																							<td>$row8[VEHICLE_MAKE]</td>
																							<td>$row8[VIN_NO]</td>
																							<td>$row8[EXPIRY_DATE]</td>
																						</tr>
																					";
																				}
																				
																				while($row9 = mysqli_fetch_array($result9))
																				{
																					$reg14 = $row9['VEHICLE_REG'];
																					$sql14="select WORK_ORDER_NUMBER from work_order where TANKER_ALLOCATION='$reg14'";
																					$result14=ExecuteQuery($sql14);
																					$row14 = mysqli_fetch_array($result14);
																					$wo_tanker = $row14['WORK_ORDER_NUMBER'];
																					
																					$status9 = $row9['STATUS'];
																					echo "
																						<tr>";?>
																			<?php		
																					if($status9 == "repair")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																					}
																					else if($status9 == "out")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																					}
																					else
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}?>
																			<?php	
																					echo"
																							<td>$wo_tanker</td>
																							<td>$row9[VEHICLE_REG]</td>
																							<td>$row9[VEHICLE_MAKE]</td>
																							<td>$row9[VIN_NO]</td>
																							<td>$row9[EXPIRY_DATE]</td>
																						</tr>
																					";
																				}
																			?>
																			<?php
																				while($row10 = mysqli_fetch_array($result10))
																				{
																					$reg15 = $row10['VEHICLE_REG'];
																					$sql15="select WORK_ORDER_NUMBER from work_order where TANKER_ALLOCATION_2='$reg15'";
																					$result15=ExecuteQuery($sql15);
																					$row15 = mysqli_fetch_array($result15);
																					$wo_tanker2 = $row15['WORK_ORDER_NUMBER'];
																					
																					$status10 = $row10['STATUS'];
																					echo "
																						<tr>";?>
																			<?php		
																					if($status10 == "repair")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/1.png'></td>";
																					}
																					else if($status10 == "out")
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/2.png'></td>";
																					}
																					else
																					{
																						echo"<td style='text-align:center'><img style='height:25px;width:25px;border-radius:25px;' src='assets/img/3.png'></td>";
																					}?>
																			<?php	
																					echo"
																							<td>$wo_tanker2</td>
																							<td>$row10[VEHICLE_REG]</td>
																							<td>$row10[VEHICLE_MAKE]</td>
																							<td>$row10[VIN_NO]</td>
																							<td>$row10[EXPIRY_DATE]</td>
																						</tr>
																					";
																				}
																			?>
																		</tbody>
																	</table>
																	
																</div>
															</form>	
														</div>
														
													</div>
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
	<script src="datepicker/bootstrap-datepicker.js"></script>
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
		$('#sandbox-container2 input').datepicker({
				autoclose: true
			});

			$('#sandbox-container2 input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container2 input').on('hide', function(e){
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
		$('#sandbox-container3 input').datepicker({
				autoclose: true
			});

			$('#sandbox-container3 input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container3 input').on('hide', function(e){
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
