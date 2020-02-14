<?php
session_start(); //啟動 session 功能
$ret = session_destroy(); //刪除 session 檔
header("Location: index.php");
