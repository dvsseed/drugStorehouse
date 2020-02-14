<?php

$account = htmlspecialchars($_REQUEST['account']);
$password = md5(htmlspecialchars($_REQUEST['password']));
$suname = htmlspecialchars($_REQUEST['suname']);
$theme = htmlspecialchars($_REQUEST['theme']);
$level = htmlspecialchars($_REQUEST['level']);

include 'conn.php';

$sql = "INSERT INTO `sys_users`(account,password,suname,theme,level) VALUES('$account','$password','$suname','$theme','$level')";
// $result = @mysql_query($sql);
// if ($result) {
if ($result = $conn->query($sql)) {
    echo json_encode(array(
        'id' => mysqli_insert_id(),
        'account' => $account,
        'password' => $password,
        'suname' => $suname,
        'theme' => $theme,
        'level' => $level,
    ));
} else {
    echo json_encode(array('errorMsg' => '發生錯誤, 請連絡管理員.'));
}
