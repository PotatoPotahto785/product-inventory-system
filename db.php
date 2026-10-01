<?php
// InfinityFree MySQL details (Control Panel > MySQL Databases)
$host = "sql212.infinityfree.com";
$user = "if0_42929843";
$pass = "password";
$dbname = "if0_42929843_inventory";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
