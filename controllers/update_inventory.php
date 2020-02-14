<?php

$id = intval($_REQUEST['id']);
$inventory_date = $_REQUEST['inventory_date'];
$barcode = $_REQUEST['barcode'];
$drug_code = $_REQUEST['drug_code'];
$stock_code = $_REQUEST['stock_code'];
$drug_english = $_REQUEST['drug_english'];
$drug_chinese = $_REQUEST['drug_chinese'];
$drugspec_amount = $_REQUEST['drugspec_amount'];
$box_qty = $_REQUEST['box_qty'];
$tablet_qty = $_REQUEST['tablet_qty'];
$total = $_REQUEST['total'];
$tr_qty = $_REQUEST['tr_qty'];
$safety_stock = $_REQUEST['safety_stock'];

include 'conn.php';

$sql = "UPDATE `dm_inventory` SET inventory_date='$inventory_date',barcode='$barcode',drug_code='$drug_code',stock_code='$stock_code',drug_english='$drug_english',drug_chinese='$drug_chinese',drugspec_amount='$drugspec_amount',box_qty='$box_qty',tablet_qty='$tablet_qty',total='$total',tr_qty='$tr_qty',safety_stock='$safety_stock' WHERE id=$id";
// @mysql_query($sql);
$conn->query($sql);
echo json_encode(array(
    'id' => $id,
    'inventory_date' => $inventory_date,
    'barcode' => $barcode,
    'drug_code' => $drug_code,
    'stock_code' => $stock_code,
    'drug_english' => $drug_english,
    'drug_chinese' => $drug_chinese,
    'drugspec_amount' => $drugspec_amount,
    'box_qty' => $box_qty,
    'tablet_qty' => $tablet_qty,
    'total' => $total,
    'tr_qty' => $tr_qty,
    'safety_stock' => $safety_stock,
));
