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

$sql = "SELECT WORK_ORDER_NUMBER,SHIPMENT_REFERENCE,IMPORT_REFERENCE,BILL_CLIENT,PRODUCT_TYPE,QUANTITY,TONNAGE,PICKUP_POINT,PICKUP_DATE,PICKUP_TIME,DELIVERY_POINT_1,DELIVERY_POINT_2,TRUCK_ALLOCATION,TRAILER_ALLOCATION,TRAILER_ALLOCATION_2,DRIVER_ASSIGNED,CREATED_BY,STATUS,CREATED_BY from work_order WHERE PRINT_FROM <= '$from' AND PRINT_FROM >= '$to'";
$result1 = ExecuteQuery($sql);

$header = '';
$result ='';

$header = "Work Order Number"."\t"."Shipment Reference"."\t"."Import Reference"."\t"."Bill Client"."\t"."Product Type"."\t"."Quantity"."\t"."Tonnage"."\t"."Pickup Point"."\t"."Pickup Date"."\t"."Pickup Time"."\t"."Delivery Point 1"."\t"."Delivery Point 2"."\t"."Truck Allocation"."\t"."Trailer Allocation"."\t"."Trailer Allocation 2"."\t"."Driver Assigned"."\t"."Created By"."\t"."Status"."\t"."Created At"."\t";
 
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
header("Content-Disposition: attachment; filename=Work-Order-List.xls");
header("Pragma: no-cache");
header("Expires: 0");
printf("%-10s", $test);
//print "$header\n$result";
//echo ucwords($header)."\n".$result."\n";
 
?>