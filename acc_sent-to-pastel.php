<?php  
ob_start();
session_start();
require("utility.php");
 ?>


<?php

$id = $_GET['id'];

$sql="update work_order set PASTEL='pastel',UPDATED_AT=now() where work_order.ID=$id";
$result=ExecuteNonQuery ($sql);

$user = $_SESSION["name"];

$sql1="select * from work_order where work_order.ID=$id";
$result1 = ExecuteQuery($sql1);
$row1 = mysqli_fetch_array($result1);
$orderNumber = $row1['WORK_ORDER_NUMBER'];
$client = $row1['BILL_CLIENT'];

$product_type = $row1['PRODUCT_TYPE'];
$delivery_point1 = $row1['DELIVERY_POINT_1'];
$delivery_point2 = $row1['DELIVERY_POINT_2'];

$quantity_1 = $row1['QUANTITY_1'];
$quantity_2 = $row1['QUANTITY_2'];

$final_quantity = $quantity_1 + $quantity_2;




$sql5="select * from customer_list where COMPANY='$client'";
$result5 = ExecuteQuery($sql5);
$row5 = mysqli_fetch_array($result5);
$accno = $row5['ACC_NO'];

$DocumentNumber = "";
$strCount = strlen($orderNumber);
if($strCount == 7)
{
	$first = substr($orderNumber,0,3);
	$second = substr($orderNumber,3);
	$DocumentNumber = $first."0".$second;
}
else if($strCount == 9){
	$first = substr($orderNumber,0,2);
	$second = substr($orderNumber,3);
	$DocumentNumber = $first.$second;
}
else if($strCount == 10){
	$first = substr($orderNumber,0,1);
	$second = substr($orderNumber,3);
	$DocumentNumber = $first.$second;
}
else{
	$DocumentNumber = $orderNumber;
}

if($result)
{
	$sql4=" INSERT INTO activity_log (WORK_ORDER_NUMBER,COMMENT,TIME,SYSTEM_TIME,USER,CREATED_AT) values ('$orderNumber','Work Order sent to Pastel by $user',now(),now(),'$user',now())";
	$result4=ExecuteNonQuery ($sql4);
	
	
	$conn=odbc_connect('GT19','','');
	if (!$conn)
	  {exit("Connection Failed: " . $conn);}
  
	$sql6="SELECT * FROM Inventory WHERE ItemCode='$product_type'";
	$rs=odbc_exec($conn,$sql6);
	while (odbc_fetch_row($rs))
	{
	  $Description=odbc_result($rs,"Description");
	  $SalesTaxType=odbc_result($rs,"SalesTaxType");
	  $DiscountType=odbc_result($rs,"DiscountType");
	  $ShowQty=odbc_result($rs,"ShowQty");
	  $Physical=odbc_result($rs,"Physical");
	}
	
	$sql7="SELECT * FROM MultiStoreTrn WHERE ItemCode='$product_type' AND StoreCode='001'";
	$rs2=odbc_exec($conn,$sql7);
	while (odbc_fetch_row($rs2))
	{
	  $SellExcl01=odbc_result($rs2,"SellExcl01");
	  $SellIncl01=odbc_result($rs2,"SellIncl01");
	}
	
	$total = $final_quantity * $SellExcl01;
	$totaltax = ($total * $SalesTaxType)/100;
	
	$sql8="INSERT INTO HistoryUserDesc (DocumentType,DocumentNumber,PPeriod,UserDefDate01,UserDefDate02,UserDefDate03,Exported,ExportNum) VALUES('103','$DocumentNumber','106',now(),now(),now(),'0','0')";
	odbc_exec($conn,$sql8);
	
	$sql9="INSERT INTO HistoryHeader (DocumentType,DocumentNumber,CustomerCode,DocumentDate,UserID,ExclIncl,DelAddress01,DelAddress02,Terms,ExtraCosts,PPeriod,ClosingDate,CurrencyCode,ExchangeRate,DiscountPercent,Total,FCurrTotal,TotalTax,FCurrTotalTax,TotalCost,Paid,IsTMBDoc,Exported,ExportNum) VALUES('103','$DocumentNumber','$accno',now(),'1','0','$delivery_point1','$delivery_point2','0','0','106',now(),'0','1.0','0.0','$total','$total','$totaltax','$totaltax','0.0','0','0','0','0')";
	odbc_exec($conn,$sql9);
	
	$sql10="INSERT INTO HistoryLines (UserId,DocumentType,DocumentNumber,ItemCode,CustomerCode,SearchType,PPeriod,DDate,TaxType,DiscountType,DiscountPercentage,Description,CostPrice,Qty,UnitPrice,InclusivePrice,FCurrUnitPrice,FCurrInclPrice,TaxAmt,FCurrTaxAmount,DiscountAmount,FCDiscountAmount,Physical,Fixed,ShowQty,LinkNum,LinkedNum,GRNQty,LinkID,MultiStore,IsTMBLine,LinkDocumentType,LinkDocumentNumber,Exported,ExportNum,Qtyleft,CaseLotQty,CaseLotRatio) VALUES('1','103','$DocumentNumber','$product_type','$accno','4','106',now(),'$SalesTaxType','$DiscountType','0','$Description','0.0','$final_quantity','$SellExcl01','$SellIncl01','$SellExcl01','$SellIncl01','$totaltax','$totaltax','$total','$total','0','0','1','0','0','0.0','0','001','0','0','0','0','0','$final_quantity','$final_quantity','1.0')";
	odbc_exec($conn,$sql10);
	
	odbc_close($conn);
	
	
	$sql12="update work_order set STATUS='archive',UPDATED_AT=now() where work_order.ID=$id";
	$result12=ExecuteNonQuery ($sql12);
	
	
	header("location: acc_work-order-manage.php?act=pastelvalid");
}
else
{
	header("location: acc_work-order-manage.php?act=pastelinvalid");
}

?>