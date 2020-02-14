<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'drug_code';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

if (isset($_POST['ddhcdsearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['ddhcdsearch_what']) ? mysql_real_escape_string($_POST['ddhcdsearch_what']) : '';
    $searchwhat = isset($_POST['ddhcdsearch_what']) ? mysqli_real_escape_string($conn, $_POST['ddhcdsearch_what']) : '';
    $where = " WHERE " . $_POST['ddhcdsearch_field'] . " LIKE '%" . trim($searchwhat) . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始)

$sql = "SELECT COUNT(*) FROM `healthcare_drugs`" . $where;
// $RS = mysql_query($sql, $conn);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
$RS = $conn->query($sql);
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `healthcare_drugs` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
// $result = mysql_query($sql, $conn); //執行 SQL 指令
$result = $conn->query($sql); //執行 SQL 指令
$stock = array();
// for ($i = 0; $i < mysql_num_rows($result); $i++) {
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    //走訪紀錄集 (列)
    // $row = mysql_fetch_array($result); //取得列陣列
    $row = mysqli_fetch_array($result); //取得列陣列
    $stock[$i] = array(
        "single_compound" => $row["single_compound"],
        "drug_code" => $row["drug_code"],
        "stock_code" => $row["stock_code"],
        "drugprices_reference" => $row["drugprices_reference"],
        "drugprices_startdate" => $row["drugprices_startdate"],
        "drugprices_expirationdate" => $row["drugprices_expirationdate"],
        "drug_english" => $row["drug_english"],
        "drugspec_amount" => $row["drugspec_amount"],
        "drugspec_unit" => $row["drugspec_unit"],
        "drug_element" => $row["drug_element"],
        "drug_ingredient" => $row["drug_ingredient"],
        "content_unit" => $row["content_unit"],
        "drug_form" => $row["drug_form"],
        "drug_classification" => $row["drug_classification"],
        "drug_manufacturer" => $row["drug_manufacturer"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
