<?php

$id = intval($_REQUEST['id']);

include 'conn.php';

$sql = "DELETE FROM `invoice_info` WHERE id=$id";
// @mysql_query($sql);
$conn->query($sql);
echo json_encode(array('success' => true));
