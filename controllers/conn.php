<?php

// $conn = @mysql_connect('127.0.0.1', 'druguser', '0HfpaWyU50v3');
// if (!$conn) {
    // die('Could not connect: ' . mysql_error());
// }
// mysql_select_db('drugstorehouse', $conn);
// mysql_query("SET NAMES 'utf8'");

// $conn = new mysqli('127.0.0.1', 'druguser', '0HfpaWyU50v3', 'drugstorehouse');
$conn = new mysqli('127.0.0.1', 'root', 'p@$$w0rd', 'drugstorehouse');

if ($conn->connect_errno) {
    echo "Sorry, this website is experiencing problems.";
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $conn->connect_errno . "\n";
    echo "Error: " . $conn->connect_error . "\n";
    exit;
}
$sql = "SET NAMES 'utf8'"; // 使用Big5編碼存入MySQL
if (!$result = $conn->query($sql)) {
    echo "Sorry, the website is experiencing problems.";
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}
