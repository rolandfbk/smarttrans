<html>
<body>
<?php
	//$connection = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
	
	// $server = "192.168.1.4";
	// $mdbFilename = "C:\Users\Script\Documents\databasetest\mydatabase.accdb";
	// $user = "";
	// $password = "";
	
	//$conn = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
	
	//$conn = odbc_connect("Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq='C:\Users\Script\Documents\databasetest\mydatabase.accdb';", $user, $password);
	
	//$conn = odbc_connect("DRIVER={Microsoft Access Driver (.mdb, *.accdb)};DATABASE=$mdbFilename", $user, $password);  

	$conn=odbc_connect('rol','','');
	if (!$conn)
	  {exit("Connection Failed: " . $conn);}
	$sql="SELECT * FROM user";
	$rs=odbc_exec($conn,$sql);
	if (!$rs)
	  {exit("Error in SQL");}
	echo "<table><tr>";
	// echo "<th>CUSTOMER</th>";
	// echo "<th>EMAIL</th>";
	// echo "<th>PHONE</th></tr>";
	while (odbc_fetch_row($rs))
	{
	  $customer=odbc_result($rs,"CUSTOMER_NAME");
	  $email=odbc_result($rs,"EMAIL");
	  $phone=odbc_result($rs,"PHONE");
	  echo "<tr><td>$customer</td>";
	  echo "<td>$email</td>";
	  echo "<td>$phone</td></tr>";
	}
	odbc_close($conn);
	echo "</table>";
?>
</body>
</html>