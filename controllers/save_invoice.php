<?php

$purchase_date = $_REQUEST['purchase_date'];
$invoice_date = $_REQUEST['invoice_date'];
$drug_code = $_REQUEST['drug_code'];
$stock_code = $_REQUEST['stock_code'];
$drug_english = $_REQUEST['drug_english'];
$drug_chinese = $_REQUEST['drug_chinese'];
$drugspec_amount = $_REQUEST['drugspec_amount'];
$drugspec_unit = $_REQUEST['drugspec_unit'];
$drugprices_reference = $_REQUEST['drugprices_reference'];
$drug_manufacturer = $_REQUEST['drug_manufacturer'];
$agents = $_REQUEST['agents'];
$quantity = $_REQUEST['quantity'];
$grant_amount = $_REQUEST['grant_amount'];
$total = $_REQUEST['total'];
$purchase = $_REQUEST['purchase'];
$invoice_number = $_REQUEST['invoice_number'];
$invoice_amount = $_REQUEST['invoice_amount'];
$discount_amount = $_REQUEST['discount_amount'];
$business_tax = $_REQUEST['business_tax'];
$discount_afteramount = $_REQUEST['discount_afteramount'];
$unit_price = $_REQUEST['unit_price'];
$price_difference = $_REQUEST['price_difference'];
$purchase_price = $_REQUEST['purchase_price'];
$percentage_deduction = $_REQUEST['percentage_deduction'];
$expiration_date = $_REQUEST['expiration_date'];
$lot_number = $_REQUEST['lot_number'];
$payment_date = $_REQUEST['payment_date'];
$paid_afterdeduction = $_REQUEST['paid_afterdeduction'];
$before3months_consumption = $_REQUEST['before3months_consumption'];
$business_representatives = $_REQUEST['business_representatives'];
$mobile_telephone = $_REQUEST['mobile_telephone'];
$phone_orders = $_REQUEST['phone_orders'];
$storage_location = $_REQUEST['storage_location'];
$return_1F = $_REQUEST['return_1F'];

include 'conn.php';

$sql = "INSERT INTO `invoice_info`(purchase_date,invoice_date,drug_code,stock_code,drug_english,drug_chinese,drugspec_amount,drugspec_unit,drugprices_reference,drug_manufacturer,agents,quantity,grant_amount,total,purchase,invoice_number,invoice_amount,discount_amount,business_tax,discount_afteramount,unit_price,price_difference,purchase_price,percentage_deduction,expiration_date,lot_number,payment_date,paid_afterdeduction,before3months_consumption,business_representatives,mobile_telephone,phone_orders,storage_location,return_1F
) VALUES('$purchase_date','$invoice_date','$drug_code','$stock_code','$drug_english','$drug_chinese','$drugspec_amount','$drugspec_unit','$drugprices_reference','$drug_manufacturer','$agents','$quantity','$grant_amount','$total','$purchase','$invoice_number','$invoice_amount','$discount_amount','$business_tax','$discount_afteramount','$unit_price','$price_difference','$purchase_price','$percentage_deduction','$expiration_date','$lot_number','$payment_date','$paid_afterdeduction','$before3months_consumption','$business_representatives','$mobile_telephone','$phone_orders','$storage_location','$return_1F')";
// @mysql_query($sql);
$conn->query($sql);
// 'id' => mysqli_insert_id($conn),
echo json_encode(array(
    'id' => $conn->insert_id,
    'purchase_date' => $purchase_date,
    'invoice_date' => $invoice_date,
    'drug_code' => $drug_code,
    'stock_code' => $stock_code,
    'drug_english' => $drug_english,
    'drug_chinese' => $drug_chinese,
    'drugspec_amount' => $drugspec_amount,
    'drugspec_unit' => $drugspec_unit,
    'drugprices_reference' => $drugprices_reference,
    'drug_manufacturer' => $drug_manufacturer,
    'agents' => $agents,
    'quantity' => $quantity,
    'grant_amount' => $grant_amount,
    'total' => $total,
    'purchase' => $purchase,
    'invoice_number' => $invoice_number,
    'invoice_amount' => $invoice_amount,
    'discount_amount' => $discount_amount,
    'business_tax' => $business_tax,
    'discount_afteramount' => $discount_afteramount,
    'unit_price' => $unit_price,
    'price_difference' => $price_difference,
    'purchase_price' => $purchase_price,
    'percentage_deduction' => $percentage_deduction,
    'expiration_date' => $expiration_date,
    'lot_number' => $lot_number,
    'payment_date' => $payment_date,
    'paid_afterdeduction' => $paid_afterdeduction,
    'before3months_consumption' => $before3months_consumption,
    'business_representatives' => $business_representatives,
    'mobile_telephone' => $mobile_telephone,
    'phone_orders' => $phone_orders,
    'storage_location' => $storage_location,
    'return_1F' => $return_1F,
));
