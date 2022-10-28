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
	
	if(($_SESSION["logged_in"]!=true)||($_SESSION["user"]!='account'))
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
					</li>
				
					
                    <!--<li>
                        <a href="ahome.php"><i class="fa fa-home"></i> Home</a>
                    </li>-->
					<li>
                        <a href="acc_work-order-manage.php"><i class="fa fa-sitemap"></i> Work Orders</a>
                    </li>
					<li>
                        <a class="active-menu" href="acc_work-order-search.php"><i class="fa fa-sitemap"></i> Search Work Order</a>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
					
						<div class="row">
							<div class="col-md-12">
							 <h2>Search Work Order</h2>
								<div align="right">
									
									<!--<button onclick="myFunction()">Print this page</button>-->
								</div>
								
								<div align="center">
									<?php
										if (isset ($_GET["act"]))
										{
											if ($_GET["act"] == "invalid")
											{
												$type = $_GET['type'];
												$client = $_GET['client'];
												echo "<h4 style='color:red;'>Work Order Number not found! Please type the work order correctly.</h4>";
											}
										}
									?>
									
									<?php
										if (isset ($_GET["act"]))
										{
											if ($_GET["act"] == "valid")
											{
												echo "<h4 style='color:green;'>Work Order created</h4>";
											}
										}
									?>
								</div>
								
								
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />-->
						 <br>
						<div class="row">
							<div class="col-md-5">
								<form action="acc_work-order-searchH.php" method="POST" enctype="multipart/form-data">
									<h5><b><font color="blue">Seach by Work Order Number</font></b></h5><br>
									<div class="form-group">
										<label>Work Order Number</label>
										<input type="text" style="text-transform:uppercase" name="work_order" class="form-control" placeholder="Type work order number here" required="required">
									</div>
									<br>
									<div align="center">
										<button type="submit" style="width:150px" class="btn btn-primary">Search</button>
									</div>
								</form>
							</div>
							<div class="col-md-2">	
								
							</div>
							<div class="col-md-5">
								<h5><b><font color="blue">Seach by date</font></b></h5><br>
								<form action="acc_work-order-search-dateH.php" method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<label>From</label>
										<div id="sandbox-container"><input type="text" name="date_from" class="form-control" required="required"></div>
									</div>
									<div class="form-group">
										<label>To</label>
										<div id="sandbox-container"><input type="text" name="date_to" class="form-control" required="required"></div>
									</div>
									<br>
									<div align="center">
										<button type="submit" style="width:150px" class="btn btn-primary">Search</button>
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
