<?php  
ob_start();
require("utility.php");

 ?>


<?php

$sort = $_POST['sort'];


header("location: work-order-manage.php?sort=$sort");

?>