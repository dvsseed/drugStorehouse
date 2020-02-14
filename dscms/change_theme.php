<?php
require_once "../lib/dbsettings.php"; //匯入資料庫設定檔 (必須)
require_once "../lib/mysql.php"; //匯入資料庫模組   (必須)
$theme = $_REQUEST["theme"];
$result =

$arr["status"] = "success";
$arr["msg"] = "ok";
echo json_encode($arr);
