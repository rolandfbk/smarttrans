<?php  
ob_start();
require("utility.php");

 ?>


<?php

$color = $_POST['color'];


header("location: con_work-order-manage.php?color=$color");

?>