<?php

$id = intval($_REQUEST['id']);
$barcode = $_REQUEST['barcode'];
$medical_code = $_REQUEST['medical_code'];
$medical_english = $_REQUEST['medical_english'];
$medical_chinese = $_REQUEST['medical_chinese'];
$specification = $_REQUEST['specification'];
$spec_amount = $_REQUEST['spec_amount'];
$spec_unit = $_REQUEST['spec_unit'];
$medical_price = $_REQUEST['medical_price'];
$medical_manufacturer = $_REQUEST['medical_manufacturer'];
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

$sql = "UPDATE `medical_materials` SET barcode='$barcode',medical_code='$medical_code',medical_english='$medical_english',medical_chinese='$medical_chinese',specification='$specification',spec_amount='$spec_amount',spec_unit='$spec_unit',medical_price='$medical_price',medical_manufacturer='$medical_manufacturer',remark='$remark',agents='$agents',uniform_numbers='$uniform_numbers',phone_orders='$phone_orders',business_representatives='$business_representatives',mobile_telephone='$mobile_telephone',purchase_price='$purchase_price',percentage_deduction='$percentage_deduction',orderunit_rebates='$orderunit_rebates',temporary_purchase='$temporary_purchase',safety_stock='$safety_stock',selling_price='$selling_price',staff_price='$staff_price',industry_price='$industry_price' WHERE id=$id";
// @mysql_query($sql);
$conn->query($sql);
echo json_encode(array(
    'id' => $id,
    'barcode' => $barcode,
    'medical_code' => $medical_code,
    'medical_english' => $medical_english,
    'medical_chinese' => $medical_chinese,
    'specification' => $specification,
    'spec_amount' => $spec_amount,
    'spec_unit' => $spec_unit,
    'medical_price' => $medical_price,
    'medical_manufacturer' => $medical_manufacturer,
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
