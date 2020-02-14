<?php

include 'conn.php';
// $rs = mysql_query('SELECT id,barcode,medical_code,medical_english,medical_chinese,specification,spec_amount,spec_unit,medical_price,medical_manufacturer,remark,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price FROM `medical_materials`');
$rs = $conn->query('SELECT id,barcode,medical_code,medical_english,medical_chinese,specification,spec_amount,spec_unit,medical_price,medical_manufacturer,remark,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price FROM `medical_materials`');
$result = array();
// while ($row = mysql_fetch_object($rs)) {
while ($row = mysqli_fetch_object($rs)) {
    array_push($result, $row);
}

echo json_encode($result);
