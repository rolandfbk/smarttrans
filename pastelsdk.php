<?php

 

ini_set('display_errors', 1);

//We are using this function to log the progress of our simple procedure below

function prn($message)

{

    echo "{$message}<br/>";

}

 

try

{

    //Create the COM Helper object

    $sdkHelper = new COM("Pastel.Evolution.ComHelper");

    prn("Loaded ComHelper, version {$sdkHelper->AssemblyVersion}");

    //Initialise

    $sdkHelper->CreateCommonDBConnection("uid=sa;pwd=123;Initial Catalog=EvolutionCommon;server=(local)");

    prn("Connected to common");

    $sdkHelper->SetLicense("DEMO", "67681607597478");

    prn("License set");

    $sdkHelper->CreateConnection("uid=sa;pwd=123;Initial Catalog=50008;server=(local)");

    prn("Connected to database");

    if ($sdkHelper->CurrentEvolutionDatabaseVersion != $sdkHelper->CompatibleEvolutionDatabaseVersion)

    {

        prn("Warning: the current database version is {$sdkHelper->CurrentEvolutionDatabaseVersion} while this version of the SDK is intended for version {$sdkHelper->CompatibleEvolutionDatabaseVersion}");

    }

 

    /* This is how you would create a new customer account:

    $newAccount = new COM("Pastel.Evolution.Customer");

    $newAccount->Code = "PHPTest";

    prn("Saving...";

    $newAccount->Save();

    prn("New account ID: {$newAccount->ID}";

    */

    //Initialise an existing account, using it's code

    $cashAccount = $sdkHelper->GetARAccount("CASH");

    //Create the new sales order object

    $salesOrder = new COM("Pastel.Evolution.SalesOrder");

    prn("Line items: {$salesOrder->Detail->Count}");

    prn("New Sales Order Total: {$salesOrder->TotalExcl}");

    //Specify the order's customer account

    $salesOrder->Customer = $cashAccount;

    //Retrieve an existing inventory item using its code.

    $stockItem = $sdkHelper->GetStockItem("ABC");

    prn("Fetched item");

    prn("Qty on hand: {$stockItem->QtyOnHand}");

    prn("Qty free: {$stockItem->QtyFree}");

    //Create an order line object and populate it

    $orderDetail = new COM("Pastel.Evolution.OrderDetail");

    $orderDetail->InventoryItem = $stockItem;

    $orderDetail->Quantity = 5;

    $orderDetail->UnitSellingPrice = 50;

    //Add the order line to the order document

    $salesOrder->Detail->Add($orderDetail);

    prn("Line items: {$salesOrder->Detail->Count}");

    prn("New sales order total (incl.): {$salesOrder->TotalIncl}");

    //Completely process the sales order and store the generated invoice number

    $reference = $salesOrder->Complete();

 

    /*Should you wish to pass in your own invoice number, do this instead:

    foreach ($salesOrder->Detail as $det)

    {

        prn($det->Quantity);

        $det->ToProcess = $det->Quantity;

    }

    $reference = $sdkHelper->ProcessDocumentWithCustomReference($salesOrder, "553343453");

    */

 

    prn("New invoice number: {$reference}");

    prn("Debtor transaction total: {$salesOrder->LedgerTransaction->Debit}");

 

 

}

catch (Exception $ex)

{

    prn($ex->GetMessage());

    //prn($ex->getCode());

    //prn($ex->getTraceAsString());

}

 

 

?>