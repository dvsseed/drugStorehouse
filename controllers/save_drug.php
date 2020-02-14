<?php

$barcode = $_REQUEST['barcode'];
$drug_code = $_REQUEST['drug_code'];
$stock_code = $_REQUEST['stock_code'];
$drug_english = $_REQUEST['drug_english'];
$drug_chinese = $_REQUEST['drug_chinese'];
$drug_element = $_REQUEST['drug_element'];
$drug_ingredient = $_REQUEST['drug_ingredient'];
$drugspec_amount = $_REQUEST['drugspec_amount'];
$drugspec_unit = $_REQUEST['drugspec_unit'];
$single_compound = $_REQUEST['single_compound'];
$drugprices_reference = $_REQUEST['drugprices_reference'];
$drugprices_startdate = $_REQUEST['drugprices_startdate'];
$drugprices_expirationdate = $_REQUEST['drugprices_expirationdate'];
$drug_manufacturer = $_REQUEST['drug_manufacturer'];
$drug_form = $_REQUEST['drug_form'];
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

// 檢查藥品代碼是否重複
$sql = "SELECT IFNULL(count(drug_code), 0) FROM `dm_drugs` WHERE drug_code = '" . $drug_code . "'";
// $RS = mysql_query($sql, $conn);
// list($dcnum) = mysql_fetch_row($RS);
$RS = $conn->query($sql);
list($dcnum) = mysqli_fetch_row($RS);

if (intval($dcnum) == 0) {
    $sql = "INSERT INTO `dm_drugs`(barcode,drug_code,stock_code,drug_english,drug_chinese,drug_element,drug_ingredient,drugspec_amount,drugspec_unit,single_compound,drugprices_reference,drugprices_startdate,drugprices_expirationdate,drug_manufacturer,drug_form,remark,agents,uniform_numbers,phone_orders,business_representatives,mobile_telephone,purchase_price,percentage_deduction,orderunit_rebates,temporary_purchase,safety_stock,selling_price,staff_price,industry_price
) VALUES('$barcode','$drug_code','$stock_code','$drug_english','$drug_chinese','$drug_element','$drug_ingredient','$drugspec_amount','$drugspec_unit','$single_compound','$drugprices_reference','$drugprices_startdate','$drugprices_expirationdate','$drug_manufacturer','$drug_form','$remark','$agents','$uniform_numbers','$phone_orders','$business_representatives','$mobile_telephone','$purchase_price','$percentage_deduction','$orderunit_rebates','$temporary_purchase','$safety_stock','$selling_price','$staff_price','$industry_price')";
    // @mysql_query($sql);
	$conn->query($sql);
//        'id' => mysqli_insert_id(),
    echo json_encode(array(
        'id' => $conn->insert_id,
        'barcode' => $barcode,
        'drug_code' => $drug_code,
        'stock_code' => $stock_code,
        'drug_english' => $drug_english,
        'drug_chinese' => $drug_chinese,
        'drug_element' => $drug_element,
        'drug_ingredient' => $drug_ingredient,
        'drugspec_amount' => $drugspec_amount,
        'drugspec_unit' => $drugspec_unit,
        'single_compound' => $single_compound,
        'drugprices_reference' => $drugprices_reference,
        'drugprices_startdate' => $drugprices_startdate,
        'drugprices_expirationdate' => $drugprices_expirationdate,
        'drug_manufacturer' => $drug_manufacturer,
        'drug_form' => $drug_form,
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
} else {
    echo json_encode(array('errorMsg' => '發生錯誤: [藥品代碼重複]--無法存檔!!'));
}
