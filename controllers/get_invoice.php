<?php

include 'conn.php';
// $rs = mysql_query('SELECT id,purchase_date,invoice_date,drug_code,drug_english,drug_chinese,drugspec_amount,drugspec_unit,drugprices_reference,drug_manufacturer,agents,quantity,grant_amount,total,purchase,invoice_number,invoice_amount,discount_amount,business_tax,discount_afteramount,unit_price,price_difference,purchase_price,percentage_deduction,expiration_date,lot_number,payment_date,paid_afterdeduction,before3months_consumption,business_representatives,mobile_telephone,phone_orders,storage_location,return_1F FROM `invoice_info`');
$rs = $conn->query('SELECT id,purchase_date,invoice_date,drug_code,drug_english,drug_chinese,drugspec_amount,drugspec_unit,drugprices_reference,drug_manufacturer,agents,quantity,grant_amount,total,purchase,invoice_number,invoice_amount,discount_amount,business_tax,discount_afteramount,unit_price,price_difference,purchase_price,percentage_deduction,expiration_date,lot_number,payment_date,paid_afterdeduction,before3months_consumption,business_representatives,mobile_telephone,phone_orders,storage_location,return_1F FROM `invoice_info`');
$result = array();
// while ($row = mysql_fetch_object($rs)) {
while ($row = mysqli_fetch_object($rs)) {
    array_push($result, $row);
}

echo json_encode($result);
