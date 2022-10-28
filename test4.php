<?php
require("utility.php");
require_once 'signature-to-image.php';

$img1 = $_GET['img'];

$sql1="select * from delivery2 where delivery2.ID=$img1";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$signature = $row1['SIGNATURE'];

//$img = sigJsonToImage(file_get_contents('signature.json'));

$img = sigJsonToImage($signature);

// Save to file
//imagepng($img, 'signature.png');

// Output to browser
header('Content-Type: image/png');
imagepng($img);

// Destroy the image in memory when complete
imagedestroy($img);
?>