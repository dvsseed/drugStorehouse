<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'drug_code';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

if (isset($_POST['iiddsearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['iiddsearch_what']) ? mysql_real_escape_string($_POST['iiddsearch_what']) : '';
    $searchwhat = isset($_POST['iiddsearch_what']) ? mysqli_real_escape_string($conn, $_POST['iiddsearch_what']) : '';
    $where = " WHERE " . $_POST['iiddsearch_field'] . " LIKE '%" . $searchwhat . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始)

$sql = "SELECT COUNT(*) FROM `dm_drugs`" . $where;
// $RS = mysql_query($sql, $conn);
$RS = $conn->query($sql);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `dm_drugs` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
// $result = mysql_query($sql, $conn); //執行 SQL 指令
$result = $conn->query($sql); //執行 SQL 指令
$stock = array();
// for ($i = 0; $i < mysql_num_rows($result); $i++) {
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    //走訪紀錄集 (列)
    // $row = mysql_fetch_array($result); //取得列陣列
    $row = mysqli_fetch_array($result); //取得列陣列
    $stock[$i] = array(
        "drug_code" => $row["drug_code"],
        "stock_code" => $row["stock_code"],
        "drug_english" => $row["drug_english"],
        "drug_chinese" => $row["drug_chinese"],
        "drugspec_amount" => $row["drugspec_amount"],
        "drugspec_unit" => $row["drugspec_unit"],
        "drugprices_reference" => $row["drugprices_reference"],
        "drug_manufacturer" => $row["drug_manufacturer"],
        "agents" => $row["agents"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
