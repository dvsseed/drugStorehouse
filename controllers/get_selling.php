<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tr_date';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';

if (isset($_POST['pssearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['pssearch_what']) ? mysql_real_escape_string($_POST['pssearch_what']) : '';
    $searchwhat = isset($_POST['pssearch_what']) ? mysqli_real_escape_string($conn, $_POST['pssearch_what']) : '';
    $where = " WHERE " . $_POST['pssearch_field'] . " LIKE '%" . $searchwhat . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始), offset

$sql = "SELECT COUNT(*) FROM `sales_sa395`" . $where;
// $RS = mysql_query($sql, $conn);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
$RS = $conn->query($sql);
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `sales_sa395` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
// $result = mysql_query($sql, $conn); //執行 SQL 指令
$result = $conn->query($sql); //執行 SQL 指令
$stock = array();
// for ($i = 0; $i < mysql_num_rows($result); $i++) {
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    //走訪紀錄集 (列)
    // $row = mysql_fetch_array($result); //取得列陣列
    $row = mysqli_fetch_array($result); //取得列陣列
    $stock[$i] = array(
        "sale_id" => $row["sale_id"],
        "seqno" => $row["seqno"],
        "item_id" => $row["item_id"],
        "tr_date" => $row["tr_date"],
        "un_price" => $row["un_price"],
        "tr_qty" => $row["tr_qty"],
        "mea" => $row["mea"],
        "dis_per" => $row["dis_per"],
        "dis_mon" => $row["dis_mon"],
        "un_cost" => $row["un_cost"],
        "get_point" => $row["get_point"],
        "bonus" => $row["bonus"],
        "sub_pmon" => $row["sub_pmon"],
        "stock_old" => $row["stock_old"],
        "cost_old" => $row["cost_old"],
        "updid" => $row["updid"],
        "updtime" => $row["updtime"],
        "ubc1" => $row["ubc1"],
        "ubc2" => $row["ubc2"],
        "ubn1" => $row["ubn1"],
        "ubn2" => $row["ubn2"],
        "ubd1" => $row["ubd1"],
        "ubd2" => $row["ubd2"],
        "cmp_code" => $row["cmp_code"],
        "inv_id" => $row["inv_id"],
        "new_uprice" => $row["new_uprice"],
        "sp_no" => $row["sp_no"],
        "sp_seqno" => $row["sp_seqno"],
        "csq_id" => $row["csq_id"],
        "up_dis" => $row["up_dis"],
        "eos_cost" => $row["eos_cost"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
