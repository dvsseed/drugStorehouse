<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'inventory_date';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

if (isset($_POST['ivsearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['ivsearch_what']) ? mysql_real_escape_string($_POST['ivsearch_what']) : '';
    $searchwhat = isset($_POST['ivsearch_what']) ? mysqli_real_escape_string($conn, $_POST['ivsearch_what']) : '';
    $where = " WHERE " . $_POST['ivsearch_field'] . " LIKE '%" . $searchwhat . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始)

$sql = "SELECT COUNT(*) FROM `dm_inventory`" . $where;
// $RS = mysql_query($sql, $conn);
$RS = $conn->query($sql);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `dm_inventory` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
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
        "inventory_date" => $row["inventory_date"],
        "barcode" => $row["barcode"],
        "drug_code" => $row["drug_code"],
        "stock_code" => $row["stock_code"],
        "drug_english" => $row["drug_english"],
        "drug_chinese" => $row["drug_chinese"],
        "drugspec_amount" => $row["drugspec_amount"],
        "box_qty" => $row["box_qty"],
        "tablet_qty" => $row["tablet_qty"],
        "total" => $row["total"],
        "tr_qty" => $row["tr_qty"],
        "safety_stock" => $row["safety_stock"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
