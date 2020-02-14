<?php

include 'conn.php';
// $rs = mysql_query('SELECT id,barcode,product_code,product_english,product_chinese,specification,spec_amount,spec_unit,product_price,product_manufacturer,remark,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price FROM `dm_retail`');
$rs = $conn->query('SELECT id,barcode,product_code,product_english,product_chinese,specification,spec_amount,spec_unit,product_price,product_manufacturer,remark,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price FROM `dm_retail`');
$result = array();
// while ($row = mysql_fetch_object($rs)) {
while ($row = mysqli_fetch_object($rs)) {
    array_push($result, $row);
}

echo json_encode($result);
