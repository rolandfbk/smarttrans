<?php  
ob_start();
require("utility.php");
 ?>


<?php


$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];

header("location: search-date.php?from=$date_from&to=$date_to");

?>