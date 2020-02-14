<?php

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

$sql = "INSERT INTO `dm_inventory`(inventory_date,barcode,drug_code,stock_code,drug_english,drug_chinese,drugspec_amount,box_qty,tablet_qty,total,tr_qty,safety_stock) VALUES('$inventory_date','$barcode','$drug_code','$stock_code','$drug_english','$drug_chinese','$drugspec_amount','$box_qty','$tablet_qty','$total','$tr_qty','$safety_stock')";
// @mysql_query($sql);
$conn->query($sql);
// list($id) = mysql_insert_id();

// 自動撈資料並更新
$sql = "SELECT IFNULL(SUM(total), 0) FROM `invoice_info` WHERE stock_code = '" . $stock_code . "'";
// $RS = mysql_query($sql, $conn);
// list($total) = mysql_fetch_row($RS);
$RS = $conn->query($sql);
list($total) = mysqli_fetch_row($RS);

$sql = "SELECT IFNULL(SUM(tr_qty), 0) FROM `sales_sa395` WHERE item_id = '" . $stock_code . "'";
// $RS = mysql_query($sql, $conn);
// list($tr_qty) = mysql_fetch_row($RS);
$RS = $conn->query($sql);
list($tr_qty) = mysqli_fetch_row($RS);

$sql = "SELECT IFNULL(SUM(safety_stock), 0) FROM `dm_drugs` WHERE stock_code = '" . $stock_code . "'";
// $RS = mysql_query($sql, $conn);
// list($safety_stock) = mysql_fetch_row($RS);
$RS = $conn->query($sql);
list($safety_stock) = mysqli_fetch_row($RS);

$sql = "UPDATE `dm_inventory` SET total='$total',tr_qty='$tr_qty',safety_stock='$safety_stock' WHERE id=" . mysqli_insert_id();
// @mysql_query($sql);
$conn->query($sql);

echo json_encode(array(
    'id' => mysqli_insert_id(),
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
