<?php

include 'conn.php';
// $rs = mysql_query('SELECT id,barcode,drug_code,drug_english,drug_chinese,drug_element,drug_ingredient,drugspec_amount,drugspec_unit,single_compound,drugprices_reference,drugprices_startdate,drugprices_expirationdate,drug_manufacturer,drug_form,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price,remark FROM `dm_drugs`');
$rs = $conn->query('SELECT id,barcode,drug_code,drug_english,drug_chinese,drug_element,drug_ingredient,drugspec_amount,drugspec_unit,single_compound,drugprices_reference,drugprices_startdate,drugprices_expirationdate,drug_manufacturer,drug_form,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price,remark FROM `dm_drugs`');
$result = array();
// while ($row = mysql_fetch_object($rs)) {
while ($row = mysqli_fetch_object($rs)) {
    array_push($result, $row);
}

echo json_encode($result);
