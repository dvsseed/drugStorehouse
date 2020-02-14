<?php

$barcode = $_REQUEST['barcode'];
$product_code = $_REQUEST['product_code'];
$product_english = $_REQUEST['product_english'];
$product_chinese = $_REQUEST['product_chinese'];
$specification = $_REQUEST['specification'];
$spec_amount = $_REQUEST['spec_amount'];
$spec_unit = $_REQUEST['spec_unit'];
$product_price = $_REQUEST['product_price'];
$product_manufacturer = $_REQUEST['product_manufacturer'];
$remark = $_REQUEST['remark'];
$agents = $_REQUEST['agents'];
$uniform_numbers = $_REQUEST['uniform_numbers'];
$phone_orders = $_REQUEST['phone_orders'];
$business_representatives = $_REQUEST['business_representatives'];
$mobile_telephone = $_REQUEST['mobile_telephone'];
$purchase_price = $_REQUEST['purchase_price'];
$percentage_deduction = $_REQUEST['percentage_deduction'];
$orderunit_rebates = $_REQUEST['orderunit_rebates'];
$temporary_purchase = $_REQUEST['temporary_purchase'];
$safety_stock = $_REQUEST['safety_stock'];
$selling_price = $_REQUEST['selling_price'];
$staff_price = $_REQUEST['staff_price'];
$industry_price = $_REQUEST['industry_price'];

include 'conn.php';

$sql = "INSERT INTO `dm_retail`(barcode,product_code,product_english,product_chinese,specification,spec_amount,spec_unit,product_price,product_manufacturer,remark,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price) VALUES('$barcode','$product_code','$product_english','$product_chinese','$specification','$spec_amount','$spec_unit','$product_price','$product_manufacturer','$remark','$agents','$uniform_numbers','$phone_orders','$business_representatives','$mobile_telephone','$purchase_price','$percentage_deduction','$orderunit_rebates','$temporary_purchase','$safety_stock','$selling_price','$staff_price','$industry_price')";
// @mysql_query($sql);
$conn->query($sql);
echo json_encode(array(
    'id' => mysqli_insert_id(),
    'barcode' => $barcode,
    'product_code' => $product_code,
    'product_english' => $product_english,
    'product_chinese' => $product_chinese,
    'specification' => $specification,
    'spec_amount' => $spec_amount,
    'spec_unit' => $spec_unit,
    'product_price' => $product_price,
    'product_manufacturer' => $product_manufacturer,
    'remark' => $remark,
    'agents' => $agents,
    'uniform_numbers' => $uniform_numbers,
    'phone_orders' => $phone_orders,
    'business_representatives' => $business_representatives,
    'mobile_telephone' => $mobile_telephone,
    'purchase_price' => $purchase_price,
    'percentage_deduction' => $percentage_deduction,
    'orderunit_rebates' => $orderunit_rebates,
    'temporary_purchase' => $temporary_purchase,
    'safety_stock' => $safety_stock,
    'selling_price' => $selling_price,
    'staff_price' => $staff_price,
    'industry_price' => $industry_price,
));
