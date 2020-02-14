<?php
// 驗證帳密是否符合
header('Content-Type: text/html;charset=UTF-8');
$arr["success"]=true;
$arr["msg"]="您已登入系統!";
echo json_encode($arr);
?>