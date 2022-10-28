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
	
	<link rel="stylesheet" type="text/css" href="Clock-picker/jquery-clockpicker.min.css"/>
	
	<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css" rel="stylesheet"/>
	
	<link rel="stylesheet" type="text/css" href="datepicker/datepicker3.css"/>
	
   
</head>
<body>
<?php 
	session_start();
	require("utility.php");
	
	// if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='account'))
	// {
		// header("location: index.php");
	// }
?>
<?php
	
	// $id = $_GET['id'];
	// $truck = $_GET['truck'];
	// $trailer = $_GET['trailer'];
	// $trailer2 = $_GET['trailer2'];
	// $tanker = $_GET['tanker'];
	// $tanker2 = $_GET['tanker2'];
	
	$id = 958;
	// $mainattachment = "";
?>
<?php
	$sql="select * from work_order where work_order.ID=$id";
	$result=ExecuteQuery($sql);
	if (mysqli_num_rows($result)==1)
	{
		$row = mysqli_fetch_array($result);
		$attachment = $row['ATTACHMENT'];
		$work_order_number = $row['WORK_ORDER_NUMBER'];
		$shipment_reference = $row['SHIPMENT_REFERENCE'];
		$import_reference = $row['IMPORT_REFERENCE'];
		$bill_client = $row['BILL_CLIENT'];
		//$job_detail = $row['JOB_DETAIL'];
		$product_type = $row['PRODUCT_TYPE'];
		$quantity = $row['QUANTITY'];
		$tonnage = $row['TONNAGE'];
		$pickup_point = $row['PICKUP_POINT'];
		$pickup_date = $row['PICKUP_DATE'];
		$pickup_time = $row['PICKUP_TIME'];
		$delivery_point1 = $row['DELIVERY_POINT_1'];
		$delivery_point2 = $row['DELIVERY_POINT_2'];
		$truck_allocation = $row['TRUCK_ALLOCATION'];
		$trailer_allocation = $row['TRAILER_ALLOCATION'];
		$trailer_allocation2 = $row['TRAILER_ALLOCATION_2'];
		$tanker_allocation = $row['TANKER_ALLOCATION'];
		$tanker_allocation2 = $row['TANKER_ALLOCATION_2'];
		$driver_assigned = $row['DRIVER_ASSIGNED'];
		$status = $row['STATUS'];
		$pastel = $row['PASTEL'];
		$gate_time = $row['GATE_TIME'];
		$security_name = $row['SECURITY_NAME'];
		$gate_signature = $row['GATE_SIGNATURE'];
		$type = $row['CARGO_TYPE'];
		$created = $row['CREATED_AT'];
		$quantity_1 = $row['QUANTITY_1'];
		$quantity_2 = $row['QUANTITY_2'];
		
	}
	$final_quantity = $quantity_1 + $quantity_2;
	
	
	$sql2="select * from truck where truck.VEHICLE_REG='$truck_allocation'";
	$result2=ExecuteQuery($sql2);
	$row2 = mysqli_fetch_array($result2);
	$truck_vehicle_make = $row2['VEHICLE_MAKE'];
	$truck_vehicle_reg = $row2['VEHICLE_REG'];
	$truck_vehicle_fleet_no = $row2['VEHICLE_FLEET_NO'];
	$truck_vin_no = $row2['VIN_NO'];
	
	
	$sql3="select * from trailer where trailer.VEHICLE_REG='$trailer_allocation'";
	$result3=ExecuteQuery($sql3);
	$row3 = mysqli_fetch_array($result3);
	$trailer_vehicle_make = $row3['VEHICLE_MAKE'];
	$trailer_vehicle_reg = $row3['VEHICLE_REG'];
	$trailer_vin_no = $row3['VIN_NO'];
	
	$sql21="select * from trailer_2 where trailer_2.VEHICLE_REG='$trailer_allocation2'";
	$result21=ExecuteQuery($sql21);
	$row21 = mysqli_fetch_array($result21);
	$trailer2_vehicle_make = $row21['VEHICLE_MAKE'];
	$trailer2_vehicle_reg = $row21['VEHICLE_REG'];
	$trailer2_vin_no = $row21['VIN_NO'];
	
	$sql24="select * from tanker where tanker.VEHICLE_REG='$tanker_allocation'";
	$result24=ExecuteQuery($sql24);
	$row24 = mysqli_fetch_array($result24);
	$tanker_vehicle_make = $row24['VEHICLE_MAKE'];
	$tanker_vehicle_reg = $row24['VEHICLE_REG'];
	$tanker_vin_no = $row24['VIN_NO'];
	
	$sql25="select * from tanker_2 where tanker_2.VEHICLE_REG='$tanker_allocation2'";
	$result25=ExecuteQuery($sql25);
	$row25 = mysqli_fetch_array($result25);
	$tanker2_vehicle_make = $row25['VEHICLE_MAKE'];
	$tanker2_vehicle_reg = $row25['VEHICLE_REG'];
	$tanker2_vin_no = $row25['VIN_NO'];
	
	$sql4="select * from controller_user where controller_user.REFERENCE_NUMBER='$driver_assigned'";
	$result4=ExecuteQuery($sql4);
	$row4 = mysqli_fetch_array($result4);
	$driver_first_name = $row4['FIRST_NAME'];
	$driver_surname = $row4['SURNAME'];
	$driver_reference_number = $row4['REFERENCE_NUMBER'];
?>

<?php
	$sql10="select * from delivery where delivery.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
	$result10=ExecuteQuery($sql10);
	
	$sql30="select * from delivery2 where delivery2.WORK_ORDER_NUMBER='$work_order_number' order by CREATED_AT desc";
	$result30=ExecuteQuery($sql30);
	
	$row10 = mysqli_fetch_array($result10);
	$json = $row10['ID'];
	
	$del_sign1 = $row10['SIGNATURE'];
	$del_Count1 = strlen($del_sign1);
	
	$row30 = mysqli_fetch_array($result30);
	$json8 = $row30['ID'];
	
	$del_sign2 = $row30['SIGNATURE'];
	$del_Count2 = strlen($del_sign2);
?>

	

    <div>
        
        <div>
            <div>
					
						              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div>
									
									<div>
										

										<div>
											
											
											
											
											
											<div>
												<br>
												<?php
													$unique_number = substr($work_order_number,3);
												?>
												<br>
												
												
												
												
												
												<div id="page-content">
													
													<div class="row">
														<div align="center" class="col-md-12">
															<img src="assets/img/find_user.png" class="user-image img-responsive"/>
														</div>
													</div>
													<div class="row">
														<div align="center" class="col-md-12">
															<h5>P.O. BOX 12411 | JACOBS, 4026 | 21 INDUSTRIA ST | JACOBS, 4052</h5>
															<h5>TEL: (031) 4658681/2/3 | (031) 4654916 | (031) 4651063 | FAX: (031) 4658610 | E-mail: knaidu@gantrans.co.za</h5>
														</div>
													</div>
													<div class="row">
														<div align="center" class="col-md-12">
															<h3 style='color:black;'>DELIVERY NOTE No. <?php echo $unique_number; ?></h3>
														</div>
													</div>
													
													<div class="row">
														<div align="center" class="col-md-12">
															<h5 style='color:black;'><b>"BUILDING BUSINESS PARTNERSHIPS"</b></h5>
															<h5 style='color:black;'>INDUSTRIAL AND COMMERCIAL HAULIERS * HARBOUR CARRIERS * BULK TRANSPORTERS</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>ACCOUNT TO:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$bill_client";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>UPLIFT FROM:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$pickup_point";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. DELIVER TO:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$delivery_point1";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. DELIVER TO:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$delivery_point2";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SHIPPING REF / WORK ORDER No:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$shipment_reference / $work_order_number";?></h5></td>
																</tr>
																
															</table>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:25%'><h5>QUANTITY</h5></td>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>DESCRIPTION</h5></td>
																	<td style='padding-left:5px;background-color:#add8e6;width:25%'><h5>WEIGHT/LITRES</h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;height:35px'><h5><?php echo "$final_quantity";?></h5></td>
																	<td style='padding-left:5px;height:35px'><h5><?php echo "$product_type";?></h5></td>
																	<td style='padding-left:5px;height:35px'><h5><?php echo "$tonnage";?></h5></td>
																</tr>
															</table>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>HORSE REG:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$truck_vehicle_reg";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TANKER/TRAILER REG.:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$trailer_vehicle_reg $tanker_vehicle_reg | $trailer2_vehicle_reg $tanker2_vehicle_reg";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SEAL FITTED ON LOADING</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>SEAL, BROKEN ON DISCHARGE</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>DRIVER NAME:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$driver_first_name $driver_surname";?></h5></td>
																</tr>
															</table>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<table border="1"  style='width:100%;border-collapse: collapse'>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TIME IN:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$pickup_time";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>TIME OUT:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row10[TIME]";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;width:50%'><h5></h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row30[TIME]";?></h5></td>
																</tr>
																	<?php 
																		$newDate = "";
																		$date_del = $row10['DATE'];
																		if($date_del != "")
																		{
																			$newDate = date("d-m-Y", strtotime($date_del));
																		}
																		
																		
																		$newDate2 = "";
																		$date_del2 = $row30['DATE'];
																		if($date_del2 != "")
																		{
																			$newDate2 = date("d-m-Y", strtotime($date_del2));
																		}
																		
																	?>
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. DATE:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$newDate";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. TIME:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row10[TIME]";?></h5></td>
																</tr>
																
																<tr>
																	<td rowspan="2" style='padding-left:5px;background-color:#add8e6;width:50%'><h5>1. RECEIVED BY:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row10[SIGNED_BY]";?></h5></td>
																</tr>
																
																<tr>
																	<?php
																		
																		$s = $row10['SIGNATURE'];
																		if($s != "")
																		{
																			echo"<td style='padding-left:5px;width:50%'><img style='width:100px;height:100px' src='$s'></td>";
																		}
																		else{
																			echo"<td style='padding-left:5px;width:50%'></td>";
																		}
																	?>
																</tr>
																
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. DATE:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$newDate2";?></h5></td>
																</tr>
																
																<tr>
																	<td style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. TIME:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row30[TIME]";?></h5></td>
																</tr>
																
																<tr>
																	<td rowspan="2" style='padding-left:5px;background-color:#add8e6;width:50%'><h5>2. RECEIVED BY:</h5></td>
																	<td style='padding-left:5px;width:50%'><h5><?php echo "$row30[SIGNED_BY]";?></h5></td>
																</tr>
																
																<tr>
																	<?php
																		
																		$s2 = $row30['SIGNATURE'];
																		if($s2 != "")
																		{
																			echo"<td style='padding-left:5px;width:50%'><img style='width:100px;height:100px' src='$s2'></td>";
																		}
																		else{
																			echo"<td style='padding-left:5px;width:50%'></td>";
																		}
																	?>
																</tr>
															</table>
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-12">
															<h5>ALL CARRIAGE IS UNDERTAKEN SUBJECT TO OUR STANDARD TRADING CONDITIONS. A COPY OF WHICH IS AVAILABLE ON REQUEST. NO CLAIMS WILL BE RECOGNISED IN RESPECT OF THIS DELIVERY UNLESS POINTED OUT TO THE DRIVER ON RECEIPT AND WAYBILL ENDORSED ACCORDINGLY.</h5>
														</div>
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
	<script src="FileSaver.js"></script> 
	<script src="jquery.wordexport.js"></script> 
	<!--<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("a.word-export").click(function(event) {
				$("#page-content").wordExport();
			});
		});
    </script>-->
	
	
	<script>
		$(function() {
			$('a[data-toggle="tab"]').on('click', function(e) {
				window.localStorage.setItem('activeTab', $(e.target).attr('href'));
			});
			var activeTab = window.localStorage.getItem('activeTab');
			if (activeTab) {
				$('#myTab a[href="' + activeTab + '"]').tab('show');
				//window.localStorage.removeItem("activeTab");
			}
		});
	</script>
	
	<script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
	<script>
		var input1 = $('#input-a');
		input1.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input1.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-b').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input1.clockpicker('show')
					.clockpicker('toggleView', 'hours');
		});
    </script>
	<script>
		var input2 = $('#input-b');
		input2.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input2.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-c').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input2.clockpicker('show')
					.clockpicker('toggleView', 'hours');
		});
    </script>
	<script>
		var input = $('#input-c');
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
		$('#button-d').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input.clockpicker('show')
					.clockpicker('toggleView', 'hours');
		});
    </script>
	<script>
		var input3 = $('#input-d');
		input3.clockpicker({
			autoclose: true
		});

		// Manual operations
		$('#button-a').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input3.clockpicker('show')
					.clockpicker('toggleView', 'minutes');
		});
		$('#button-e').click(function(e){
			// Have to stop propagation here
			e.stopPropagation();
			input3.clockpicker('show')
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
		var textarea = document.querySelector('#textareacomment');

		textarea.addEventListener('keydown', autosize);
					 
		function autosize(){
		  var el = this;
		  setTimeout(function(){
			el.style.cssText = 'height:auto; padding:0';
			// for box-sizing other than "content-box" use:
			// el.style.cssText = '-moz-box-sizing:content-box';
			el.style.cssText = 'height:' + el.scrollHeight + 'px';
		  },0);
		}
	</script>
	
	<script>
		var textarea2 = document.querySelector('#textareapickup');

		textarea2.addEventListener('keydown', autosize);
					 
		function autosize(){
		  var el = this;
		  setTimeout(function(){
			el.style.cssText = 'height:auto; padding:0';
			// for box-sizing other than "content-box" use:
			// el.style.cssText = '-moz-box-sizing:content-box';
			el.style.cssText = 'height:' + el.scrollHeight + 'px';
		  },0);
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
	<script>
		$('#sandbox-container4 input').datepicker({
				autoclose: true
			});

			$('#sandbox-container4 input').on('show', function(e){
				console.debug('show', e.date, $(this).data('stickyDate'));
				
				if ( e.date ) {
					 $(this).data('stickyDate', e.date);
				}
				else {
					 $(this).data('stickyDate', null);
				}
			});

			$('#sandbox-container4 input').on('hide', function(e){
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
		var wo = "<?php echo"$work_order_number";?>";
		if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
		(function($) {
			$.fn.wordExport = function(fileName) {
				fileName = typeof fileName !== 'undefined' ? fileName : "Delivery Note "+wo;
				var static = {
					mhtml: {
						top: "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>",
						head: "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n",
						body: "<body>_body_</body>"
					}
				};
				var options = {
					maxWidth: 624
				};
				// Clone selected element before manipulating it
				var markup = $(this).clone();

				// Remove hidden elements from the output
				markup.each(function() {
					var self = $(this);
					if (self.is(':hidden'))
						self.remove();
				});

				// Embed all images using Data URLs
				var images = Array();
				var img = markup.find('img');
				for (var i = 0; i < img.length; i++) {
					// Calculate dimensions of output image
					var w = Math.min(img[i].width, options.maxWidth);
					var h = img[i].height * (w / img[i].width);
					// Create canvas for converting image to data URL
					var canvas = document.createElement("CANVAS");
					canvas.width = w;
					canvas.height = h;
					// Draw image to canvas
					var context = canvas.getContext('2d');
					context.drawImage(img[i], 0, 0, w, h);
					// Get data URL encoding of image
					var uri = canvas.toDataURL("image/png");
					$(img[i]).attr("src", img[i].src);
					img[i].width = w;
					img[i].height = h;
					// Save encoded image to array
					images[i] = {
						type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
						encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
						location: $(img[i]).attr("src"),
						data: uri.substring(uri.indexOf(",") + 1)
					};
				}

				// Prepare bottom of mhtml file with image data
				var mhtmlBottom = "\n";
				for (var i = 0; i < images.length; i++) {
					mhtmlBottom += "--NEXT.ITEM-BOUNDARY\n";
					mhtmlBottom += "Content-Location: " + images[i].location + "\n";
					mhtmlBottom += "Content-Type: " + images[i].type + "\n";
					mhtmlBottom += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
					mhtmlBottom += images[i].data + "\n\n";
				}
				mhtmlBottom += "--NEXT.ITEM-BOUNDARY--";

				//TODO: load css from included stylesheet
				var styles = "";

				// Aggregate parts of the file together
				var fileContent = static.mhtml.top.replace("_html_", static.mhtml.head.replace("_styles_", styles) + static.mhtml.body.replace("_body_", markup.html())) + mhtmlBottom;

				// Create a Blob with the file contents
				var blob = new Blob([fileContent], {
					type: "application/msword;charset=utf-8"
				});
				saveAs(blob, fileName + ".doc");
			};
		})(jQuery);
	} else {
		if (typeof jQuery === "undefined") {
			console.error("jQuery Word Export: missing dependency (jQuery)");
		}
		if (typeof saveAs === "undefined") {
			console.error("jQuery Word Export: missing dependency (FileSaver.js)");
		}
	}




	$("a.jquery-word-export").click(function(event) {
				$("#page-content").wordExport();
			});
	</script>
	
	<script>
		var modalConfirm = function(callback){
  
		  $("#btn-confirm").on("click", function(){
			$("#mi-modal").modal('show');
		  });

		  $("#modal-btn-si").on("click", function(){
			callback(true);
			$("#mi-modal").modal('hide');
		  });
		  
		  $("#modal-btn-no").on("click", function(){
			callback(false);
			$("#mi-modal").modal('hide');
		  });
		};

		modalConfirm(function(confirm){
		  if(confirm){
			//Acciones si el usuario confirma
			$("#result").html("CONFIRMADO");
		  }else{
			//Acciones si el usuario no confirma
			$("#result").html("NO CONFIRMADO");
		  }
		});
	</script>
	
	<script>
		var modalConfirm2 = function(callback){
  
		  $("#btn-confirm2").on("click", function(){
			$("#mi-modal2").modal('show');
		  });

		  $("#modal-btn-si").on("click", function(){
			callback(true);
			$("#mi-modal2").modal('hide');
		  });
		  
		  $("#modal-btn-no").on("click", function(){
			callback(false);
			$("#mi-modal2").modal('hide');
		  });
		};

		modalConfirm2(function(confirm){
		  if(confirm){
			//Acciones si el usuario confirma
			$("#result").html("CONFIRMADO");
		  }else{
			//Acciones si el usuario no confirma
			$("#result").html("NO CONFIRMADO");
		  }
		});
	</script>
	
	
		<script>
		function myFunctionConfirm() {
			var checkBox = document.getElementById("myCheck");
			var text = document.getElementById("confirm");
			if (checkBox.checked == true){
				text.style.display = "inline";
			} else {
			   text.style.display = "none";
			}
		}
		</script>
	
	
	<!--<script>
		// function downloadInnerHtml(filename, elId) {
		 // var elHtml = document.getElementById(elId).innerHTML;
		 // var link = document.createElement('a');
		 // link.setAttribute('download', filename);   
		 // link.setAttribute('href', 'data:' + 'text/doc' + ';charset=utf-8,' + encodeURIComponent(elHtml));
		 // link.click(); 
		// }
		// var fileName =  'tags.doc'; // You can use the .txt extension if you want
		// downloadInnerHtml(fileName, 'main');
	</script>-->
	
	 <!--<script>
		// function printDiv(elementId) {
			// var a = document.getElementById('printing-css').value;
			// var b = document.getElementById(elementId).innerHTML;
			// window.frames["print_frame"].document.title = document.title;
			// window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
			// window.frames["print_frame"].window.focus();
			// window.frames["print_frame"].window.print();
		// }
	 <!--</script>-->
</body>	

	
</html>
