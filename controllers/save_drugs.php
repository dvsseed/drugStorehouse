<?php

$new_mark = $_REQUEST['new_mark'];
$oral_tablet = $_REQUEST['oral_tablet'];
$single_compound = $_REQUEST['single_compound'];
$drug_code = $_REQUEST['drug_code'];
$stock_code = $_REQUEST['stock_code'];
$drugprices_reference = $_REQUEST['drugprices_reference'];
$drugprices_startdate = $_REQUEST['drugprices_startdate'];
$drugprices_expirationdate = $_REQUEST['drugprices_expirationdate'];
$drug_english = $_REQUEST['drug_english'];
$drugspec_amount = $_REQUEST['drugspec_amount'];
$drugspec_unit = $_REQUEST['drugspec_unit'];
$drug_element = $_REQUEST['drug_element'];
$drug_ingredient = $_REQUEST['drug_ingredient'];
$content_unit = $_REQUEST['content_unit'];
$drug_form = $_REQUEST['drug_form'];
$drug_classification = $_REQUEST['drug_classification'];
$drug_manufacturer = $_REQUEST['drug_manufacturer'];
$atc_code = $_REQUEST['atc_code'];

include 'conn.php';

// 找最大流水號
$sql = "SELECT MAX(RIGHT(stock_code, 6)) + 1 FROM `healthcare_drugs`";
// $RS = mysql_query($sql, $conn);
// list($serialnumber) = mysql_fetch_row($RS);
$RS = $conn->query($sql);
list($serialnumber) = mysqli_fetch_row($RS);

$stock_code = "DM" . $drug_code . $serialnumber;

$sql = "INSERT INTO `healthcare_drugs`(new_mark,oral_tablet,single_compound,drug_code,stock_code,drugprices_reference,drugprices_startdate,drugprices_expirationdate,drug_english,drugspec_amount,drugspec_unit,drug_element,drug_ingredient,content_unit,drug_form,drug_classification,drug_manufacturer,atc_code) VALUES('$new_mark','$oral_tablet','$single_compound','$drug_code','$stock_code','$drugprices_reference','$drugprices_startdate','$drugprices_expirationdate','$drug_english','$drugspec_amount','$drugspec_unit','$drug_element','$drug_ingredient','$content_unit','$drug_form','$drug_classification','$drug_manufacturer','$atc_code')";
// @mysql_query($sql);
$conn->query($sql);

echo json_encode(array(
    'id' => mysqli_insert_id(),
    'new_mark' => $new_mark,
    'oral_tablet' => $oral_tablet,
    'single_compound' => $single_compound,
    'drug_code' => $drug_code,
    'stock_code' => $stock_code,
    'drugprices_reference' => $drugprices_reference,
    'drugprices_startdate' => $drugprices_startdate,
    'drugprices_expirationdate' => $drugprices_expirationdate,
    'drug_english' => $drug_english,
    'drugspec_amount' => $drugspec_amount,
    'drugspec_unit' => $drugspec_unit,
    'drug_element' => $drug_element,
    'drug_ingredient' => $drug_ingredient,
    'content_unit' => $content_unit,
    'drug_form' => $drug_form,
    'drug_classification' => $drug_classification,
    'drug_manufacturer' => $drug_manufacturer,
    'atc_code' => $atc_code,
));
