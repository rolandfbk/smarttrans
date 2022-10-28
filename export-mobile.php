<?php

require("utility.php");


$from = $_POST['from'];
$to = $_POST['to'];

// $sql = "SELECT  * from user WHERE CREATED_AT <= '$from' AND CREATED_AT >= '$to'";
// $header = '';
// $result ='';
// $result1 = ExecuteQuery($sql);
 
// $fields = mysqli_num_fields ( $result1 );
 
// for ( $i = 0; $i < $fields; $i++ )
// {
	// $test = mysqli_fetch_field_direct( $result1 , $i );
    // $header .= $test->name . "\t";
// }

$sql = "SELECT REFERENCE_NUMBER,FIRST_NAME,SURNAME,EMAIL,PHONE from controller_user WHERE (PRINT_FROM <= '$from' AND PRINT_FROM >= '$to') AND USER_TYPE='mobile'";
$result1 = ExecuteQuery($sql);

$header = '';
$result ='';

$header = "Reference Number"."\t"."First Name"."\t"."Surname"."\t"."Email Address"."\t"."Phone Number"."\t";
 
while( $row = mysqli_fetch_row( $result1 ) )
{
    $line = '';
    foreach( $row as $value )
    {
		// $value = '"' . $value . '"' . "\t";
		// $line .= $value;
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
$test = $header."\n".$result;

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Driver-List.xls");
header("Pragma: no-cache");
header("Expires: 0");
printf("%-10s", $test);
//print "$header\n$result";
//echo ucwords($header)."\n".$result."\n";
 
?>