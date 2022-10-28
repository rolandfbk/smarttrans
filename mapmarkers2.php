<?php 
	ob_start();
	require("utility.php");
	
	$id = $_GET['id'];

	function parseToXML($htmlStr)
	{
		$xmlStr=str_replace('<','&lt;',$htmlStr);
		$xmlStr=str_replace('>','&gt;',$xmlStr);
		$xmlStr=str_replace('"','&quot;',$xmlStr);
		$xmlStr=str_replace("'",'&#39;',$xmlStr);
		$xmlStr=str_replace("&",'&amp;',$xmlStr);
		return $xmlStr;
	}
	
	$time = date("Y-m-d");
	
	$sql="select * from gps where NAME='$id' and DATE= '$time'"	;
	$result = ExecuteQuery($sql);
	
	
	header("Content-type: text/xml");
	
	// Start XML file, echo parent node
	echo '<markers>';
	
	while($row = mysqli_fetch_array($result))
	{
		// Add to XML document node
	  echo '<marker ';
	  echo 'id="' . $row['ID'] . '" ';
	  echo 'name="' . parseToXML($row['NAME']) . '" ';
	  echo 'address="' . parseToXML($row['ADDRESS']) . '" ';
	  echo 'lat="' . $row['LATITUDE'] . '" ';
	  echo 'lng="' . $row['LONGTITUDE'] . '" ';
	  echo 'type="' . $row['TYPE'] . '" ';
	  echo '/>';
	}
	
	// End XML file
	echo '</markers>';

?>