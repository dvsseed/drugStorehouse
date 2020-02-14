<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'agents';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

if (isset($_POST['dasearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['dasearch_what']) ? mysql_real_escape_string($_POST['dasearch_what']) : '';
    $searchwhat = isset($_POST['dasearch_what']) ? mysqli_real_escape_string($conn, $_POST['dasearch_what']) : '';
    $where = " WHERE " . $_POST['dasearch_field'] . " LIKE '%" . $searchwhat . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始)

$sql = "SELECT COUNT(*) FROM `drug_agents`" . $where;
// $RS = mysql_query($sql, $conn);
$RS = $conn->query($sql);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `drug_agents` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
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
        "agents" => $row["agents"],
        "uniform_numbers" => $row["uniform_numbers"],
        "payment_method" => $row["payment_method"],
        "term_receivables" => $row["term_receivables"],
        "percentage_deduction" => $row["percentage_deduction"],
        "payee_account" => $row["payee_account"],
        "beneficiary_bank" => $row["beneficiary_bank"],
        "branch_categories" => $row["branch_categories"],
        "beneficiary_account" => $row["beneficiary_account"],
        "fee_burden" => $row["fee_burden"],
        "payee_uninumbers" => $row["payee_uninumbers"],
        "accounts_notification" => $row["accounts_notification"],
        "e_mail" => $row["e_mail"],
        "fax_number" => $row["fax_number"],
        "phone_number" => $row["phone_number"],
        "phone_orders" => $row["phone_orders"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
