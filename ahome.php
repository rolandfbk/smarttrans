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
	session_start();
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
                <a class="navbar-brand" href="ahome.php">Smart Barter</a> 
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
				
					
                    <li>
                        <a class="active-menu" href="ahome.php"><i class="fa fa-home"></i> Home</a>
                    </li>
					<li>
                        <a href="manage-user.php"><i class="fa fa-sitemap"></i> Manage Users</a>
                    </li>
					<li>
                        <a href="work-orders.php"><i class="fa fa-sitemap"></i> Work Orders</a>
                    </li>
					<li>
                        <a href="manage-vehicle.php"><i class="fa fa-sitemap"></i> Manage Vehicles</a>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
	
        <div id="page-wrapper" >
            <div id="page-inner">
				
						<div class="row">
							<div class="col-md-12">
							 <h2>Welcome to Smart Barter</h2>   
								<h5>Your Ultimate Solution</h5>
							</div>
						</div>              
						 <!-- /. ROW  -->
						 <!-- <hr />--><br>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<img width="100%" src="assets/img/home-page.jpg">
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
