<?php

$id = intval($_REQUEST['id']);

include 'conn.php';

$sql = "DELETE FROM `sys_users` WHERE id=$id";
// $result = @mysql_query($sql);
$result = $conn->query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('errorMsg' => '發生錯誤, 請連絡管理員.'));
}
