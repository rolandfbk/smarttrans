<?php
error_reporting(1);
	function ExecuteQuery ($SQL)
	{	
		$con=mysqli_connect ("localhost", "root","","demo4u_db");
		//mysqli_select_db ($con,"tech_forum");
		
		$rows = mysqli_query ($con, $SQL);
		
		mysqli_close ();
		
		return $rows;
	}
	
	function ExecuteNonQuery ($SQL)
	{
		$con=mysqli_connect ("localhost", "root","","demo4u_db");
		//mysqli_select_db ($con,"tech_forum");
		
		$result = mysqli_query ($con, $SQL);
		
		mysqli_close ();
		
		return $result;
	}
?>