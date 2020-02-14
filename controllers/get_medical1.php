<?php

header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'medical_code';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

if (isset($_POST['mmsearch_field'])) {
    //有 search
    // $searchwhat = isset($_POST['mmsearch_what']) ? mysql_real_escape_string($_POST['mmsearch_what']) : '';
    $searchwhat = isset($_POST['mmsearch_what']) ? mysqli_real_escape_string($conn, $_POST['mmsearch_what']) : '';
    $where = " WHERE " . $_POST['mmsearch_field'] . " LIKE '%" . $searchwhat . "%'";
} else { $where = "";} //無 search

$start = ($page - 1) * $rows; //本頁第一個列索引 (0 起始)

$sql = "SELECT COUNT(*) FROM `medical_materials`" . $where;
// $RS = mysql_query($sql, $conn);
$RS = $conn->query($sql);
// list($total) = mysql_fetch_row($RS); //紀錄總筆數
list($total) = mysqli_fetch_row($RS); //紀錄總筆數
$sql = "SELECT * FROM `medical_materials` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $start . "," . $rows;
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
        'barcode' => $row["barcode"],
        'medical_code' => $row["medical_code"],
        'medical_english' => $row["medical_english"],
        'medical_chinese' => $row["medical_chinese"],
        'specification' => $row["specification"],
        'spec_amount' => $row["spec_amount"],
        'spec_unit' => $row["spec_unit"],
        'medical_price' => $row["medical_price"],
        'medical_manufacturer' => $row["medical_manufacturer"],
        'remark' => $row["remark"],
        'agents' => $row["agents"],
        'uniform_numbers' => $row["uniform_numbers"],
        'phone_orders' => $row["phone_orders"],
        'business_representatives' => $row["business_representatives"],
        'mobile_telephone' => $row["mobile_telephone"],
        'purchase_price' => $row["purchase_price"],
        'percentage_deduction' => $row["percentage_deduction"],
        'orderunit_rebates' => $row["orderunit_rebates"],
        'temporary_purchase' => $row["temporary_purchase"],
        'safety_stock' => $row["safety_stock"],
        'selling_price' => $row["selling_price"],
        'staff_price' => $row["staff_price"],
        'industry_price' => $row["industry_price"],
    );
} //end of for

$arr = array("total" => $total, "rows" => $stock);
echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回
