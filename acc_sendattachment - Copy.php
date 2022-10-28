<?php  
ob_start();
session_start();
require("utility.php");
//require_once("class.phpmailer.php"); 
require_once("PHPMailer-master/PHPMailerAutoload.php");
$id = $_GET['id'];
?>

<?php
try {
$mail = new PHPMailer(); //New instance, with exceptions enabled

$email=$_POST['email'];
$mainattachment=$_POST['mainattachment'];

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++)
{
	
}

$mail->AddAddress($email);
$mail->From = "info@gantrans.co.za";
$mail->FromName = "Gantrans";
$mail->Subject = 'Attachment';

$mail->Body = "Attachment fron Grantrans";
//$body = preg_replace('/\\\\/','', $body); //Strip backslashes
//$mail->MsgHTML($body);

$mail->IsSMTP(); // tell the class to use SMTP
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; // set the SMTP server port
$mail->Host = "smtp.gmail.com"; // SMTP server
$mail->Username = "myclasstest2000@gmail.com"; // SMTP server username
$mail->Password = "Student-12345"; // SMTP server password

$mail->IsSendmail(); // tell the class to use Sendmail
//$mail->AddReplyTo("rolandfbk@gmail.com");
//$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->WordWrap = 80; // set word wrap

// $mail->AddAttachment($_FILES['image']['tmp_name'],
// $_FILES['image']['name']);
//$mail->IsHTML(true); // send as HTML

// $mail->addStringAttachment(file_get_contents($mainattachment), 'main-attachment.jpg');
// $rowCount = count($_POST["users"]);
// for($i=0;$i<$rowCount;$i++)
// {
	// $mail->addStringAttachment(file_get_contents($_POST["users"][$i]), 'other-attachment.jpg');
// }

$mail->Send();
header("location: acc_work-order-details.php?id=$id");

} catch (phpmailerException $e) {
header("location: acc_work-order-details.php?id=$id&act=editinvalid");
}

?> 	