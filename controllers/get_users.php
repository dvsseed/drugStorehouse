<?php
header('Content-Type: text/html; charset=utf-8');
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
$offset = ($page - 1) * $rows;
$result = array();

// $rs = mysql_query("SELECT COUNT(*) FROM `sys_users`");
// $row = mysql_fetch_row($rs);
$rs = $conn->query("SELECT COUNT(*) FROM `sys_users`");
$row = mysqli_fetch_row($rs);
$result["total"] = $row[0];
// $rs = mysql_query("SELECT id,account,password,suname,theme,level FROM `sys_users` LIMIT $offset,$rows");
$rs = $conn->query("SELECT id,account,password,suname,theme,level FROM `sys_users` LIMIT $offset,$rows");

$items = array();
// while ($row = mysql_fetch_object($rs)) {
while ($row = mysqli_fetch_object($rs)) {
    array_push($items, $row);
}
$result["rows"] = $items;

echo json_encode($result);
