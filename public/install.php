<?php
// 在資料庫中插入系統表單, 以及填入預設資料
header('Content-Type: text/html;charset=UTF-8');
$arr["success"]=true;
$arr["msg"]="系統安裝完成!";
echo json_encode($arr);
?>