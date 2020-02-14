<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'purchase_date';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

if (isset($_POST['iisearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['iisearch_what']) ? mysql_real_escape_string($_POST['iisearch_what']) : '';
    $searchwhat = isset($_POST['iisearch_what']) ? mysqli_real_escape_string($conn, $_POST['iisearch_what']) : '';
    $where = " WHERE " . $_POST['iisearch_field'] . " LIKE '%" . $searchwhat . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始)

$sql = "SELECT COUNT(*) FROM `invoice_info`" . $where;
// $RS = mysql_query($sql, $conn);
$RS = $conn->query($sql);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `invoice_info` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
// $sql = "SELECT * FROM `invoice_info` " . $where . " ORDER BY " . $sort . " " . $order;
// $result = mysql_query($sql, $conn); //執行 SQL 指令
$result = $conn->query($sql); //執行 SQL 指令
$stock = array();
// for ($i = 0; $i < mysql_num_rows($result); $i++) {
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    //走訪紀錄集 (列)
    // $row = mysql_fetch_array($result); //取得列陣列
    $row = mysqli_fetch_array($result); //取得列陣列
    $stock[$i] = array(
        "id" => $row["id"],
        "purchase_date" => $row["purchase_date"],
        "invoice_date" => $row["invoice_date"],
        "drug_code" => $row["drug_code"],
        "stock_code" => $row["stock_code"],
        "drug_english" => $row["drug_english"],
        "drug_chinese" => $row["drug_chinese"],
        "drugspec_amount" => $row["drugspec_amount"],
        "drugspec_unit" => $row["drugspec_unit"],
        "drugprices_reference" => $row["drugprices_reference"],
        "drug_manufacturer" => $row["drug_manufacturer"],
        "agents" => $row["agents"],
        "quantity" => $row["quantity"],
        "grant_amount" => $row["grant_amount"],
        "total" => $row["total"],
        "purchase" => $row["purchase"],
        "invoice_number" => $row["invoice_number"],
        "invoice_amount" => $row["invoice_amount"],
        "discount_amount" => $row["discount_amount"],
        "business_tax" => $row["business_tax"],
        "discount_afteramount" => $row["discount_afteramount"],
        "unit_price" => $row["unit_price"],
        "price_difference" => $row["price_difference"],
        "purchase_price" => $row["purchase_price"],
        "percentage_deduction" => $row["percentage_deduction"],
        "expiration_date" => $row["expiration_date"],
        "lot_number" => $row["lot_number"],
        "payment_date" => $row["payment_date"],
        "paid_afterdeduction" => $row["paid_afterdeduction"],
        "before3months_consumption" => $row["before3months_consumption"],
        "business_representatives" => $row["business_representatives"],
        "mobile_telephone" => $row["mobile_telephone"],
        "phone_orders" => $row["phone_orders"],
        "storage_location" => $row["storage_location"],
        "return_1F" => $row["return_1F"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
