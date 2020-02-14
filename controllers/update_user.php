<?php

$id = intval($_REQUEST['id']);
$account = htmlspecialchars($_REQUEST['account']);
$password = htmlspecialchars(md5($_REQUEST['password']));
$suname = htmlspecialchars($_REQUEST['suname']);
$theme = htmlspecialchars($_REQUEST['theme']);
$level = htmlspecialchars($_REQUEST['level']);

include 'conn.php';

$sql = "UPDATE `sys_users` SET account='$account',password='$password',suname='$suname',theme='$theme',level='$level' where id=$id";
// $result = @mysql_query($sql);
// if ($result) {
if ($result = $conn->query($sql)) {
    echo json_encode(array(
        'id' => $id,
        'account' => $account,
        'password' => $password,
        'suname' => $suname,
        'theme' => $theme,
        'level' => $level,
    ));
} else {
    echo json_encode(array('errorMsg' => '發生錯誤, 請連絡管理員.'));
}
